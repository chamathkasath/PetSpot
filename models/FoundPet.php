<?php

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Model.php';

class FoundPet
{
    use Model;

    protected $table = 'found_pets';
    protected $primaryKey = 'found_ID'; // <-- Add this line

    protected $allowedColumns = [
        'user_ID',
        'color',
        'special_markings',
        'image_url',
        'found_date',
        'reporter_email',
        'found_location',
        'created_at',
        'type',
        'breed',
        'gender',
        'status' // <-- Add this line
    ];

    // Add this property declaration to fix the deprecation warning
    public $order_column;

    public function __construct()
    {
        $this->order_column = 'found_ID'; // Set the order column here
    }

    public function updateStatus($found_ID, $status)
    {
        return $this->update($found_ID, ['status' => $status]);
    }

    public function countAll()
    {
        $result = $this->query("SELECT COUNT(*) as count FROM found_pets");
        return $result ? $result[0]->count : 0;
    }
    public function getAllWithDetails()
    {
        return $this->query(
            "SELECT fp.*, u.fullname as reporter_name 
             FROM found_pets fp
             LEFT JOIN users u ON fp.user_ID = u.user_ID
             ORDER BY fp.found_date DESC"
        );
    }
}