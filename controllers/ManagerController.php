<?php
require_once __DIR__ . '/../models/Pet.php';
require_once __DIR__ . '/../models/FoundPet.php';
require_once __DIR__ . '/../models/Feedback.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../services/MailService.php';

class ManagerController
{
    public function petProfiles()
    {
        $petModel = new Pet();
        // Get pets with owner information using JOIN
        $sql = "SELECT p.*, u.email as owner_email, u.fullname as owner_name 
                FROM pets p 
                LEFT JOIN users u ON p.user_ID = u.user_ID 
                ORDER BY p.pet_ID DESC";
        $pets = $petModel->query($sql);
        include __DIR__ . '/../views/manager/pet_profiles.view.php';
    }

    public function foundPets()
    {
        $foundPetModel = new FoundPet();
        $foundPets = $foundPetModel->findAll();
        include __DIR__ . '/../views/manager/manager_found.view.php';
    }

    public function lostPets()
    {
        $petModel = new Pet();
        $userModel = new User();
        
        // First get lost pets
        $lostPets = $petModel->where(['status' => 'lost']);
        
        // Add owner email to each pet
        if (!empty($lostPets)) {
            foreach ($lostPets as $pet) {
                $user = $userModel->first(['user_ID' => $pet->user_ID]);
                $pet->owner_email = $user ? $user->email : 'N/A';
                $pet->lost_date = $pet->last_seen_date ?? $pet->date_registered;
            }
        }
        
        include __DIR__ . '/../views/manager/manager_lost.view.php';
    }

