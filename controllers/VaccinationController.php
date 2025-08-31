<?php
// filepath: app/controllers/VaccinationController.php

require_once __DIR__ . '/../models/Vaccination.php';

class VaccinationController
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $vaccinationModel = new Vaccination();

        if (!empty($_SESSION['user_ID'])) {
            $vaccinations = $vaccinationModel->where(['user_ID' => $_SESSION['user_ID']]);
        } else {
            $vaccinations = [];
        }

        include __DIR__ . '/../views/vaccinations.view.php';
    }

    public function add()
    {
        require_once __DIR__ . '/../models/Pet.php';
        $petModel = new Pet();
        $pets = $petModel->findAll(); // Get all pets

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if pet_ID is set and valid
            $pet_ID = $_POST['pet_ID'];
            $pet = $petModel->first(['pet_ID' => $pet_ID]);
            if (!$pet) {
                // Show error and stop
                die("Invalid pet selected. Please go back and select a valid pet.");
            }

            $data = [
                'pet_ID' => $pet_ID,
                'vaccination_name' => $_POST['vaccination_name'],
                'vaccination_type' => $_POST['vaccination_type'],
                'date_of_last_vaccine' => $_POST['date_of_last_vaccine'],
                'next_due_date' => $_POST['next_due_date'],
                'user_ID' => $_POST['user_ID'],
            ];
            $vaccinationModel = new Vaccination();
            $vaccinationModel->insert($data);
            header('Location: /PetSpot_clinic/public/vaccinations');
            exit;
        }

        include __DIR__ . '/../../views/vetstaff/add_vaccination.view.php';
    }

    // Add methods for edit, delete as needed
}