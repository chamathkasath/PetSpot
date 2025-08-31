<?php
require_once __DIR__ . '/../models/Pet.php';
require_once __DIR__ . '/../models/Staff.php';
require_once __DIR__ . '/../models/Appointment.php';
require_once __DIR__ . '/../models/Vaccination.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/AdoptionRequest.php';
require_once __DIR__ . '/../models/FoundPet.php';
require_once __DIR__ . '/../models/Bill.php';
require_once __DIR__ . '/../models/Feedback.php';

class AdminController

{
    use Controller;
    //only admin can see
    private $petModel;
    private $staffModel;
    private $appointmentModel;
    private $vaccinationModel;
    private $userModel;
    private $adoptionRequestModel; // <-- Add this line
    private $foundPetModel;        // <
    private $billModel;
    private $feedbackModel;
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
        $this->petModel = new Pet();
        $this->staffModel = new Staff();
        $this->appointmentModel = new Appointment();
        $this->vaccinationModel = new Vaccination();
        $this->userModel = new User();
        $this->adoptionRequestModel = new AdoptionRequest(); // <-- ADD THIS LINE
        $this->foundPetModel = new FoundPet(); // (optional, for clarity)
        $this->billModel = new Bill();
        $this->feedbackModel = new Feedback();
    }

    /**
     * Display the admin dashboard with counts of various entities.
     */
public function index()
{
    $petCount = $this->petModel->countAll();
    $staffCount = $this->staffModel->countAll();
    $appointmentCount = $this->appointmentModel->countAll();
    $vaccinationCount = $this->vaccinationModel->countAll();
    $ownerCount = $this->userModel->countOwners(); // Only pet owners

    include __DIR__ . '/../views/admin/dashboard.view.php';
}

public function petManagement()
{
    $owners = $this->userModel->getAllOwnersWithPets();
    include __DIR__ . '/../views/admin/pet_management.view.php';
}

public function editPet()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pet_ID'])) {
        $this->petModel->update($_POST['pet_ID'], [
            'name' => $_POST['name'],
            'species' => $_POST['species'],
            'breed' => $_POST['breed'],
            'age' => $_POST['age'],
            'gender' => $_POST['gender'],
            'status' => $_POST['status']
        ]);
        
        header('Location: /PetSpot_clinic/public/admin/pet-management?updated=1');
        exit;
    }
    
    if (isset($_GET['id'])) {
        $pet = $this->petModel->first(['pet_ID' => $_GET['id']]);
        include __DIR__ . '/../views/admin/edit_pet.view.php';
    } else {
        header('Location: /PetSpot_clinic/public/admin/pet-management');
        exit;
    }
}

public function deletePet()
{
    if (isset($_GET['id'])) {
        $this->petModel->delete($_GET['id']);
        header('Location: /PetSpot_clinic/public/admin/pet-management?deleted=1');
        exit;
    }
    header('Location: /PetSpot_clinic/public/admin/pet-management');
    exit;
}

public function users()
{
    $users = $this->userModel->findAll();
    include __DIR__ . '/../views/admin/users.view.php';
}

public function editUser()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_ID'])) {
        $this->userModel->update($_POST['user_ID'], [
            'fullname' => $_POST['fullname'],
            'username' => $_POST['username'],
            'address'  => $_POST['address'],
            'email'    => $_POST['email'],
            'contact'  => $_POST['contact'],
        ]);
        
        header('Location: /PetSpot_clinic/public/admin/users?updated=1');
        exit;
    }
    
    if (isset($_GET['id'])) {
        $user = $this->userModel->first(['user_ID' => $_GET['id']]);
        include __DIR__ . '/../views/admin/edit_user.view.php';
    } else {
        header('Location: /PetSpot_clinic/public/admin/users');
        exit;
    }
}

public function appointments()
{
    require_once __DIR__ . '/../models/Appointment.php';
    $appointmentModel = new Appointment();
    $appointments = $appointmentModel->getAllAppointmentsWithPetAndOwner();
    include __DIR__ . '/../views/admin/appointments.view.php';
}

public function deleteAppointment()
{
    if (isset($_GET['id'])) {
        $this->appointmentModel->delete($_GET['id']);
        header('Location: /PetSpot_clinic/public/admin/appointments?deleted=1');
        exit;
    }
    header('Location: /PetSpot_clinic/public/admin/appointments');
    exit;
}

