<?php
require_once __DIR__ . '/../../models/Vaccination.php';
require_once __DIR__ . '/../../models/Pet.php';

class VetVaccinationController
{
    public function index()
    {
        $vaccinationModel = new Vaccination();

        // If staff is logged in, show all
        if (!empty($_SESSION['staff_id'])) {
            $vaccinations = $vaccinationModel->findAll();
        } 
        // If user is logged in, show only their records
        else if (!empty($_SESSION['user_ID'])) {
            $vaccinations = $vaccinationModel->where(['user_ID' => $_SESSION['user_ID']]);
        } 
        // Not logged in, show nothing or redirect
        else {
            $vaccinations = [];
        }

        include __DIR__ . '/../../views/vetstaff/vaccinations.view.php';
    }

    
    public function add()
    {
        
        if (empty($_SESSION['staff_id'])) {
            // Only staff can access this page
            die("Access denied. Only staff can add vaccinations.");
        }

        $petModel = new Pet();
        $petModel->setLimit(1000); // Use the setter instead of direct property access
        $pets = $petModel->findAll(); // Staff sees all pets

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pet_ID = $_POST['pet_ID'];
            $pet = $petModel->first(['pet_ID' => $pet_ID]);
            if (!$pet) {
                die("Invalid pet selected. Please go back and select a valid pet.");
            }
            $user_ID = $pet->user_ID;
            $data = [
                'pet_ID' => $pet_ID,
                'vaccination_name' => $_POST['vaccination_name'],
                'vaccination_type' => $_POST['vaccination_type'],
                'date_of_last_vaccine' => $_POST['date_of_last_vaccine'],
                'next_due_date' => $_POST['next_due_date'],
                'user_ID' => $user_ID,
            ];
            $vaccinationModel = new Vaccination();
            $vaccinationModel->insert($data);
            header("Location: /PetSpot_clinic/public/vet_vaccinations/user/$user_ID");
            exit;
        }

        include __DIR__ . '/../../views/vetstaff/add_vaccination.view.php'; // Show add form
    }

    // Show vaccinations for a specific user (as staff)
    public function user($user_ID)
    {
        // Allow if staff is logged in, or if user is viewing their own records
        if (
            (!isset($_SESSION['user_ID']) || $_SESSION['user_ID'] != $user_ID)
            && (!isset($_SESSION['staff_id']))
        ) {
            die("Access denied. You can only view your own vaccination records.");
        }

        $vaccinationModel = new Vaccination();
        $vaccinations = $vaccinationModel->where(['user_ID' => $user_ID]);
        include __DIR__ . '/../../views/vetstaff/vaccinations.view.php';
    }

    public function edit()
    {
        if (empty($_SESSION['staff_id'])) {
            die("Access denied. Only staff can edit vaccinations.");
        }

        $vaccinationModel = new Vaccination();
        $petModel = new Pet();

        $vaccination_ID = $_GET['vaccination_ID'] ?? null;
        if (!$vaccination_ID) {
            die("No vaccination ID provided.");
        }

        $vaccination = $vaccinationModel->first(['vaccination_ID' => $vaccination_ID]);
        if (!$vaccination) {
            die("Vaccination record not found.");
        }

        $pets = $petModel->findAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'pet_ID' => $_POST['pet_ID'],
                'vaccination_name' => $_POST['vaccination_name'],
                'vaccination_type' => $_POST['vaccination_type'],
                'date_of_last_vaccine' => $_POST['date_of_last_vaccine'],
                'next_due_date' => $_POST['next_due_date'],
                'user_ID' => $_POST['user_ID'],
            ];
            $vaccinationModel->update($vaccination_ID, $data);
            header("Location: /PetSpot_clinic/public/vet_vaccinations");
            exit;
        }

        include __DIR__ . '/../../views/vetstaff/edit_vaccination.view.php';
    }

    public function delete()
    {
        if (empty($_SESSION['staff_id'])) {
            die("Access denied. Only staff can delete vaccinations.");
        }

        $vaccinationModel = new Vaccination();
        $vaccination_ID = $_GET['vaccination_ID'] ?? null;
        if (!$vaccination_ID) {
            die("No vaccination ID provided.");
        }

        $vaccinationModel->delete($vaccination_ID);
        header("Location: /PetSpot_clinic/public/vet_vaccinations");
        exit;
    }
}
