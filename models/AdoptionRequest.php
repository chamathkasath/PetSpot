<?php

require_once __DIR__ . '/../core/Database.php';

class AdoptionRequest
{
    use Model;

    protected $table = 'adoption_requests';
    protected $primaryKey = 'id';
    protected $order_column = 'id';
    
    protected $allowedColumns = [
        'found_ID',
        'user_ID',
        'adopter_name',
        'adopter_email',
        'reason',
        'message',
        'requested_at',
        'status',
        'manager_reply'
    ];

    public function deleteByFoundId($found_ID)
    {
        $sql = "DELETE FROM adoption_requests WHERE found_ID = :found_ID";
        $this->query($sql, ['found_ID' => $found_ID]);
    }

    public function countAll()
    {
        $result = $this->query("SELECT COUNT(*) as count FROM adoption_requests");
        return $result ? $result[0]->count : 0;
    }
}