public function adoptedPets()
{
    // Example: pets.status = 'adopted' and join with users table
    $sql = "SELECT p.*, u.fullname, u.email, a.requested_at as adopted_date
            FROM pets p
            JOIN users u ON p.user_ID = u.user_ID
            LEFT JOIN adoption_requests a ON a.user_ID = u.user_ID AND a.status = 'Accepted' AND a.found_ID = p.pet_ID
            WHERE p.status = 'adopted'";
    $adoptedPets = $this->petModel->query($sql);
    include __DIR__ . '/../views/admin/adopted_pets.view.php';
}

public function adoptionRequests()
{
    require_once __DIR__ . '/../models/AdoptionRequest.php';
    require_once __DIR__ . '/../models/User.php';
    require_once __DIR__ . '/../models/FoundPet.php';
    
    $adoptionRequestModel = new AdoptionRequest();
    $userModel = new User();
    $foundPetModel = new FoundPet();

    $requests = $adoptionRequestModel->findAll([], 'requested_at DESC');
    foreach ($requests as $req) {
        $user = $userModel->first(['user_ID' => $req->user_ID]);
        $pet = $foundPetModel->first(['found_ID' => $req->found_ID]);
        $req->adopter_name = $user->fullname ?? '';
        $req->adopter_email = $user->email ?? '';
        $req->pet_name = ($pet->type ?? '') . ' ' . ($pet->breed ?? '');
    }

    include __DIR__ . '/../views/admin/adopted_pets.view.php';
}

public function handleAdoptionRequest()
{
    if (empty($_SESSION['admin_id'])) {
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
        $adminReply = $_POST['admin_reply'] ?? '';

        // Get the adoption request
        $request = $adoptionRequestModel->first(['id' => $requestId]);
        if (!$request) {
            header("Location: /PetSpot_clinic/public/admin/adoption-requests");
            exit;
        }

        // Get adopter info from users table
        $userModel = new User();
        $user = $userModel->first(['user_ID' => $request->user_ID]);
        $adopter_email = $user->email ?? '';
        $adopter_name = $user->fullname ?? '';

        // Get pet info (optional, for email)
        $pet = $foundPetModel->first(['found_ID' => $request->found_ID]);
        $pet_name = ($pet->type ?? '') . ' ' . ($pet->breed ?? '');

        if ($action === 'accept') {
            $adoptionRequestModel->update($requestId, [
                'status' => 'Accepted',
                'manager_reply' => $adminReply
            ]);
            $foundPetModel->update($request->found_ID, ['status' => 'Adopted']);

            // Send email
            $mailService->sendAdoptionNotification(
                $adopter_email,
                $adopter_name,
                $request->found_ID,
                'Accepted',
                $pet_name,
                $adminReply
            );
        } elseif ($action === 'reject') {
            $adoptionRequestModel->update($requestId, [
                'status' => 'Rejected',
                'manager_reply' => $adminReply
            ]);

            // Send rejection email
            $mailService->sendAdoptionNotification(
                $adopter_email,
                $adopter_name,
                $request->found_ID,
                'Rejected',
                $pet_name,
                $adminReply
            );
        }

        $_SESSION['flash_message'] = "Adoption request " . ($action === 'accept' ? 'accepted' : 'rejected') . " successfully.";
        header("Location: /PetSpot_clinic/public/admin/adoption-requests");
        exit;
    }
}

public function dashboard()
{
    $appointmentModel = new Appointment();
    $appointments = $appointmentModel->getAllAppointmentsWithPetAndOwner();
    include __DIR__ . '/../views/admin/dashboard.view.php';
}

public function staff()
{
    $staff = $this->staffModel->findAll();
    include __DIR__ . '/../views/admin/staff.view.php';
}

public function deleteUser()
{
    if (isset($_GET['id'])) {
        $this->userModel->delete($_GET['id']); // <-- pass only the ID
        header('Location: /PetSpot_clinic/public/admin/users?deleted=1');
        exit;
    }
    header('Location: /PetSpot_clinic/public/admin/users');
    exit;
}

public function deleteStaff()
{
    if (isset($_GET['id'])) {
        $this->staffModel->delete($_GET['id']); // <-- pass only the ID
    }
    header('Location: /PetSpot_clinic/public/admin/staff');
    exit;
}

