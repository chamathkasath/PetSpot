<?php 

require_once __DIR__ . '/../core/Database.php';

/**
 * User class
 */
class User
{
	
	use Model;

	protected $table = 'users';
	protected $order_column = 'user_ID'; // <-- Add this line
	protected $primaryKey = 'user_ID'; // <-- Add this line

	protected $allowedColumns = [
		'user_ID',   // <-- add this line for the new PK
		'fullname',
		'username',
		'address',
		'email',
		'contact',
		'password',
		'reset_token',           // <-- add this
		'reset_token_expiry'     // <-- add this
	];

	public function validate($data)
	{
		$this->errors = [];

		if(empty($data['email']))
		{
			$this->errors['email'] = "Email is required";
		}else
		if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL))
		{
			$this->errors['email'] = "Email is not valid";
		}
		
		if(empty($data['password']))
		{
			$this->errors['password'] = "Password is required";
		}
		
		if(empty($data['terms']))
		{
			$this->errors['terms'] = "Please accept the terms and conditions";
		}

		if(empty($this->errors))
		{
			return true;
		}

		return false;
	}

	public function login($email, $password)
	{
	    // Replace with your actual DB logic
	    // Example: fetch user by email and verify password
	    // This is a placeholder for demonstration
	    if ($email === 'admin@petspot.com' && $password === 'password') {
	        return true;
	    }
	    return false;
	}

	public function register($data)
	{
	    $this->errors = [];

	    if (empty($data['fullname'])) $this->errors[] = "Full name is required";
	    if (empty($data['username'])) $this->errors[] = "Username is required";
	    if (empty($data['address'])) $this->errors[] = "Address is required";
	    if (empty($data['email'])) $this->errors[] = "Email is required";
	    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) $this->errors[] = "Email is not valid";
	    if (empty($data['contact'])) $this->errors[] = "Contact is required";
	    if (empty($data['password'])) $this->errors[] = "Password is required";
	    if ($data['password'] !== $data['confirmpassword']) $this->errors[] = "Passwords do not match";

	    $pdo = Database::connect();
	    // Change 'id' to 'user_ID' in the SELECT statement
	    $stmt = $pdo->prepare("SELECT user_ID FROM users WHERE email = ? OR username = ?");
	    $stmt->execute([$data['email'], $data['username']]);
	    if ($stmt->fetch()) $this->errors[] = "Email or username already exists";

	    if (!empty($this->errors)) return false;

	    $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

	    $stmt = $pdo->prepare("INSERT INTO users (fullname, username, address, email, contact, password) VALUES (?, ?, ?, ?, ?, ?)");
	    if (!$stmt->execute([
	        $data['fullname'],
	        $data['username'],
	        $data['address'],
	        $data['email'],
	        $data['contact'],
	        $hashedPassword
	    ])) {
	        $this->errors[] = "Database error: " . implode(", ", $stmt->errorInfo());
	        return false;
	    }

	    return true;
	}

	public function getById($userId)
	{
	    $query = "SELECT * FROM {$this->table} WHERE user_ID = :user_ID LIMIT 1";
	    $result = $this->query($query, ['user_ID' => $userId]);
	    return $result ? $result[0] : null;
	}

	public function countOwners()
	{
	    $stmt = $this->db->query("SELECT COUNT(*) FROM users");
	    return $stmt->fetchColumn();
	}

	public function countAll()
	{
	    $result = $this->query("SELECT COUNT(*) as count FROM users");
	    return $result ? $result[0]->count : 0;
	}

	public function getAllOwnersWithPets()
	{
	    $query = "SELECT u.user_ID, u.username, u.email, 
	                     p.pet_ID, p.name AS pet_name, p.type, p.color, p.gender, 
	                     p.breed, p.date_registered, p.special_markings, p.status AS pet_status,
	                     p.last_seen_location, p.last_seen_date, p.image_url, p.special_note
	              FROM users u
	              LEFT JOIN pets p ON u.user_ID = p.user_ID
	              ORDER BY u.user_ID, p.pet_ID";
	    return $this->query($query);
	}

	public function findById($id)
	{
	    $pdo = Database::connect();
	    $stmt = $pdo->prepare("SELECT * FROM users WHERE user_ID = ?");
	    $stmt->execute([$id]);
	    return $stmt->fetch(PDO::FETCH_OBJ);
	}

	public function findAll()
	{
	    $pdo = Database::connect();
	    $stmt = $pdo->query("SELECT * FROM users ORDER BY user_ID ASC");
	    return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
}