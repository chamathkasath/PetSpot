<?php
require_once __DIR__ . '/../models/Staff.php';

class StaffProfileController
{
    use Controller;

    private $staffModel;

    public function __construct()
    {
        $this->staffModel = new Staff();
    }

    public function index()
    {
        // Check if staff is logged in
        if (empty($_SESSION['staff_id'])) {
            header('Location: /PetSpot_clinic/public/login');
            exit;
        }

        $staff = $this->staffModel->first(['staff_id' => $_SESSION['staff_id']]);
        
        if (!$staff) {
            header('Location: /PetSpot_clinic/public/login');
            exit;
        }

        include __DIR__ . '/../views/staff_profile.view.php';
    }

    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_SESSION['staff_id'])) {
                header('Location: /PetSpot_clinic/public/login');
                exit;
            }

            $data = [
                'fullname' => $_POST['fullname'],
                'email' => $_POST['email'],
                'contact' => $_POST['contact']
            ];

            $result = $this->staffModel->update($_SESSION['staff_id'], $data, 'staff_id');
            
            if ($result) {
                $_SESSION['success'] = "Profile updated successfully!";
            } else {
                $_SESSION['error'] = "Failed to update profile. Please try again.";
            }
        }
        
        header('Location: /PetSpot_clinic/public/staff/profile');
        exit;
    }

    public function change_password()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_SESSION['staff_id'])) {
                header('Location: /PetSpot_clinic/public/login');
                exit;
            }

            $staff = $this->staffModel->first(['staff_id' => $_SESSION['staff_id']]);
            
            if (!$staff || !password_verify($_POST['current_password'], $staff->password)) {
                $_SESSION['error'] = "Current password is incorrect.";
                header('Location: /PetSpot_clinic/public/staff/profile');
                exit;
            }

            if ($_POST['new_password'] !== $_POST['confirm_password']) {
                $_SESSION['error'] = "New passwords do not match.";
                header('Location: /PetSpot_clinic/public/staff/profile');
                exit;
            }

            $data = [
                'password' => password_hash($_POST['new_password'], PASSWORD_DEFAULT)
            ];

            $result = $this->staffModel->update($_SESSION['staff_id'], $data, 'staff_id');
            
            if ($result) {
                $_SESSION['success'] = "Password changed successfully!";
            } else {
                $_SESSION['error'] = "Failed to change password. Please try again.";
            }
        }
        
        header('Location: /PetSpot_clinic/public/staff/profile');
        exit;
    }

    public function delete_account()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_SESSION['staff_id'])) {
                header('Location: /PetSpot_clinic/public/login');
                exit;
            }

            // Instead of deleting, we'll deactivate the account
            $data = [
                'status' => 'inactive'
            ];

            $result = $this->staffModel->update($_SESSION['staff_id'], $data, 'staff_id');
            
            if ($result) {
                // Logout the staff member
                session_destroy();
                header('Location: /PetSpot_clinic/public/login?message=account_deactivated');
            } else {
                $_SESSION['error'] = "Failed to deactivate account. Please try again.";
                header('Location: /PetSpot_clinic/public/staff/profile');
            }
        }
        exit;
    }
}
