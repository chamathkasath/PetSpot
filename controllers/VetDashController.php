<?php
require_once __DIR__ . '/../models/Appointment.php';
require_once __DIR__ . '/../models/User.php';

class VetDashController
{
    use Controller;

    public function index()
    {
        // Get appointment statistics
        $appointmentModel = new Appointment();
        $userModel = new User();
        
        // Get all appointments
        $totalAppointments = $appointmentModel->countAll();
        
        // Get upcoming appointments (today and future)
        $today = date('Y-m-d');
        $upcomingAppointments = $appointmentModel->query(
            "SELECT COUNT(*) as count FROM appointments WHERE date >= :today", 
            ['today' => $today]
        );
        $totalUpcoming = $upcomingAppointments ? $upcomingAppointments[0]->count : 0;
        
        // Get total users  
        $totalUsersResult = $userModel->query("SELECT COUNT(*) as count FROM users");
        $totalUsers = $totalUsersResult ? $totalUsersResult[0]->count : 0;
        
        // Dashboard view with correct data
        include __DIR__ . '/../views/vet/vetdash.view.php';
    }
}