<?php
require_once __DIR__ . '/../core/Database.php';

class Feedback
{
    use Model;

    public $order_column; // <-- Add this line

    protected $table = 'feedback';

    protected $allowedColumns = [
        'user_ID',
        'rate',
        'comment',
        'created_at',
        'confirmed'
    ];

    public function __construct()
    {
        $this->order_column = 'feedback_id'; // Set the order column here
    }

    public function delete($feedback_id)
    {
        $query = "DELETE FROM {$this->table} WHERE feedback_id = :feedback_id LIMIT 1";
        $this->query($query, ['feedback_id' => $feedback_id]);
    }
    public function update($feedback_id, $data)
    {
        $set = "";
        $params = [];
        foreach ($data as $key => $value) {
            $set .= "$key = :$key, ";
            $params[$key] = $value;
        }
        $set = rtrim($set, ", ");
        $params['feedback_id'] = $feedback_id;

        $query = "UPDATE {$this->table} SET $set WHERE feedback_id = :feedback_id LIMIT 1";
        $this->query($query, $params);
    }
}