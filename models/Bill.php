<?php
require_once __DIR__ . '/../core/Database.php';

class Bill
{
    use Model;
    protected $table = "bill";
    protected $order_column = "bill_ID";
    protected $allowedColumns = [
        "prescription_ID", "cost_of_medicine", "total_price", "user_ID", "payment_method", "note"
    ];

    public function countAll()
    {
        $result = $this->query("SELECT COUNT(*) as count FROM bill");
        return $result ? $result[0]->count : 0;
    }

    public function getTotalRevenue()
    {
        $result = $this->query("SELECT SUM(total_price) as total FROM bill");
        return $result ? $result[0]->total : 0;
    }
}