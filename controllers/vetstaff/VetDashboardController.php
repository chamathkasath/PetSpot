<?php
// filepath: c:\xampp\htdocs\PetSpot_clinic\app\controllers\vetstaff\VetDashboardController.php
require_once __DIR__ . '/../../models/Appointment.php';
require_once __DIR__ . '/../../models/User.php';

class VetDashboardController
{
    public function index()
    {
        if (empty($_SESSION['staff_id'])) {
            header("Location: /PetSpot_clinic/public/login");
            exit;
        }

        $appointmentModel = new Appointment();
        $userModel = new User();

        // Total appointments
        $appointments = $appointmentModel->getAllAppointmentsWithPetAndOwner();
        $totalAppointments = count($appointments);

        // Total users
        $users = $userModel->findAll();
        $totalUsers = count($users);

        // Upcoming appointments (today or later)
        $today = date('Y-m-d');
        $upcomingAppointments = array_filter($appointments, function($a) use ($today) {
            return $a->date >= $today;
        });
        $totalUpcoming = count($upcomingAppointments);

        // Pass analytics to the dashboard view
        include __DIR__ . '/../../views/vetstaff/vdashboard.view.php';
    }
}