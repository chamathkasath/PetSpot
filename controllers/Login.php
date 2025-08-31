<?php 

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Staff.php';

/**
 * login class
 */
class Login
{
    use Controller;

    public function index()
    {
        $data = ['errors' => []];
        
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            //  admin credentials
            if ($email === 'admin@petspot.com' && $password === 'admin123') {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = 1; 
                $_SESSION['user_ID'] = 1; 
                $_SESSION['staff_role'] = 'Admin'; 
                header('Location: /PetSpot_clinic/public/admin/dashboard');
                exit;
            }

            // Check staff table for admin or staff
            $staff = (new Staff())->first(['email' => $email]);
         
            if ($staff && password_verify($password, $staff->password)) {
                if ($staff->role === 'admin') {
                    $_SESSION['admin_logged_in'] = true;
                    $_SESSION['admin_id'] = $staff->id;
                    header('Location: /PetSpot_clinic/public/admin/dashboard');
                    exit;
                } else if ($staff->role === 'Manager') {
                    $_SESSION['staff_role'] = 'Manager';
                    $_SESSION['staff_id'] = $staff->staff_id;
                    header('Location: /PetSpot_clinic/public/manager/dashboard');
                    exit;
                } else if ($staff->role === 'Vet Staff') {
                    $_SESSION['staff_role'] = 'Vet Staff';
                    $_SESSION['staff_id'] = $staff->staff_id;
                    header('Location: /PetSpot_clinic/public/vet_dashboard');
                    exit;
                } else if ($staff->role === 'Veterinarian') {
                    $_SESSION['staff_role'] = 'Veterinarian';
                    $_SESSION['staff_id'] = $staff->staff_id;
                    header('Location: /PetSpot_clinic/public/vet/vetdash');
                    exit;
                } else if ($staff->role === 'Pharmacist') {
                    $_SESSION['staff_role'] = 'Pharmacist';
                    $_SESSION['staff_id'] = $staff->staff_id;
                    header('Location: /PetSpot_clinic/public/pharmacist/dashboard');
                    exit;
                } else {
                    
                }
            }

            // Check user table
            $user = (new User())->first(['email' => $email]);
            if ($user && password_verify($password, $user->password)) {
                $_SESSION['user_ID'] = $user->user_ID; // Use user_ID as the session key
                $_SESSION['USER'] = $user; 
                header('Location: /PetSpot_clinic/public/home');
                exit;
            }

            $data['errors'][] = "Invalid credentials";
        }

        include __DIR__ . '/../views/login.view.php';
    }

    public function logout()
    {
        session_destroy();
        header('Location: /login');
        exit;
    }
}
