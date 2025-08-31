<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Pet.php';
require_once __DIR__ . '/../models/Prescription.php';

class PrescriptionController
{
    use Controller;

    public function add()
    {
        $users = [];
        $pets = [];
        $selectedOwner = null;
        $appointmentsByPet = [];

        // Fetch all users for the dropdown
        $userModel = new User();
        $allUsers = $userModel->findAll();

        // Step 1: Search for owner
        if (isset($_GET['owner_name'])) {
            $ownerName = trim($_GET['owner_name']);
            $query = "SELECT * FROM users WHERE fullname LIKE :name";
            $users = $userModel->query($query, ['name' => "%$ownerName%"]);
            if (count($users) === 1) {
                $selectedOwner = $users[0];
                $petModel = new Pet();
                $pets = $petModel->where(['user_ID' => $selectedOwner->user_ID]);

                // Fetch today's appointments for all pets of this owner
                $today = date('Y-m-d');
                $appointmentModel = new Appointment();
                foreach ($pets as $pet) {
                    $appointmentsByPet[$pet->pet_ID] = $appointmentModel->query(
                        "SELECT * FROM appointments WHERE pet_ID = :pet_ID AND date = :today ORDER BY time ASC",
                        ['pet_ID' => $pet->pet_ID, 'today' => $today]
                    );
                }
            }
        }

        // Handle dropdown selection
        if (isset($_GET['user_ID']) && $_GET['user_ID'] !== '') {
            $selectedOwner = $userModel->first(['user_ID' => $_GET['user_ID']]);
            if ($selectedOwner) {
                $petModel = new Pet();
                $pets = $petModel->where(['user_ID' => $selectedOwner->user_ID]);
                $today = date('Y-m-d');
                $appointmentModel = new Appointment();
                foreach ($pets as $pet) {
                    $appointmentsByPet[$pet->pet_ID] = $appointmentModel->query(
                        "SELECT * FROM appointments WHERE pet_ID = :pet_ID AND date = :today ORDER BY time ASC",
                        ['pet_ID' => $pet->pet_ID, 'today' => $today]
                    );
                }
            }
        }

        // Step 2: Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pet_ID'])) {
            $prescription = new Prescription();

            $medicines = isset($_POST['medicines']) ? $_POST['medicines'] : [];
            $dosages = isset($_POST['dosages']) ? $_POST['dosages'] : [];
            $drink_times = isset($_POST['drink_times']) ? $_POST['drink_times'] : [];
            if (!is_array($medicines)) $medicines = [$medicines];
            if (!is_array($dosages)) $dosages = [$dosages];
            if (!is_array($drink_times)) $drink_times = [$drink_times];

            $medicinesData = [];
            for ($i = 0; $i < count($medicines); $i++) {
                $medicinesData[] = [
                    'medicine' => $medicines[$i],
                    'dosage' => $dosages[$i] ?? '',
                    'drink_time' => $drink_times[$i] ?? ''
                ];
            }

            $pet_ID = $_POST['pet_ID'];
            $appointmentModel = new Appointment();
            
            // First, try to use the appointment_ID from the form
            $appointment_ID = $_POST['appointment_ID'] ?? null;
            
            // If no appointment_ID provided or it's empty, find the most recent appointment for this pet
            if (empty($appointment_ID)) {
                $appointment = $appointmentModel->query(
                    "SELECT appointment_ID FROM appointments WHERE pet_ID = :pet_ID ORDER BY date DESC, time DESC LIMIT 1",
                    ['pet_ID' => $pet_ID]
                );
                $appointment_ID = $appointment && isset($appointment[0]->appointment_ID) ? $appointment[0]->appointment_ID : null;
            }
            
            // Validate that the appointment_ID exists
            if ($appointment_ID) {
                $appointmentExists = $appointmentModel->first(['appointment_ID' => $appointment_ID]);
                if (!$appointmentExists) {
                    $appointment_ID = null; // Set to null if appointment doesn't exist
                }
            }

            $data = [
                'pet_ID' => $pet_ID,
                'medicines' => json_encode($medicinesData),
                'drink_times' => '',
                'note' => $_POST['note'],
                'user_ID' => $_POST['user_ID'],
                'staff_ID' => $_SESSION['staff_id'] ?? null,
                'appointment_ID' => $appointment_ID
            ];
            $prescription->insert($data);
            $success = true;
        }

        include __DIR__ . '/../views/vetstaff/prescription_add.view.php';
    }

    public function index()
    {
        $prescriptionModel = new Prescription();
        $prescriptions = $prescriptionModel->getAllWithUserAndAppointment();
        include __DIR__ . '/../views/vetstaff/prescriptions.view.php';
    }
}