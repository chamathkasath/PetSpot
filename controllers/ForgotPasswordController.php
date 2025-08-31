<?php

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Staff.php';
require_once __DIR__ . '/../services/MailService.php';

class ForgotPasswordController
{
    use Controller;

    public function index()
    {
        include __DIR__ . '/../views/forgotpassword.view.php';
    }

    public function processRequest()
    {
        $email = $_POST['email'] ?? '';
        $role = $_POST['role'] ?? 'user'; // 'user' or 'staff'
        $user = null;

        if ($role === 'staff') {
            $model = new Staff();
            $user = $model->first(['email' => $email]);
        } else {
            $model = new User();
            $user = $model->first(['email' => $email]);
        }

        if (!$user) {
            $_SESSION['error'] = "No account found with that email.";
            header("Location: /PetSpot_clinic/public/forgotpassword");
            exit;
        }

        // Generate token and expiry
        $token = bin2hex(random_bytes(32));
        $expiry = date('Y-m-d H:i:s', strtotime('+30 minutes'));

        // Save to DB
        $model->update($user->{$role === 'staff' ? 'staff_id' : 'user_ID'}, [
            'reset_token' => $token,
            'reset_token_expiry' => $expiry
        ]);

        // Send email
        $resetLink = "http://{$_SERVER['HTTP_HOST']}/PetSpot_clinic/public/forgotpassword/reset?token=$token&role=$role";
        $mailService = new MailService();
        $subject = "Password Reset Request";
        $body = "Click the link to reset your password: <a href='$resetLink'>$resetLink</a><br>This link will expire in 30 minutes.";
        $mailService->sendGenericMail($email, $subject, $body);

        $_SESSION['success'] = "A password reset link has been sent to your email.";
        header("Location: /PetSpot_clinic/public/forgotpassword");
        exit;
    }

    public function reset()
    {
        $token = $_GET['token'] ?? '';
        $role = $_GET['role'] ?? 'user';
        $user = null;

        if ($role === 'staff') {
            $model = new Staff();
            $user = $model->first(['reset_token' => $token]);
        } else {
            $model = new User();
            $user = $model->first(['reset_token' => $token]);
        }

        if (!$user || strtotime($user->reset_token_expiry) < time()) {
            $_SESSION['error'] = "Invalid or expired reset link.";
            header("Location: /PetSpot_clinic/public/forgotpassword");
            exit;
        }

        include __DIR__ . '/../views/forgotpassword_reset.view.php';
    }

    public function processReset()
    {
        $token = $_POST['token'] ?? '';
        $role = $_POST['role'] ?? 'user';
        $password = $_POST['new_password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';

        if ($password !== $confirm) {
            $_SESSION['error'] = "Passwords do not match.";
            header("Location: /PetSpot_clinic/public/forgotpassword/reset?token=$token&role=$role");
            exit;
        }

        if ($role === 'staff') {
            $model = new Staff();
            $user = $model->first(['reset_token' => $token]);
        } else {
            $model = new User();
            $user = $model->first(['reset_token' => $token]);
        }

        if (!$user || strtotime($user->reset_token_expiry) < time()) {
            $_SESSION['error'] = "Invalid or expired reset link.";
            header("Location: /PetSpot_clinic/public/forgotpassword");
            exit;
        }

        // Update password and clear token
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $model->update($user->{$role === 'staff' ? 'staff_id' : 'user_ID'}, [
            'password' => $hashed,
            'reset_token' => null,
            'reset_token_expiry' => null
        ]);

        $_SESSION['success'] = "Password reset successful. You can now log in.";
        header("Location: /PetSpot_clinic/public/login");
        exit;
    }
}