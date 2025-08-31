<?php

require_once __DIR__ . '/../core/Database.php';

class Staff
{
    use Model;

    protected $table = 'staff';

    protected $primaryKey = 'staff_id'; // <-- Add this line
    protected $order_column = 'staff_id'; // <-- ADD THIS LINE

    protected $allowedColumns = [
        'username',
        'role',
        'email',
        'contact',
        'password',
        'NIC',
        'reset_token',           // <-- add this
		'reset_token_expiry'     // <-- add this
    ];

    public function validate($data)
    {
        $this->errors = [];

        // Username: required, min 3 chars
        if (empty($data['username'])) {
            $this->errors[] = "Username is required";
        } elseif (strlen($data['username']) < 3) {
            $this->errors[] = "Username must be at least 3 characters";
        }

        // Role: required
        if (empty($data['role'])) {
            $this->errors[] = "Role is required";
        }

        // Email: required, valid, unique
        if (empty($data['email'])) {
            $this->errors[] = "Email is required";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Valid email is required";
        } else {
            $pdo = Database::connect();
            $stmt = $pdo->prepare("SELECT staff_id FROM staff WHERE email = ?");
            $stmt->execute([$data['email']]);
            if ($stmt->fetch()) $this->errors[] = "Email already exists";
        }

        // Contact: required, must be digits, length 10
        if (empty($data['contact'])) {
            $this->errors[] = "Contact is required";
        } elseif (!preg_match('/^\d{10}$/', $data['contact'])) {
            $this->errors[] = "Contact must be a 10-digit number";
        }

        // Password: required, min 6 chars, match confirm
        if (empty($data['password'])) {
            $this->errors[] = "Password is required";
        } elseif (strlen($data['password']) < 6) {
            $this->errors[] = "Password must be at least 6 characters";
        }
        if (empty($data['confirmpassword'])) {
            $this->errors[] = "Confirm Password is required";
        } elseif ($data['password'] !== $data['confirmpassword']) {
            $this->errors[] = "Passwords do not match";
        }

        // NIC: required, pattern (simple check)
        if (empty($data['NIC'])) {
            $this->errors[] = "NIC is required";
        } elseif (!preg_match('/^[0-9]{9}[vVxX]$/', $data['NIC']) && !preg_match('/^[0-9]{12}$/', $data['NIC'])) {
            $this->errors[] = "NIC format is invalid";
        }

        return empty($this->errors);
    }

    public function register($data)
    {
        if (!$this->validate($data)) return false;

        $pdo = Database::connect();
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO staff (username, role, email, contact, password, NIC) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['username'],
            $data['role'],
            $data['email'],
            $data['contact'],
            $hashedPassword,
            $data['NIC']
        ]);
    }

    public function countAll()
    {
        $result = $this->query("SELECT COUNT(*) as count FROM staff");
        return $result ? $result[0]->count : 0;
    }

    public function findAll()
    {
        $pdo = Database::connect();
        $stmt = $pdo->query("SELECT * FROM staff ORDER BY staff_id ASC");
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}