<?php
require_once __DIR__ . '/../core/Database.php';

class Prescription
{
    use Model;
    protected $table = "prescriptions";
    protected $order_column = "prescription_ID"; // <-- Add this line
    protected $allowedColumns = [
        "pet_ID", "medicines", "drink_times", "note", "user_ID", "staff_ID", "appointment_ID"
    ];

    public function getAllWithUserAndAppointment()
    {
        $query = "SELECT p.*, u.fullname, u.email, a.appointment_ID, pets.name AS pet_name
                  FROM prescriptions p
                  JOIN users u ON p.user_ID = u.user_ID
                  LEFT JOIN appointments a ON p.appointment_ID = a.appointment_ID
                  JOIN pets ON p.pet_ID = pets.pet_ID
                  ORDER BY p.prescription_ID DESC";
        return $this->query($query);
    }
}