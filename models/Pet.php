<?php

require_once __DIR__ . '/../core/Database.php';

class Pet
{
    use Model;

    protected $table = 'pets';
    protected $primaryKey = 'pet_ID'; // <-- Add this line
    protected $order_column = 'pet_ID';

    protected $allowedColumns = [
        'pet_ID', // primary key
        'user_ID',     // foreign key to users
        'name',
        'type',
        'color',
        'gender',
        'breed',
        'date_registered',
        'special_markings',
        'status',
        'last_seen_location',
        'last_seen_date',
        'image_url',
        'special_note'
    ];

    public $errors = [];

    public function __construct()
    {
        $this->order_column = 'pet_ID'; // Set the order column here
    }

    public function validate($data)
    {
        $this->errors = [];
        if (empty($data['name'])) $this->errors[] = "Pet name is required";
        if (empty($data['type'])) $this->errors[] = "Type is required";
        if (empty($data['color'])) $this->errors[] = "Color is required";
        if (empty($data['status'])) $this->errors[] = "Status is required";
        // Add more validation as needed
        return empty($this->errors);
    }

    public function delete($pet_ID)
    {
        $sql = "DELETE FROM pets WHERE pet_ID = :pet_ID";
        $this->query($sql, ['pet_ID' => $pet_ID]);
    }
    public function getPetsByUser($user_ID)
    {
        $sql = "SELECT * FROM {$this->table} WHERE user_ID = :user_ID";
        return $this->query($sql, ['user_ID' => $user_ID]);
    }
    public function countAll()
    {
        $result = $this->query("SELECT COUNT(*) as count FROM pets");
        return $result ? $result[0]->count : 0;
    }
    public function setLimit($limit)
    {
        $this->limit = $limit;
    }
}