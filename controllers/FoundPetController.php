<?php

require_once __DIR__ . '/../models/FoundPet.php';
require_once __DIR__ . '/../models/Pet.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../services/MailService.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../vendor/autoload.php'; // Adjust path if needed

class FoundPetController
{
    use Controller;

    public function add()
    {
        // Allow if user or manager is logged in
        if (
            empty($_SESSION['user_ID']) &&
            (empty($_SESSION['staff_role']) || $_SESSION['staff_role'] !== 'Manager')
        ) {
            header("Location: /PetSpot_clinic/public/login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'user_ID' => !empty($_SESSION['user_ID']) ? $_SESSION['user_ID'] : null,
                'type' => $_POST['type'],
                'breed' => $_POST['breed'],
                'gender' => $_POST['gender'],
                'color' => $_POST['color'],
                'special_markings' => $_POST['special_markings'],
                'found_date' => $_POST['found_date'],
                'reporter_email' => $_POST['reporter_email'],
                'found_location' => $_POST['found_location'],
                // ...any other fields...
            ];

            // Handle image upload
            if (!empty($_FILES['image']['name'])) {
                $targetDir = __DIR__ . '/../uploads/';
                if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
                $targetFile = $targetDir . basename($_FILES['image']['name']);
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    $data['image_url'] = '/PetSpot_clinic/app/uploads/' . basename($_FILES['image']['name']);
                }
            }

            $foundPet = new FoundPet();
            $foundPet->insert($data);

            $mailSent = $this->notifyMatchingLostPets($data);

            if (!empty($_SESSION['staff_role']) && $_SESSION['staff_role'] === 'Manager') {
                $msg = $mailSent ? 'Found pet reported! Notification email sent to possible matching lost pet owners.' : 'Found pet reported! No matching lost pet found or notification email could not be sent.';
                echo "<script>alert('$msg');window.location.href='/PetSpot_clinic/public/manager/manager-found';</script>";
            } else {
                $msg = $mailSent ? 'Found pet reported! Notification email sent to possible matching lost pet owners.' : 'Found pet reported! No matching lost pet found or notification email could not be sent.';
                echo "<script>alert('$msg');window.location.href='/PetSpot_clinic/public/found-pet';</script>";
            }
            exit;
        }