public function editStaff()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['staff_id'])) {
        $this->staffModel->update($_POST['staff_id'], [
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'role' => $_POST['role'],
            // add other fields as needed
        ]);
        header('Location: /PetSpot_clinic/public/admin/staff');
        exit;
    }
    $staff = $this->staffModel->first(['staff_id' => $_GET['id']]);
    include __DIR__ . '/../views/admin/edit_staff.view.php';
}

public function reports()
{
    require_once __DIR__ . '/../models/Appointment.php';
    $appointmentModel = new Appointment();

    
    // Get pets data per month for the current year
    // Lost pets per month
    $lostPetsData = $this->petModel->query(
        "SELECT MONTH(last_seen_date) as month, COUNT(*) as count 
         FROM pets 
         WHERE status = 'lost' AND YEAR(last_seen_date) = YEAR(CURDATE())
         GROUP BY MONTH(last_seen_date)"
    );
    $lostPetsPerMonth = array_fill(1, 12, 0);
    foreach ($lostPetsData as $row) {
        $lostPetsPerMonth[(int)$row->month] = (int)$row->count;
    }

    // Found pets per month
    $foundPetsData = $this->foundPetModel->query(
        "SELECT MONTH(found_date) as month, COUNT(*) as count 
         FROM found_pets 
         WHERE YEAR(found_date) = YEAR(CURDATE())
         GROUP BY MONTH(found_date)"
    );
    $foundPetsPerMonth = array_fill(1, 12, 0);
    foreach ($foundPetsData as $row) {
        $foundPetsPerMonth[(int)$row->month] = (int)$row->count;
    }

    // Adopted pets per month
    $adoptedPetsData = $this->adoptionRequestModel->query(
        "SELECT MONTH(requested_at) as month, COUNT(*) as count 
         FROM adoption_requests 
         WHERE status = 'Accepted' AND YEAR(requested_at) = YEAR(CURDATE())
         GROUP BY MONTH(requested_at)"
    );
    $adoptedPetsPerMonth = array_fill(1, 12, 0);
    foreach ($adoptedPetsData as $row) {
        $adoptedPetsPerMonth[(int)$row->month] = (int)$row->count;
    }

    // Get total counts for dashboard cards
    $totalUsers = $this->userModel->countAll();
    $totalAdoptedPets = $this->adoptionRequestModel->query("SELECT COUNT(*) as count FROM adoption_requests WHERE status = 'Accepted'")[0]->count ?? 0;
    $totalFoundPets = $this->foundPetModel->countAll();
    // Get revenue data per month for the current year from bill table
    $revenuePerMonth = array_fill(1, 12, 0);
    
    // Get all bills for this year by joining with prescriptions and appointments
    $billRevenue = $this->billModel->query(
        "SELECT b.total_price, a.date 
         FROM bill b 
         JOIN prescriptions p ON b.prescription_ID = p.prescription_ID 
         JOIN appointments a ON p.appointment_ID = a.appointment_ID 
         WHERE YEAR(a.date) = YEAR(CURDATE())"
    );
    
    foreach ($billRevenue as $bill) {
        $month = (int)date('m', strtotime($bill->date));
        $revenuePerMonth[$month] += floatval($bill->total_price);
    }
    
    // Get total revenue from all bills
    $totalRevenue = $this->billModel->getTotalRevenue();

    // Get feedback statistics for rating analysis
    $allFeedback = $this->feedbackModel->query(
        "SELECT f.*, u.fullname, u.email 
         FROM feedback f 
         LEFT JOIN users u ON f.user_ID = u.user_ID 
         ORDER BY f.feedback_id DESC"
    );
    
    // Calculate feedback statistics
    $totalFeedback = count($allFeedback);
    $averageRating = 0;
    $ratingCounts = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
    
    if ($totalFeedback > 0) {
        $totalRating = 0;
        foreach ($allFeedback as $feedback) {
            $totalRating += $feedback->rate;
            if (isset($ratingCounts[$feedback->rate])) {
                $ratingCounts[$feedback->rate]++;
            }
        }
        $averageRating = round($totalRating / $totalFeedback, 1);
    }

    include __DIR__ . '/../views/admin/reports.view.php';
}



