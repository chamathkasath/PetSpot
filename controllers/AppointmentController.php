<?php
// filepath: c:\xampp\htdocs\PetSpot_clinic\app\controllers\AppointmentController.php
require_once __DIR__ . '/../models/Appointment.php';
require_once __DIR__ . '/../models/Pet.php';
require_once __DIR__ . '/../models/AvailableSlot.php';
require_once __DIR__ . '/../models/Prescription.php';
require_once __DIR__ . '/../models/Bill.php';

class AppointmentController
{
    public function index()
    {
        $appointmentModel = new Appointment();
        $prescriptionModel = new Prescription();
        $billModel = new Bill();

        // Fetch all appointments for the user (adjust user_ID as needed)
        $user_ID = $_SESSION['user_id'] ?? 6; // Example fallback
        $appointments = $appointmentModel->getAppointmentsByUser($user_ID);

        // Build appointmentBills: appointment_ID => array of bills
        $appointmentBills = [];
        foreach ($appointments as $appt) {
            $prescriptions = $prescriptionModel->where(['appointment_ID' => $appt->appointment_ID]);
            foreach ($prescriptions as $prescription) {
                $bill = $billModel->first(['prescription_ID' => $prescription->prescription_ID]);
                if ($bill) {
                    $appointmentBills[$appt->appointment_ID][] = $bill;
                }
            }
        }

        // Pass all needed variables to the view
        include __DIR__ . '/../views/appointment.view.php';
    }

    public function book()
    {
        // Check if user is logged in
        if (empty($_SESSION['user_ID'])) {
            header("Location: /PetSpot_clinic/public/login");
            exit;
        }

        // Get user ID from session
        $user_id = $_SESSION['user_ID'];

        // Create model instances
        $petModel = new Pet();
        $appointmentModel = new Appointment();
        $slotModel = new AvailableSlot();

        // Fetch user's pets
        $pets = $petModel->getPetsByUser($user_id);

        // Fetch available slots (only show unbooked slots to all users)
        $available_slots = $slotModel->query("SELECT * FROM available_slots WHERE is_booked = 0");

        // Fetch ALL appointments to check for booked slots (not just current user's)
        $allAppointments = $appointmentModel->query("SELECT * FROM appointments");
        
        // Fetch user's appointments for display
        $appointments = $appointmentModel->getAppointmentsByUser($user_id);

        
        $prescriptionModel = new Prescription();
        $billModel = new Bill();
        $appointmentBills = [];
        foreach ($appointments as $appt) {
            $prescriptions = $prescriptionModel->where(['appointment_ID' => $appt->appointment_ID]);
            foreach ($prescriptions as $prescription) {
                $bill = $billModel->first(['prescription_ID' => $prescription->prescription_ID]);
                if ($bill) {
                    $appointmentBills[$appt->appointment_ID][] = $bill;
                }
            }
        }
        // --- END BLOCK ---

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pet_ID = $_POST['pet_ID'] ?? null;
            $date = $_POST['date'] ?? null;
            $reason = $_POST['reason'] ?? null;

            // Parse slot_id and time from interval
            if (isset($_POST['interval'])) {
                $parts = explode('|', $_POST['interval']);
                $slot_id = $parts[0] ?? null;
                $time = $parts[1] ?? null;
            } else {
                $slot_id = null;
                $time = null;
            }

            // Check for duplicate booking for this slot, date, and time (block all users)
            $existing = $appointmentModel->query(
                "SELECT * FROM appointments WHERE slot_id = :slot_id AND date = :date AND time = :time",
                [
                    'slot_id' => $slot_id,
                    'date' => $date,
                    'time' => $time
                ]
            );

            if ($existing) {
                $error = "This appointment slot is already booked. Please select another slot.";
            } else {
                // Validate required fields
                if (!$pet_ID || !$date || !$slot_id || !$time) {
                    $error = "Please fill all required fields.";
                } else {
                    $type = $_POST['type'] ?? 'physical'; // default to physical

                    $appointmentModel->insert([
                        'pet_ID' => $pet_ID,
                        'user_id' => $user_id,
                        'slot_id' => $slot_id,
                        'date' => $date,
                        'time' => $time,
                        'reason' => $reason,
                        'amount' => 20.00,
                        'type' => $type // <-- add this line
                    ]);
                    header('Location: /PetSpot_clinic/public/appointments?success=1');
                    exit;
                }
            }
        }

        // Get selected date first
        $selected_date = $_POST['date'] ?? $_GET['date'] ?? date('Y-m-d');

        // Generate time intervals for available slots

        $intervals = [];
        foreach ($available_slots as $slot) {
            if (is_array($slot)) $slot = (object)$slot;
            if (!isset($slot->slot_id)) continue;
            // Only process slots for the selected date
            if (!isset($slot->date) || $slot->date !== $selected_date) continue;
            $slot_id = $slot->slot_id;

            $start = strtotime($slot->start_time);
            $end = strtotime($slot->end_time);
            while ($start + 20*60 <= $end) {
                $interval_start = date('H:i', $start);
                $interval_end = date('H:i', $start + 20*60);
                // Check if this interval is booked by ANY user for the selected date
                $is_booked = false;
                foreach ($allAppointments as $appt) {
                    if (
                        $appt->slot_id == $slot->slot_id &&
                        $appt->date == $selected_date &&
                        $appt->time == $interval_start
                    ) {
                        $is_booked = true;
                        break;
                    }
                }
                // Only add intervals that are not booked
                if (!$is_booked) {
                    $intervals[] = [
                        'slot_id' => $slot_id,
                        'date' => $selected_date,
                        'interval_start' => $interval_start,
                        'interval_end' => $interval_end,
                        'is_booked' => $is_booked,
                    ];
                }
                $start += 20*60;
            }
        }

        // No need to filter by date again, as only selected date slots are processed
        $filtered_intervals = $intervals;

        // Pass data to the view
        include __DIR__ . '/../views/appointment.view.php';
    }

    public function requestCancellation()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /PetSpot_clinic/public/appointment");
            exit;
        }

        $appointmentId = $_POST['appointment_id'] ?? null;
        if (!$appointmentId) {
            header("Location: /PetSpot_clinic/public/appointment");
            exit;
        }

        $appointmentModel = new Appointment();
        $appointment = $appointmentModel->getById($appointmentId);
        
        // Verify appointment belongs to logged-in user
        if (!$appointment || $appointment->user_id != $_SESSION['user_ID']) {
            header("Location: /PetSpot_clinic/public/appointment");
            exit;
        }

        // Request cancellation
        $appointmentModel->requestCancellation($appointmentId);
        
        header("Location: /PetSpot_clinic/public/appointment?message=cancellation_requested");
        exit;
    }

    public function processCancellationRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /PetSpot_clinic/public/vet_slots");
            exit;
        }

        $appointmentId = $_POST['appointment_id'] ?? null;
        $action = $_POST['action'] ?? null; // 'approve' or 'reject'

        if (!$appointmentId || !in_array($action, ['approve', 'reject'])) {
            header("Location: /PetSpot_clinic/public/vet_slots");
            exit;
        }

        $appointmentModel = new Appointment();
        $result = $appointmentModel->processCancellationRequest($appointmentId, $action);

        // Set flash message for feedback
        if ($action === 'approve') {
            $_SESSION['flash_message'] = "Cancellation request approved successfully. Email notification sent to user.";
        } else {
            $_SESSION['flash_message'] = "Cancellation request rejected. Email notification sent to user.";
        }

        header("Location: /PetSpot_clinic/public/vet_slots");
        exit;
    }
}
