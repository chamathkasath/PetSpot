<?php

require_once __DIR__ . '/../models/Pet.php';

class PetController
{
    use Controller;

    public function index()
    {
        $pet = new Pet();
        $pets = $pet->findAll();
        include __DIR__ . '/../views/list.view.php';
    }

    public function add()
    {
        $pet = new Pet();
        $success = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_SESSION['user_ID'])) {
                die('You must be logged in to register a pet.');
            }
            $_POST['user_ID'] = $_SESSION['user_ID']; // use user_ID as foreign key
            $_POST['status'] = 'active'; // Always set to active on add

            // Handle image upload
            if (!empty($_FILES['image']['name'])) {
                $targetDir = __DIR__ . '/../uploads/';
                if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
                $targetFile = $targetDir . basename($_FILES['image']['name']);
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    $_POST['image_url'] = '/PetSpot_clinic/app/uploads/' . basename($_FILES['image']['name']);
                }
            }

            if ($pet->validate($_POST)) {
                $petId = $pet->insert($_POST);
                header("Location: /PetSpot_clinic/public/pets/profile");
                exit;
            }
        }
        include __DIR__ . '/../views/pet.view.php';
    }

    public function profile()
    {
        $pet = new Pet();
        $userId = $_SESSION['user_ID'] ?? null;
        $pets = $pet->where(['user_ID' => $userId]); // use user_ID as foreign key
        include __DIR__ . '/../views/pets/profile.view.php';
    }

    public function reportLost()
    {
        $pet = new Pet();
        $petId = $_GET['pet_ID'] ?? null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $petId) {
            $data = [
                'status' => 'lost',
                'last_seen_location' => $_POST['last_seen_location'] ?? '',
                'last_seen_date' => $_POST['last_seen_date'] ?? '',
                'special_note' => $_POST['special_note'] ?? ''
            ];
            $pet->update($petId, $data);
        }
        header("Location: /PetSpot_clinic/public/pets/profile");
        exit;
    }

    public function markFound()
    {
        $pet = new Pet();
        $petId = $_GET['pet_ID'] ?? null;
        if ($petId) {
            $pet->update($petId, ['status' => 'active']);
        }
        header("Location: /PetSpot_clinic/public/pets/profile");
        exit;
    }

    public function edit()
    {
        $petModel = new Pet();
        $petId = $_GET['pet_ID'] ?? null;
        $success = '';
        if (!$petId) {
            header("Location: /PetSpot_clinic/public/pets/profile");
            exit;
        }
        $pet = $petModel->first(['pet_ID' => $petId]);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Keep user_ID and status unchanged unless lost fields are updated
            $_POST['user_ID'] = $pet->user_ID;
            $_POST['status'] = $pet->status;
            // Handle image upload
            if (!empty($_FILES['image']['name'])) {
                $targetDir = __DIR__ . '/../uploads/';
                if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
                $targetFile = $targetDir . basename($_FILES['image']['name']);
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    $_POST['image_url'] = '/PetSpot_clinic/app/uploads/' . basename($_FILES['image']['name']);
                }
            }
            if ($petModel->validate($_POST)) {
                $petModel->update($petId, $_POST);
                $success = "Pet updated successfully!";
                // Reload pet data
                $pet = $petModel->first(['pet_ID' => $petId]);
            }
        }
        include __DIR__ . '/../views/pet.view.php';
    }

    public function delete()
    {
        $pet_ID = $_GET['pet_ID'] ?? null;
        $petModel = new Pet();

        // Delete related appointments first
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM appointments WHERE pet_ID = :pet_ID");
        $stmt->execute(['pet_ID' => $pet_ID]);

        // Now delete the pet
        $petModel->delete($pet_ID);

        header("Location: /PetSpot_clinic/public/pets/list");
        exit;
    }

    public function lostPets()
    {
        $pet = new Pet();
        $lostPets = $pet->where(['status' => 'lost']);
        include __DIR__ . '/../views/pets/lost_pets.view.php';
    }
}