public function export_appointments()
{
    $appointments = $this->appointmentModel->getAllAppointmentsWithPetAndOwner(); // Ensures full data
    
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename=appointments_full.csv'); // Different filename
    $output = fopen('php://output', 'w');
    
    fputcsv($output, [
        'Appointment ID', 'User ID', 'Pet ID', 'Pet Name', 'Owner Name',
        'Date', 'Time', 'Status', 'Reason', 'Slot ID',
        'Amount', 'Payment Status', 'Type', 'Meeting Link'
    ]);
    
    foreach ($appointments as $a) {
        fputcsv($output, [
            $a->appointment_ID ?? '',
            $a->user_id ?? '',
            $a->pet_ID ?? '',
            $a->pet_name ?? '',
            $a->owner_name ?? '',
            $a->date ?? '',
            $a->time ?? '',
            $a->status ?? '',
            $a->reason ?? '',
            $a->slot_id ?? '',
            $a->amount ?? '',
            $a->payment_status ?? '',
            $a->type ?? '',
            $a->meeting_link ?? ''
        ]);
    }
    fclose($output);
    exit;
}

public function export_vaccinations()
{
    $vaccinations = $this->vaccinationModel->findAll();
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=vaccinations.csv');
    $output = fopen('php://output', 'w');
    fputcsv($output, ['Vaccination ID', 'Pet ID', 'User ID' , 'Vaccine Name','Vaccination Type', 'Date of Last Vaccine', 'Next Due Date']);
    foreach ($vaccinations as $v) {
        fputcsv($output, [
            $v->vaccination_ID ?? '',
            $v->pet_ID ?? '',
            $v->user_ID ?? '',
            $v->vaccination_name ?? '',
            $v->vaccination_type ?? '',
            $v->date_of_last_vaccine ?? '',
            $v->next_due_date ?? '',
           
        ]);
    }
    fclose($output);
    exit;
}

public function export_adopted_pets()
{
    // Join adoption_requests and found_pets for richer export
    $sql = "SELECT 
            ar.id AS adoption_id,
            ar.found_ID,
            ar.user_ID,
            u.fullname AS adopter_name,
            u.email AS adopter_email,
            ar.requested_at,
            ar.status,
            fp.type AS pet_type,
            fp.breed AS pet_breed,
            fp.color AS pet_color,
            fp.gender AS pet_gender,
            fp.special_markings,
            fp.found_date,
            fp.found_location
        FROM adoption_requests ar
        LEFT JOIN found_pets fp ON ar.found_ID = fp.found_ID
        LEFT JOIN users u ON ar.user_ID = u.user_ID
        WHERE ar.status = 'approved'";
    $adoptions = $this->adoptionRequestModel->query($sql);

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=adopted_pets.csv');
    $output = fopen('php://output', 'w');
    fputcsv($output, [
        'Adoption ID', 'Found ID', 'User ID', 'Adopter Name', 'Adopter Email', 'Requested At', 'Status',
        'Pet Type', 'Pet Breed', 'Pet Color', 'Pet Gender', 'Special Markings', 'Found Date', 'Found Location'
    ]);
    foreach ($adoptions as $a) {
        fputcsv($output, [
            $a->adoption_id ?? '',
            $a->found_ID ?? '',
            $a->user_ID ?? '',
            $a->adopter_name ?? '',
            $a->adopter_email ?? '',
            $a->requested_at ?? '',
            $a->status ?? '',
            $a->pet_type ?? '',
            $a->pet_breed ?? '',
            $a->pet_color ?? '',
            $a->pet_gender ?? '',
            $a->special_markings ?? '',
            $a->found_date ?? '',
            $a->found_location ?? ''
        ]);
    }
    fclose($output);
    exit;
}

