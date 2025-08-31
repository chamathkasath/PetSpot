<?php
require_once __DIR__ . '/../core/Database.php';

class HealthRecord
{
    use Model;

    protected $table = 'health_records'; // or your actual table name
    protected $primaryKey = 'health_record_ID'; // or your actual primary key
    protected $order_column = 'health_record_ID'; // <-- Add this line

    protected $allowedColumns = [
        'pet_ID',
        'user_ID',
        'weight',
        'height',
        'current_health_status',
        'reactions_to_vaccines_before',
        'Allergies',
        'Health_check_date',
        'Note',
        'Previous_illness',
        'vaccination_ID',
        'Veterinarian_ID'
    ];

    public function updateHealthRecord($health_record_ID)
    {
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
                'vaccination_ID' => $this->validVaccinationId($_POST['vaccination_ID'] ?? null),
            ];
            $this->update($health_record_ID, $data);
            header("Location: /PetSpot_clinic/public/healthrecord/staff_records");
            exit;
        }
    }
    
    public function validVaccinationId($id) {
        if (empty($id)) return null;
        // You may need to require the Vaccination model if not already loaded
        require_once __DIR__ . '/Vaccination.php';
        $vaccinationModel = new Vaccination();
        $vaccination = $vaccinationModel->first(['vaccination_ID' => $id]);
        return $vaccination ? $id : null;
    }

    public function getAllHealthRecordsWithDetails()
    {
        $sql = "SELECT 
                    hr.*,
                    p.name as pet_name,
                    p.type as pet_type,
                    p.breed as pet_breed,
                    u.fullname as owner_name,
                    u.email as owner_email,
                    s.username as vet_name
                FROM health_records hr
                LEFT JOIN pets p ON hr.pet_ID = p.pet_ID
                LEFT JOIN users u ON hr.user_ID = u.user_ID
                LEFT JOIN staff s ON hr.Veterinarian_ID = s.staff_id
                ORDER BY hr.Health_check_date DESC";
        
        return $this->query($sql);
    }

    public function getHealthRecordWithDetails($recordId)
    {
        $sql = "SELECT 
                    hr.*,
                    p.name as pet_name,
                    p.type as pet_type,
                    p.breed as pet_breed,
                    u.fullname as owner_name,
                    u.email as owner_email,
                    s.username as vet_name
                FROM health_records hr
                LEFT JOIN pets p ON hr.pet_ID = p.pet_ID
                LEFT JOIN users u ON hr.user_ID = u.user_ID
                LEFT JOIN staff s ON hr.Veterinarian_ID = s.staff_id
                WHERE hr.health_record_ID = :record_id
                LIMIT 1";
        
        $result = $this->query($sql, ['record_id' => $recordId]);
        return $result ? $result[0] : null;
    }

    public function getHealthRecordsByUser($userId)
    {
        $sql = "SELECT 
                    hr.*,
                    p.name as pet_name,
                    p.type as pet_type,
                    p.breed as pet_breed,
                    u.fullname as owner_name,
                    u.email as owner_email,
                    s.username as vet_name
                FROM health_records hr
                LEFT JOIN pets p ON hr.pet_ID = p.pet_ID
                LEFT JOIN users u ON hr.user_ID = u.user_ID
                LEFT JOIN staff s ON hr.Veterinarian_ID = s.staff_id
                WHERE hr.user_ID = :user_id
                ORDER BY hr.Health_check_date DESC";
        
        return $this->query($sql, ['user_id' => $userId]);
    }
}