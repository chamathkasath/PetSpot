<?php

/**
 * signup class
 */
class Signup
{
	use Controller;

	public function index()
	{
		$errors = [];

		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			require_once __DIR__ . '/../models/User.php';
			$user = new User;

			// Password validation
			$password = $_POST['password'] ?? '';
			$confirmpassword = $_POST['confirmpassword'] ?? '';
			if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{6,}$/', $password)) {
				$errors[] = "Password must be at least 6 characters and include uppercase, lowercase, number, and special character.";
			}
			if ($password !== $confirmpassword) {
				$errors[] = "Passwords do not match.";
			}

			if ($user->register($_POST)) {
				echo "<script>
                    alert('Registration successful! Please login.');
                    window.location.href = '/PetSpot_clinic/public/login';
                </script>";
                exit;
			} else {
				$errors = $user->errors;
			}
		}

		include __DIR__ . '/../views/signup.view.php';
	}

}