public function export_payments()
{
    $billModel = new Bill();
    $bills = $billModel->findAll();
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=payments.csv');
    $output = fopen('php://output', 'w');
    fputcsv($output, ['Bill ID', 'Prescription ID', 'Total Price', 'User ID', 'Payment Method', 'Note']);
    foreach ($bills as $b) {
        fputcsv($output, [
            $b->bill_ID ?? '',
            $b->prescription_ID ?? '',
            $b->total_price ?? '',
            $b->user_ID ?? '',
            $b->payment_method ?? '',
            $b->note ?? ''
        ]);
    }
    fclose($output);
    exit;
}
public function export_pets_lost_active()
{
    // Get lost and active pets with owner info
    $pets = $this->petModel->query(
        "SELECT p.*, u.fullname as owner_name, u.email as owner_email
         FROM pets p
         LEFT JOIN users u ON p.user_ID = u.user_ID
         WHERE p.status IN ('lost', 'active')
         ORDER BY p.status, p.name"
    );

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename=pets_lost_active.csv');
    $output = fopen('php://output', 'w');
    
    // CSV headers
    fputcsv($output, [
        'Pet ID', 'Status', 'Name', 'Species', 'Breed', 'Age', 'Gender',
        'Microchip ID', 'Last Seen Date', 'Last Seen Location',
        'Owner Name', 'Owner Email'
    ]);
    
    // CSV data rows
    foreach ($pets as $pet) {
        fputcsv($output, [
            $pet->pet_ID ?? '',
            $pet->status ?? '',
            $pet->name ?? '',
            $pet->species ?? '',
            $pet->breed ?? '',
            $pet->age ?? '',
            $pet->gender ?? '',
            $pet->microchip_id ?? '',
            $pet->last_seen_date ?? '',
            $pet->last_seen_location ?? '',
            $pet->owner_name ?? '',
            $pet->owner_email ?? ''
        ]);
    }
    fclose($output);
    exit;
}
public function export_found_pets()
{
    // Get all found pets with reporter details
    $foundPets = $this->foundPetModel->getAllWithDetails();
    
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename=found_pets_export_' . date('Y-m-d') . '.csv');
    $output = fopen('php://output', 'w');
    
    // CSV headers
    fputcsv($output, [
        'Found ID', 'Type', 'Breed', 'Color', 'Gender', 'Age',
        'Special Markings', 'Found Date', 'Found Location', 'Status',
        'Reporter Name', 'Reporter Email', 'Image URL', 'Created At'
    ]);
    
    // CSV data rows
    foreach ($foundPets as $pet) {
        fputcsv($output, [
            $pet->found_ID ?? '',
            $pet->type ?? '',
            $pet->breed ?? '',
            $pet->color ?? '',
            $pet->gender ?? '',
            $pet->age ?? '',
            $pet->special_markings ?? '',
            $pet->found_date ?? '',
            $pet->found_location ?? '',
            $pet->status ?? '',
            $pet->reporter_name ?? 'System',
            $pet->reporter_email ?? '',
            $pet->image_url ?? '',
            $pet->created_at ?? ''
        ]);
    }
    
    fclose($output);
    exit;
}
public function vaccinations()
{
    $vaccinationModel = new Vaccination();
    $vaccinations = $vaccinationModel->findAll(); // Fetch all vaccination records
    include __DIR__ . '/../views/admin/vaccinations.view.php'; // Load the view
}

public function deleteVaccination()
{
    if (isset($_GET['vaccination_ID'])) {
        $this->vaccinationModel->delete($_GET['vaccination_ID']);
        header('Location: /PetSpot_clinic/public/admin/vaccinations?deleted=1');
        exit;
    }
    header('Location: /PetSpot_clinic/public/admin/vaccinations');
    exit;
}

// Feedback Management Methods
public function feedbacks()
{
    $allFeedback = $this->feedbackModel->query(
        "SELECT f.*, u.fullname, u.email 
         FROM feedback f 
         LEFT JOIN users u ON f.user_ID = u.user_ID 
         ORDER BY f.feedback_id DESC"
    );
    
    // Calculate statistics
    $totalFeedback = count($allFeedback);
    $averageRating = 0;
    $ratingCounts = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
    
    if ($totalFeedback > 0) {
        $totalRating = 0;
        foreach ($allFeedback as $feedback) {
            $totalRating += $feedback->rate;
            if (isset($ratingCounts[$feedback->rate])) {
                $ratingCounts[$feedback->rate]++;
            }
        }
        $averageRating = round($totalRating / $totalFeedback, 1);
    }
    
    include __DIR__ . '/../views/admin/feedbacks.view.php';
}

public function deleteFeedback()
{
    if (isset($_GET['id'])) {
        $this->feedbackModel->delete($_GET['id']);
        header('Location: /PetSpot_clinic/public/admin/feedbacks?deleted=1');
        exit;
    }
    header('Location: /PetSpot_clinic/public/admin/feedbacks');
    exit;
}