        include __DIR__ . '/../views/found_pet/add.view.php';
    }

    public function index()
    {
        $foundPet = new FoundPet();
        $foundPets = $foundPet->findAll();

        // Add this block:
        require_once __DIR__ . '/../models/AdoptionRequest.php';
        $adoptionRequestModel = new AdoptionRequest();
        $requestedPetIds = [];
        if (!empty($_SESSION['user_ID'])) {
            $userAdoptionRequests = $adoptionRequestModel->where(['user_ID' => $_SESSION['user_ID']]);
            $requestedPetIds = array_column($userAdoptionRequests, 'found_ID');
        }

        include __DIR__ . '/../views/found_pet/list.view.php';
    }

    public function list()
    {
        $foundPetModel = new FoundPet();
        $foundPets = $foundPetModel->findAll();

        // Add this block:
        require_once __DIR__ . '/../models/AdoptionRequest.php';
        $adoptionRequestModel = new AdoptionRequest();
        $requestedPetIds = [];
        if (!empty($_SESSION['user_ID'])) {
            $userAdoptionRequests = $adoptionRequestModel->where(['user_ID' => $_SESSION['user_ID']]);
            $requestedPetIds = array_column($userAdoptionRequests, 'found_ID');
        }

        include __DIR__ . '/../views/found_pet/list.view.php';
    }

    public function edit()
    {
        if (empty($_SESSION['user_ID'])) {
            header("Location: /PetSpot_clinic/public/login");
            exit;
        }

        $found_ID = $_GET['found_ID'] ?? null;
        $foundPetModel = new FoundPet();
        $pet = $foundPetModel->first(['found_ID' => $found_ID]);

        // Only allow the reporter to edit
        if (!$pet || $pet->user_ID != $_SESSION['user_ID']) {
            echo "Unauthorized.";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Update logic here (similar to add)
            $data = [
                'type' => $_POST['type'],
                'breed' => $_POST['breed'],
                'gender' => $_POST['gender'],
                'color' => $_POST['color'],
                'special_markings' => $_POST['special_markings'],
                'found_date' => $_POST['found_date'],
                'reporter_email' => $_POST['reporter_email'],
                'found_location' => $_POST['found_location'], // <-- Add this line
            ];

            // Handle image upload
            if (!empty($_FILES['image']['name'])) {
                $targetDir = __DIR__ . '/../uploads/';
                if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
                $targetFile = $targetDir . basename($_FILES['image']['name']);
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    $data['image_url'] = '/PetSpot_clinic/app/uploads/' . basename($_FILES['image']['name']);
                }
            }

            $foundPetModel->update($found_ID, $data);
            header("Location: /PetSpot_clinic/public/found-pet");
            exit;
        }

        include __DIR__ . '/../views/found_pet/edit.view.php';
    }

    public function delete()
    {
        if (empty($_SESSION['user_ID'])) {
            header("Location: /PetSpot_clinic/public/login");
            exit;
        }

        if (!isset($_GET['found_ID'])) {
            echo "No pet ID provided.";
            return;
        }

        $found_ID = $_GET['found_ID'];

        // Validate ID
        if (!is_numeric($found_ID)) {
            echo "Invalid ID.";
            return;
        }

        $foundPet = new FoundPet();

        // Attempt to delete
        $result = $foundPet->delete($found_ID);

        if ($result) {
            error_log("Successfully deleted pet with ID: $found_ID");
            header("Location: /PetSpot_clinic/public/found-pet/list?deleted=true");
            exit;
        } else {
            error_log("Failed to delete pet with ID: $found_ID");
            header("Location: /PetSpot_clinic/public/found-pet/list?deleted=false");
            exit;
        }
    }

    public function adopt()
    {
        if (empty($_SESSION['user_ID'])) {
            header("Location: /PetSpot_clinic/public/login");
            exit;
        }

        if (empty($_GET['found_ID'])) {
            echo "Invalid request.";
            exit;
        }

        $found_ID = (int)$_GET['found_ID'];
        $foundPetModel = new FoundPet();
        $pet = $foundPetModel->first(['found_ID' => $found_ID]);

        if (!$pet) {
            echo "Pet not found.";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../models/AdoptionRequest.php';
            $adoptionRequest = new AdoptionRequest();

            $data = [
                'found_ID' => $found_ID,
                'user_ID' => $_SESSION['user_ID'],
                'message' => $_POST['message'] ?? '',
                'status' => 'Pending'
            ];

            $adoptionRequest->insert($data);

            // Do NOT update pet status here!

            echo "<script>alert('Adoption request submitted! Our staff will contact you soon.');window.location.href='/PetSpot_clinic/public/found-pet';</script>";
            exit;
        }

        require_once __DIR__ . '/../models/AdoptionRequest.php';
        $adoptionRequestModel = new AdoptionRequest();
        $userAdoptionRequests = [];
        if (!empty($_SESSION['user_ID'])) {
            $userAdoptionRequests = $adoptionRequestModel->where(['user_ID' => $_SESSION['user_ID']]);
            // Build a quick lookup array for found_IDs
            $requestedPetIds = array_column($userAdoptionRequests, 'found_ID');
        }

        include __DIR__ . '/../views/found_pet/adopt.view.php';
    }

    private function notifyMatchingLostPets($foundPet)
    {
        $petModel = new Pet();
        $userModel = new User();
        $mailService = new MailService();

        $lostPets = $petModel->where(['status' => 'lost']);
        $mailSent = false;

        foreach ($lostPets as $lostPet) {
            $typeMatch = strcasecmp($lostPet->type, $foundPet['type'] ?? '') === 0;
            $genderMatch = strcasecmp($lostPet->gender, $foundPet['gender'] ?? '') === 0;
            $breedMatch = strcasecmp($lostPet->breed, $foundPet['breed'] ?? '') === 0;

            // Essential matching: (type and gender) OR (type and breed and gender)
            if (!( ($typeMatch && $genderMatch) || ($typeMatch && $breedMatch && $genderMatch) )) {
                continue; // Skip if essential fields do not match
            }

            $matchCount = 0;

            // Color match (can be improved later)
            if (strcasecmp($lostPet->color, $foundPet['color'] ?? '') === 0) $matchCount++;
            if (strcasecmp($lostPet->special_markings ?? '', $foundPet['special_markings'] ?? '') === 0) $matchCount++;
            if (!empty($lostPet->last_seen_location) && !empty($foundPet['found_location'])) {
                if (stripos($foundPet['found_location'], $lostPet->last_seen_location) !== false ||
                    stripos($lostPet->last_seen_location, $foundPet['found_location']) !== false) {
                    $matchCount++;
                }
            }
            if (!empty($lostPet->last_seen_date) && !empty($foundPet['found_date'])) {
                if ($lostPet->last_seen_date == $foundPet['found_date']) $matchCount++;
            }

            // At least one more field must match (besides essential fields)
            if ($matchCount >= 1) {
                $owner = $userModel->first(['user_ID' => $lostPet->user_ID]);
                if ($owner && !empty($owner->email)) {
                    $mailService->sendPetMatchNotification(
                        $owner->email,
                        $owner->fullname,
                        $lostPet,
                        $foundPet
                    );
                    $mailSent = true;
                }
            }
        }
        return $mailSent;
    }
}

error_log("DEBUG: found_ID from GET is " . ($_GET['found_ID'] ?? 'NULL'));
?>
