<?php
require_once __DIR__ . '/../../models/AvailableSlot.php';
require_once __DIR__ . '/../../models/Appointment.php';
require_once __DIR__ . '/../../models/User.php';

class AddSlotController
{
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_SESSION['staff_id'])) {
                header('Location: /PetSpot_clinic/public/login');
                exit;
            }
            $date = $_POST['date'];
            $start_time = $_POST['start_time'];
            $end_time = $_POST['end_time'];
            $vet_staff_id = $_SESSION['staff_id'];
            $slotModel = new AvailableSlot();
            $slotModel->insert([
                'date' => $date,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'vet_staff_id' => $vet_staff_id
            ]);
            header('Location: /PetSpot_clinic/public/vet_slots');
            exit;
        }

        // Fetch appointments and analytics for this staff
        $appointmentModel = new Appointment();
        $staff_id = $_SESSION['staff_id'];
        $appointments = $appointmentModel->getAllAppointmentsWithPetAndOwner();

        $total = count($appointments);
        $upcoming = 0;
        $accepted = 0;
        $rejected = 0;
        $today = date('Y-m-d');

        foreach ($appointments as $appt) {
            if ($appt->date >= $today) $upcoming++;
            if (isset($appt->status)) {
                if ($appt->status === 'accepted') $accepted++;
                if ($appt->status === 'rejected') $rejected++;
            }
        }

        $newAppointments = $appointmentModel->countNewAppointmentsForVet($staff_id);

        // Pass $appointments, $total, $upcoming, $accepted, $rejected to the view
        include __DIR__ . '/../../views/vetstaff/Vet_add_slot.view.php';
    }

    public function updateAppointmentStatus()
    {
        if (empty($_SESSION['staff_id'])) {
            header('Location: /PetSpot_clinic/public/login');
            exit;
        }

        $appointmentId = $_POST['appointment_ID'] ?? null;
        $status = $_POST['action'] ?? null;

        // Convert action to status
        if ($status === 'accept') {
            $status = 'accepted';
        } elseif ($status === 'reject') {
            $status = 'rejected';
        }

        if (!$appointmentId || !$status) {
            $_SESSION['flash_message'] = "Invalid request.";
            header('Location: /PetSpot_clinic/public/vet_slots');
            exit;
        }

        $appointmentModel = new Appointment();
        $userModel = new User();

        // Update the appointment status
        $appointmentModel->updateStatus($appointmentId, $status);

        // If accepting and meeting_link is provided, update it
        if ($status === 'accepted' && !empty($_POST['meeting_link'])) {
            $appointmentModel->updateMeetingLink($appointmentId, $_POST['meeting_link']);
        }

        // Get appointment and user info
        $appointment = $appointmentModel->getById($appointmentId);
        $user = $userModel->getById($appointment->user_id);

        // Prepare variables for email template
        $userFullName = $user->fullname;
        $appointmentDate = $appointment->date;
        $appointmentTime = $appointment->time ?? '';
        $to = $user->email;

        // Render email body from template
        ob_start();
        include __DIR__ . '/../../views/emails/appointment_status.view.php';
        $emailBody = ob_get_clean();

        // Send email using MailService
        require_once __DIR__ . '/../../services/MailService.php';
        $mailService = new MailService();
        $emailSent = $mailService->sendGenericMail($to, "Your Appointment Status at PetSpot Clinic", $emailBody);

        // Send SMS using MailService
        $smsSent = $mailService->sendAppointmentStatusSMS($userFullName, $appointmentDate, $appointmentTime, $status);

        // Set a flash message
        if ($emailSent && $smsSent !== false) {
            $_SESSION['flash_message'] = "Email  have been sent to the user.";
        } elseif ($emailSent) {
            $_SESSION['flash_message'] = "Email sent, but SMS could not be sent.";
        } elseif ($smsSent !== false) {
            $_SESSION['flash_message'] = "SMS sent, but email could not be sent.";
        } else {
            $_SESSION['flash_message'] = "Failed to send email .";
        }

        // Redirect back to the appointments page
        header('Location: /PetSpot_clinic/public/vet_slots');
        exit;
    }
}