    public function markAsFound()
    {
        if ($_SESSION['staff_role'] !== 'Manager') {
            header("Location: /PetSpot_clinic/public/login");
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['pet_id'])) {
            $petModel = new Pet();
            // Change status from 'lost' to 'active' so pet appears in user's active pets
            $petModel->update($_POST['pet_id'], ['status' => 'active']);
            
            header("Location: /PetSpot_clinic/public/manager/manager-lost");
            exit;
        }
    }

    public function feedbacks()
    {
        if (empty($_SESSION['staff_role']) || $_SESSION['staff_role'] !== 'Manager') {
            header("Location: /PetSpot_clinic/public/login");
            exit;
        }
        $feedback = new Feedback();
        $allFeedbacks = $feedback->findAll(); // Fetch all, not just pending
        include __DIR__ . '/../views/manager/feedbacks.view.php';
    }

    public function confirmFeedback()
    {
        if ($_SESSION['staff_role'] !== 'Manager') {
            header("Location: /PetSpot_clinic/public/login");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['feedback_id'])) {
            $feedback = new Feedback();
            if (isset($_POST['action']) && $_POST['action'] === 'cancel') {
                $feedback->update($_POST['feedback_id'], ['confirmed' => 0]);
            } else {
                $feedback->update($_POST['feedback_id'], ['confirmed' => 1]);
            }
        }
        header("Location: /PetSpot_clinic/public/manager/feedbacks");
        exit;
    }

    public function deleteFeedback()
    {
        if (empty($_SESSION['staff_role']) || $_SESSION['staff_role'] !== 'Manager') {
            header("Location: /PetSpot_clinic/public/login");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['feedback_id'])) {
            require_once __DIR__ . '/../models/Feedback.php';
            $feedback = new Feedback();
            $feedback->delete($_POST['feedback_id']);
        }
        header("Location: /PetSpot_clinic/public/manager/feedbacks");
        exit;
    }

    public function adoptionRequests()
    {
        require_once __DIR__ . '/../models/AdoptionRequest.php';
        require_once __DIR__ . '/../models/User.php';
        $adoptionRequestModel = new AdoptionRequest();
        $userModel = new User();

        $requests = $adoptionRequestModel->findAll();
        // Attach adopter info
        foreach ($requests as $req) {
            $user = $userModel->first(['user_ID' => $req->user_ID]);
            $req->adopter_email = $user->email ?? '';
            $req->adopter_name = $user->fullname ?? '';
        }
        include __DIR__ . '/../views/manager/adoption_requests.view.php';
    }

    public function handleAdoptionRequest()
    {
        if (empty($_SESSION['staff_role']) || $_SESSION['staff_role'] !== 'Manager') {
            header("Location: /PetSpot_clinic/public/login");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['request_id'])) {
            require_once __DIR__ . '/../models/AdoptionRequest.php';
            require_once __DIR__ . '/../models/FoundPet.php';
            require_once __DIR__ . '/../services/MailService.php';

            $adoptionRequestModel = new AdoptionRequest();
            $foundPetModel = new FoundPet();
            $mailService = new MailService();

            $requestId = $_POST['request_id'];
            $action = $_POST['action'];
            $managerReply = $_POST['manager_reply'] ?? '';

            // Get the adoption request
            $request = $adoptionRequestModel->first(['id' => $requestId]);
            if (!$request) {
                header("Location: /PetSpot_clinic/public/manager/adoption-requests");
                exit;
            }

            // Get adopter info from users table
            require_once __DIR__ . '/../models/User.php';
            $userModel = new User();
            $user = $userModel->first(['user_ID' => $request->user_ID]);
            $adopter_email = $user->email ?? $request->adopter_email ?? '';
            $adopter_name = $user->fullname ?? $request->adopter_name ?? '';

            // Get pet info (optional, for email)
            $pet = $foundPetModel->first(['found_ID' => $request->found_ID]);
            $pet_name = $pet->type . ' ' . $pet->breed;

            if ($action === 'accept') {
                $adoptionRequestModel->update($requestId, [
                    'status' => 'Accepted',
                    'manager_reply' => $managerReply
                ]);
                $foundPetModel->update($request->found_ID, ['status' => 'Adopted']);

                // Send email
                $mailService->sendAdoptionNotification(
                    $adopter_email,
                    $adopter_name,
                    $request->found_ID,
                    'Accepted',
                    $pet_name,
                    $managerReply
                );
            } elseif ($action === 'reject') {
                $adoptionRequestModel->update($requestId, [
                    'status' => 'Rejected',
                    'manager_reply' => $managerReply
                ]);

                // Send rejection email
                $mailService->sendAdoptionNotification(
                    $adopter_email,
                    $adopter_name,
                    $request->found_ID,
                    'Rejected',
                    $pet_name,
                    $managerReply
                );
            }

            header("Location: /PetSpot_clinic/public/manager/adoption-requests");
            exit;
        }
    }

    public function contactMessages()
    {
        if (empty($_SESSION['staff_role']) || $_SESSION['staff_role'] !== 'Manager') {
            header("Location: /PetSpot_clinic/public/login");
            exit;
        }
        require_once __DIR__ . '/../models/ContactMessage.php';
        $contactModel = new ContactMessage();
        $messages = $contactModel->findAll([], 'created_at DESC');
        include __DIR__ . '/../views/manager/contact_messages.view.php';
    }

    public function editFoundPet()
    {
        if (empty($_SESSION['staff_role']) || $_SESSION['staff_role'] !== 'Manager') {
            header("Location: /PetSpot_clinic/public/login");
            exit;
        }
        $foundPetModel = new FoundPet();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['found_ID'])) {
            $data = [
                'color' => $_POST['color'] ?? '',
                'special_markings' => $_POST['special_markings'] ?? '',
                'found_date' => $_POST['found_date'] ?? '',
                'found_location' => $_POST['found_location'] ?? '',
                'reporter_email' => $_POST['reporter_email'] ?? '',
                'type' => $_POST['type'] ?? '',
                'breed' => $_POST['breed'] ?? '',
                'gender' => $_POST['gender'] ?? '',
                'status' => $_POST['status'] ?? '',
            ];
            // Handle image upload if provided
            if (!empty($_FILES['image']['name'])) {
                $targetDir = "/PetSpot_clinic/public/uploads/";
                $targetFile = $targetDir . basename($_FILES["image"]["name"]);
                move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . $targetFile);
                $data['image_url'] = $targetFile;
            }
            $foundPetModel->update($_POST['found_ID'], $data);
            header("Location: /PetSpot_clinic/public/manager/manager-found");
            exit;
        } else {
            $found_ID = $_GET['id'] ?? null;
            if (!$found_ID) {
                header("Location: /PetSpot_clinic/public/manager/manager-found");
                exit;
            }
            $pet = $foundPetModel->first(['found_ID' => $found_ID]);
            include __DIR__ . '/../views/manager/edit_found_pet.view.php';
        }
    }

    public function deleteFoundPet()
    {
        if (empty($_SESSION['staff_role']) || $_SESSION['staff_role'] !== 'Manager') {
            header("Location: /PetSpot_clinic/public/login");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['found_ID'])) {
            $found_ID = $_POST['found_ID'];
            // Delete related adoption_requests first
            require_once __DIR__ . '/../models/AdoptionRequest.php';
            $adoptionRequestModel = new AdoptionRequest();
            $adoptionRequestModel->deleteByFoundId($found_ID);

            $foundPetModel = new FoundPet();
            $foundPetModel->delete($found_ID);
        }
        header("Location: /PetSpot_clinic/public/manager/manager-found");
        exit;
    }

    public function handleContactReply()
    {
        if (empty($_SESSION['staff_role']) || $_SESSION['staff_role'] !== 'Manager') {
            header("Location: /PetSpot_clinic/public/login");
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['message_id'])) {
            require_once __DIR__ . '/../models/ContactMessage.php';
            require_once __DIR__ . '/../services/MailService.php';

            $messageId = $_POST['message_id'];
            $replyMessage = $_POST['reply_message'] ?? '';
            $userEmail = $_POST['user_email'] ?? '';
            $userName = $_POST['user_name'] ?? '';

            if (empty($replyMessage) || empty($userEmail)) {
                $_SESSION['flash_message'] = "Reply message and email are required.";
                header("Location: /PetSpot_clinic/public/manager/contact-messages");
                exit;
            }

            // Update message as replied
            $contactModel = new ContactMessage();
            $contactModel->update($messageId, ['replied' => 1, 'reply_message' => $replyMessage]);

            // Send email reply
            $mailService = new MailService();
            $emailSent = $mailService->sendContactReply($userEmail, $userName, $replyMessage);

            if ($emailSent) {
                $_SESSION['flash_message'] = "Reply sent successfully to $userName.";
            } else {
                $_SESSION['flash_message'] = "Reply saved but email could not be sent.";
            }
        }

        header("Location: /PetSpot_clinic/public/manager/contact-messages");
        exit;
    }

    public function editPet()
    {
        if (empty($_SESSION['staff_role']) || $_SESSION['staff_role'] !== 'Manager') {
            header("Location: /PetSpot_clinic/public/login");
            exit;
        }
        
        $petModel = new Pet();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['pet_ID'])) {
            $data = [
                'name' => $_POST['name'] ?? '',
                'type' => $_POST['type'] ?? '',
                'breed' => $_POST['breed'] ?? '',
                'color' => $_POST['color'] ?? '',
                'gender' => $_POST['gender'] ?? '',
                'special_markings' => $_POST['special_markings'] ?? '',
                'status' => $_POST['status'] ?? '',
            ];
            
            // Handle image upload if provided
            if (!empty($_FILES['image']['name'])) {
                $targetDir = "/PetSpot_clinic/public/uploads/";
                $targetFile = $targetDir . basename($_FILES["image"]["name"]);
                move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . $targetFile);
                $data['image_url'] = $targetFile;
            }
            
            $petModel->update($_POST['pet_ID'], $data);
            $_SESSION['flash_message'] = "Pet profile updated successfully.";
            header("Location: /PetSpot_clinic/public/manager/pet-profiles");
            exit;
        } else {
            $pet_ID = $_GET['id'] ?? null;
            if (!$pet_ID) {
                header("Location: /PetSpot_clinic/public/manager/pet-profiles");
                exit;
            }
            $pet = $petModel->first(['pet_ID' => $pet_ID]);
            include __DIR__ . '/../views/manager/edit_pet.view.php';
        }
    }

    public function deletePet()
    {
        if (empty($_SESSION['staff_role']) || $_SESSION['staff_role'] !== 'Manager') {
            header("Location: /PetSpot_clinic/public/login");
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['pet_ID'])) {
            $petModel = new Pet();
            $petModel->delete($_POST['pet_ID']);
            $_SESSION['flash_message'] = "Pet profile deleted successfully.";
        }
        header("Location: /PetSpot_clinic/public/manager/pet-profiles");
        exit;
    }

    public function editPetView()
    {
        if (empty($_SESSION['staff_role']) || $_SESSION['staff_role'] !== 'Manager') {
            header("Location: /PetSpot_clinic/public/login");
            exit;
        }
        
        if (!empty($_GET['id'])) {
            $petModel = new Pet();
            $pet = $petModel->first(['pet_ID' => $_GET['id']]);
            if ($pet) {
                include __DIR__ . '/../views/manager/edit_pet.view.php';
            } else {
                $_SESSION['flash_message'] = "Pet not found.";
                header("Location: /PetSpot_clinic/public/manager/pet-profiles");
                exit;
            }
        } else {
            $_SESSION['flash_message'] = "Invalid pet ID.";
            header("Location: /PetSpot_clinic/public/manager/pet-profiles");
            exit;
        }
    }
}
?>