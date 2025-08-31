<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Pet.php';
require_once __DIR__ . '/../models/HealthRecord.php';

class HealthRecordController
{
    use Controller;

    public function add()
    {
        $users = [];
        $pets = [];
        $selectedOwner = null;

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
            }
        }

        // Handle dropdown selection
        if (isset($_GET['user_ID']) && $_GET['user_ID'] !== '') {
            $selectedOwner = $userModel->first(['user_ID' => $_GET['user_ID']]);
            if ($selectedOwner) {
                $petModel = new Pet();
                $pets = $petModel->where(['user_ID' => $selectedOwner->user_ID]);
            }
        }

        // Step 2: Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pet_ID'])) {
            $record = new HealthRecord();
            $data = [
                'weight' => $_POST['weight'],
                'height' => $_POST['height'],
                'current_health_status' => $_POST['current_health_status'],
                'reactions_to_vaccines_before' => $_POST['reactions_to_vaccines_before'],
                'Allergies' => $_POST['Allergies'],
                'Health_check_date' => $_POST['Health_check_date'],
                'Note' => $_POST['Note'],
                'Previous_illness' => $_POST['Previous_illness'],
                'vaccination_ID' => $this->validVaccinationId($_POST['vaccination_ID'] ?? null),
                'user_ID' => $_POST['user_ID'],
                'pet_ID' => $_POST['pet_ID'],
                'Veterinarian_ID' => $_SESSION['staff_id'] ?? null
            ];
            $record->insert($data);
            $success = true;
        }

        include __DIR__ . '/../views/vetstaff/health_record_add.view.php';
    }

    public function staff_records()
    {
        if (empty($_SESSION['staff_id'])) {
            die("Access denied. Only staff can view this page.");
        }

        $healthRecordModel = new HealthRecord();
        // Show only records added by this vet staff
        $records = $healthRecordModel->where(['Veterinarian_ID' => $_SESSION['staff_id']]);

        include __DIR__ . '/../views/vetstaff/health_records_staff.view.php';
    }

    public function edit()
    {
        if (empty($_SESSION['staff_id'])) {
            die("Access denied.");
        }

        $healthRecordModel = new HealthRecord();
        $health_record_ID = $_GET['health_record_ID'] ?? null;
        if (!$health_record_ID) die("No record ID.");

        $record = $healthRecordModel->first(['health_record_ID' => $health_record_ID]);
        if (!$record) die("Record not found.");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'weight' => $_POST['weight'],
                'height' => $_POST['height'],
                'current_health_status' => $_POST['current_health_status'],
                'reactions_to_vaccines_before' => $_POST['reactions_to_vaccines_before'],
                'Allergies' => $_POST['Allergies'],
                'Health_check_date' => $_POST['Health_check_date'],
                'Note' => $_POST['Note'],
                'Previous_illness' => $_POST['Previous_illness'],
                'vaccination_ID' => !empty($_POST['vaccination_ID']) ? $_POST['vaccination_ID'] : null,
            ];
            $healthRecordModel->update($health_record_ID, $data);
            header("Location: /PetSpot_clinic/public/healthrecord/staff_records");
            exit;
        }

        include __DIR__ . '/../views/vetstaff/edit_health_record.view.php';
    }

    public function delete()
    {
        if (empty($_SESSION['staff_id'])) {
            die("Access denied.");
        }

        $healthRecordModel = new HealthRecord();
        $health_record_ID = $_GET['health_record_ID'] ?? null;
        if (!$health_record_ID) die("No record ID.");

        $healthRecordModel->delete($health_record_ID);
        header("Location: /PetSpot_clinic/public/healthrecord/staff_records");
        exit;
    }

    public function user_records()
    {
        if (empty($_SESSION['user_ID'])) {
            die("Access denied. Please log in.");
        }

        $healthRecordModel = new HealthRecord();
        // Show only records for this user with pet details
        $records = $healthRecordModel->getHealthRecordsByUser($_SESSION['user_ID']);

        include __DIR__ . '/../views/health_records_user.view.php';
    }

    // Add this helper function in your controller
    private function validVaccinationId($id) {
        if (empty($id)) return null;
        $vaccinationModel = new Vaccination();
        $vaccination = $vaccinationModel->first(['vaccination_ID' => $id]);
        return $vaccination ? $id : null;
    }
}