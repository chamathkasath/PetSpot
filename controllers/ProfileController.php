<?php
require_once __DIR__ . '/../models/User.php';

class ProfileController
{
    public function index()
    {
        if (!isset($_SESSION['user_ID'])) {
            header('Location: /PetSpot_clinic/public/login');
            exit;
        }
        
        $userModel = new User();
        $user = $userModel->first(['user_ID' => $_SESSION['user_ID']]);
        
        if (!$user) {
            header('Location: /PetSpot_clinic/public/login');
            exit;
        }
        
        include __DIR__ . '/../views/profile.view.php';
    }

    public function edit()
    {
        error_log("ProfileController::edit() called");
        error_log("POST data: " . print_r($_POST, true));
        
        if (!isset($_SESSION['user_ID'])) {
            error_log("No user_ID in session");
            header('Location: /PetSpot_clinic/public/login');
            exit;
        }

        error_log("User ID: " . $_SESSION['user_ID']);

        $userModel = new User();
        
        // Validate input
        $errors = [];
        
        if (empty($_POST['fullname'])) {
            $errors[] = "Full name is required";
        }
        
        if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Valid email is required";
        }
        
        // Check if email already exists for another user
        $existingUser = $userModel->first(['email' => $_POST['email']]);
        if ($existingUser && $existingUser->user_ID != $_SESSION['user_ID']) {
            $errors[] = "Email already exists for another account";
        }
        
        if (!empty($errors)) {
            $_SESSION['error'] = implode(', ', $errors);
            header('Location: /PetSpot_clinic/public/profile');
            exit;
        }
        
        $data = [
            'fullname' => trim($_POST['fullname']),
            'email' => trim($_POST['email']),
            'contact' => trim($_POST['contact']) ?: null,
        ];
        
        $result = $userModel->update($_SESSION['user_ID'], $data);
        
        if ($result) {
            $_SESSION['success'] = "Profile updated successfully!";
        } else {
            $_SESSION['error'] = "Failed to update profile. Please try again.";
        }
        
        header('Location: /PetSpot_clinic/public/profile');
        exit;
    }

    public function change_password()
    {
        error_log("ProfileController::change_password() called");
        error_log("POST data: " . print_r($_POST, true));
        
        if (!isset($_SESSION['user_ID'])) {
            header('Location: /PetSpot_clinic/public/login');
            exit;
        }

        $userModel = new User();
        $user = $userModel->first(['user_ID' => $_SESSION['user_ID']]);
        
        if (!$user) {
            $_SESSION['error'] = "User not found.";
            header('Location: /PetSpot_clinic/public/profile');
            exit;
        }
        
        // Validate input
        $errors = [];
        
        if (empty($_POST['current_password'])) {
            $errors[] = "Current password is required";
        }
        
        if (empty($_POST['new_password']) || strlen($_POST['new_password']) < 6) {
            $errors[] = "New password must be at least 6 characters long";
        }
        
        if ($_POST['new_password'] !== $_POST['confirm_password']) {
            $errors[] = "New passwords do not match";
        }
        
        if (!empty($errors)) {
            $_SESSION['error'] = implode(', ', $errors);
            header('Location: /PetSpot_clinic/public/profile');
            exit;
        }
        
        // Verify current password
        if (!password_verify($_POST['current_password'], $user->password)) {
            $_SESSION['error'] = "Current password is incorrect.";
            header('Location: /PetSpot_clinic/public/profile');
            exit;
        }
        
        // Update password
        $hashedPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        $result = $userModel->update($_SESSION['user_ID'], ['password' => $hashedPassword]);
        
        if ($result) {
            $_SESSION['success'] = "Password changed successfully!";
        } else {
            $_SESSION['error'] = "Failed to change password. Please try again.";
        }
        
        header('Location: /PetSpot_clinic/public/profile');
        exit;
    }

    public function delete_account()
    {
        error_log("ProfileController::delete_account() called");
        error_log("POST data: " . print_r($_POST, true));
        
        if (!isset($_SESSION['user_ID'])) {
            header('Location: /PetSpot_clinic/public/login');
            exit;
        }

        // Validate confirmation
        if (empty($_POST['confirmation']) || $_POST['confirmation'] !== 'DELETE') {
            $_SESSION['error'] = "Account deletion not confirmed properly.";
            header('Location: /PetSpot_clinic/public/profile');
            exit;
        }

        $userModel = new User();
        $result = $userModel->delete($_SESSION['user_ID']);
        
        if ($result) {
            // Clear session
            session_unset();
            session_destroy();
            
            // Redirect with success message
            header('Location: /PetSpot_clinic/public/?message=Account successfully deactivated');
            exit;
        } else {
            $_SESSION['error'] = "Failed to deactivate account. Please try again.";
            header('Location: /PetSpot_clinic/public/profile');
            exit;
        }
    }
}