// Found Pets Management Methods
public function foundPets()
{
    $foundPets = $this->foundPetModel->findAll();
    include __DIR__ . '/../views/admin/found_pets.view.php';
}

public function addFoundPet()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'user_ID' => null, // Admin added, no specific user
            'type' => $_POST['type'],
            'breed' => $_POST['breed'],
            'gender' => $_POST['gender'],
            'color' => $_POST['color'],
            'special_markings' => $_POST['special_markings'],
            'found_date' => $_POST['found_date'],
            'found_location' => $_POST['found_location'],
            'reporter_email' => $_POST['reporter_email'],
            'status' => $_POST['status'] ?? 'Unclaimed'
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

        $this->foundPetModel->insert($data);
        header('Location: /PetSpot_clinic/public/admin/found-pets?added=1');
        exit;
    }
    
    include __DIR__ . '/../views/admin/add_found_pet.view.php';
}

public function editFoundPet()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['found_ID'])) {
        $data = [
            'type' => $_POST['type'],
            'breed' => $_POST['breed'],
            'gender' => $_POST['gender'],
            'color' => $_POST['color'],
            'special_markings' => $_POST['special_markings'],
            'found_date' => $_POST['found_date'],
            'found_location' => $_POST['found_location'],
            'reporter_email' => $_POST['reporter_email'],
            'status' => $_POST['status']
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

        $this->foundPetModel->update($_POST['found_ID'], $data);
        header('Location: /PetSpot_clinic/public/admin/found-pets?updated=1');
        exit;
    }
    
    if (isset($_GET['id'])) {
        $foundPet = $this->foundPetModel->first(['found_ID' => $_GET['id']]);
        include __DIR__ . '/../views/admin/edit_found_pet.view.php';
    } else {
        header('Location: /PetSpot_clinic/public/admin/found-pets');
        exit;
    }
}

public function deleteFoundPet()
{
    if (isset($_GET['id'])) {
        $this->foundPetModel->delete($_GET['id']);
        header('Location: /PetSpot_clinic/public/admin/found-pets?deleted=1');
        exit;
    }
    header('Location: /PetSpot_clinic/public/admin/found-pets');
    exit;
}

// Health Records Management Methods
public function healthRecords()
{
    require_once __DIR__ . '/../models/HealthRecord.php';
    $healthRecordModel = new HealthRecord();
    $healthRecords = $healthRecordModel->getAllHealthRecordsWithDetails();
    include __DIR__ . '/../views/admin/health_records.view.php';
}

public function editHealthRecord()
{
    require_once __DIR__ . '/../models/HealthRecord.php';
    $healthRecordModel = new HealthRecord();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['record_ID'])) {
        $data = [
            'pet_ID' => $_POST['pet_ID'],
            'user_ID' => $_POST['user_ID'],
            'weight' => $_POST['weight'],
            'height' => $_POST['height'],
            'current_health_status' => $_POST['current_health_status'],
            'reactions_to_vaccines_before' => $_POST['reactions_to_vaccines_before'],
            'Allergies' => $_POST['Allergies'],
            'Health_check_date' => $_POST['Health_check_date'],
            'Note' => $_POST['Note'],
            'Previous_illness' => $_POST['Previous_illness']
        ];

        $healthRecordModel->update($_POST['record_ID'], $data);
        header('Location: /PetSpot_clinic/public/admin/health-records?updated=1');
        exit;
    }
    
    if (isset($_GET['id'])) {
        $healthRecord = $healthRecordModel->getHealthRecordWithDetails($_GET['id']);
        $petModel = new Pet();
        $userModel = new User();
        $pets = $petModel->findAll();
        $users = $userModel->findAll();
        include __DIR__ . '/../views/admin/edit_health_record.view.php';
    } else {
        header('Location: /PetSpot_clinic/public/admin/health-records');
        exit;
    }
}

public function deleteHealthRecord()
{
    if (isset($_GET['id'])) {
        require_once __DIR__ . '/../models/HealthRecord.php';
        $healthRecordModel = new HealthRecord();
        $healthRecordModel->delete($_GET['id']);
        header('Location: /PetSpot_clinic/public/admin/health-records?deleted=1');
        exit;
    }
    header('Location: /PetSpot_clinic/public/admin/health-records');
    exit;
}
}
?>