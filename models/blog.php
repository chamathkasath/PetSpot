<?php
require_once __DIR__ . '/../core/Model.php';

class Blog
{
    use Model;

    protected $table = 'blogs';
    protected $order_column = 'created_at'; // Add this line
    protected $primaryKey = 'id'; // Add this line to define the primary key
    protected $confirmed = false; // Default value for user blogs

    public function findAll($conditions = [])
    {
        $query = "SELECT id, user_ID, title, content, created_at, image, confirmed, is_staff FROM {$this->table}";
        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", array_map(function($key) {
                return "$key = :$key";
            }, array_keys($conditions)));
        }
        $query .= " ORDER BY {$this->order_column} DESC";
        return $this->query($query, $conditions);
    }

    public function update($id, $data)
    {
        $query = "UPDATE {$this->table} SET " . implode(", ", array_map(function($key) {
            return "$key = :$key";
        }, array_keys($data))) . " WHERE {$this->primaryKey} = :id";

        $data['id'] = $id; // Add the ID to the data array
        return $this->query($query, $data);
    }

    
}