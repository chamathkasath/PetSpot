<?php

require_once __DIR__ . '/../models/Staff.php';

class StaffRegister
{
    use Controller;

    public function index()
    {
        // Only allow admin
        if (empty($_SESSION['admin_logged_in'])) {
            header('Location: /login');
            exit;
        }

        $staff = new Staff();
        $success = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($staff->register($_POST)) {
                $success = true;
            }
        }

        include __DIR__ . '/../views/admin/register_staff.view.php';
    }
}