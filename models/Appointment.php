<?php
require_once __DIR__ . '/../core/Database.php';

class Appointment
{
    use Model;

    protected $table = 'appointments';
    protected $order_column = 'appointment_id'; 
    protected $primaryKey = 'appointment_id';   

    protected $allowedColumns = [
        'appointment_ID',
        'pet_ID',
        'user_id',
        'date',
        'time',
        'reason',
        'slot_id',
        'amount', // <-- add this line
        'status',
        'payment_status',
        'type', // <-- add this line
        'meeting_link',
        'cancellation_request'
    ];

    public function getAppointmentsByUser($user_id)
    {
        $query = "SELECT a.*, p.name as pet_name 
                  FROM {$this->table} a 
                  JOIN pets p ON a.pet_ID = p.pet_ID 
                  WHERE a.user_id = :user_id 
                  ORDER BY a.date DESC";
        return $this->query($query, ['user_id' => $user_id]);
    }

    public function getAllAppointmentsWithPetAndOwner()
    {
        $query = "SELECT a.*, p.name as pet_name, u.fullname as owner_name
                  FROM {$this->table} a
                  JOIN pets p ON a.pet_ID = p.pet_ID
                  JOIN users u ON a.user_id = u.user_ID
                  ORDER BY 
                    CASE 
                        WHEN a.date = CURDATE() THEN 0 
                        ELSE 1 
                    END,
                    a.date DESC, a.time ASC";
        return $this->query($query);
    }

    public function updateStatus($appointmentId, $status)
    {
        $query = "UPDATE {$this->table} SET status = :status WHERE appointment_ID = :appointment_ID";
        $this->query($query, [
            'status' => $status,
            'appointment_ID' => $appointmentId
        ]);
    }

    public function updatePaymentStatus($appointmentId, $status)
    {
        $query = "UPDATE {$this->table} SET payment_status = :status WHERE appointment_ID = :appointment_ID";
        $this->query($query, [
            'status' => $status,
            'appointment_ID' => $appointmentId
        ]);
    }

    public function updateMeetingLink($appointmentId, $link)
    {
        $query = "UPDATE {$this->table} SET meeting_link = :link WHERE appointment_ID = :appointment_ID";
        $this->query($query, [
            'link' => $link,
            'appointment_ID' => $appointmentId
        ]);
    }

    public function getAppointmentsForVetStaff($staff_id)
    {
        $query = "SELECT a.*, p.name as pet_name, u.fullname as owner_name
                  FROM {$this->table} a
                  JOIN pets p ON a.pet_ID = p.pet_ID
                  JOIN users u ON a.user_id = u.user_ID
                  JOIN available_slots s ON a.slot_id = s.slot_id
                  WHERE s.vet_staff_id = :staff_id
                  ORDER BY a.date DESC";
        return $this->query($query, ['staff_id' => $staff_id]);
    }
    
    public function countNewAppointmentsForVet($vet_staff_id)
    {
        
        $query = "SELECT COUNT(*) as count 
                  FROM appointments a
                  JOIN available_slots s ON a.slot_id = s.slot_id
                  WHERE s.vet_staff_id = :vet_staff_id AND (a.status IS NULL OR a.status = 'pending')";
        $result = $this->query($query, ['vet_staff_id' => $vet_staff_id]);
        return $result[0]->count ?? 0;
    }

    public function getById($appointmentId)
    {
        $query = "SELECT * FROM {$this->table} WHERE appointment_ID = :appointment_ID LIMIT 1";
        $result = $this->query($query, ['appointment_ID' => $appointmentId]);
        return $result ? $result[0] : null;
    }
    
    public function checkExistingAppointment($slot_id, $date, $time)
    {
        $query = "SELECT * FROM appointments WHERE slot_id = :slot_id AND date = :date AND time = :time";
        return $this->query($query, [
            'slot_id' => $slot_id,
            'date' => $date,
            'time' => $time
        ]);
    }
    
    public function countAll()
    {
        $result = $this->query("SELECT COUNT(*) as count FROM {$this->table}");
        return $result ? $result[0]->count : 0;
    }

    public function requestCancellation($appointmentId)
    {
        $query = "UPDATE {$this->table} SET cancellation_request = 'requested' WHERE appointment_ID = :appointment_ID";
        return $this->query($query, ['appointment_ID' => $appointmentId]);
    }

    public function getAppointmentsWithCancellationRequests()
    {
        $query = "SELECT a.*, p.name as pet_name, u.fullname as owner_name, u.email as owner_email
                  FROM {$this->table} a
                  JOIN pets p ON a.pet_ID = p.pet_ID
                  JOIN users u ON a.user_id = u.user_ID
                  WHERE a.cancellation_request = 'requested'
                  ORDER BY a.date DESC";
        return $this->query($query);
    }

    public function processCancellationRequest($appointmentId, $action)
    {
        if ($action === 'approve') {
            $query = "UPDATE {$this->table} SET status = 'cancelled', cancellation_request = 'approved' WHERE appointment_ID = :appointment_ID";
        } else {
            $query = "UPDATE {$this->table} SET cancellation_request = 'rejected' WHERE appointment_ID = :appointment_ID";
        }
        return $this->query($query, ['appointment_ID' => $appointmentId]);
    }
}