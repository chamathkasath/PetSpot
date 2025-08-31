<?php
// filepath: app/models/Vaccination.php

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Model.php'; // Add this at the top if not already present

class Vaccination
{
    use Model;

    protected $table = 'vaccinations';
    protected $primaryKey = 'vaccination_ID'; // <-- Add this line
    protected $order_column = 'vaccination_ID';

    protected $allowedColumns = [
        'pet_ID',
        'user_ID',
        'vaccination_name',
        'vaccination_type',
        'date_of_last_vaccine',
        'next_due_date'
    ];

    public function countAll()
    {
        $result = $this->query("SELECT COUNT(*) as count FROM {$this->table}");
        return $result ? $result[0]->count : 0;
    }
}