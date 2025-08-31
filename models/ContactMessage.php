<?php

require_once __DIR__ . '/../core/Database.php';

class ContactMessage
{
    use Model;

    protected $table = 'contact_messages';
    protected $order_column = 'created_at'; // <-- Add this line

    protected $allowedColumns = [
        'name',
        'email',
        'subject',
        'message',
        'created_at',
        'replied',
        'reply_message'
    ];

    public function getAllMessages()
    {
        return $this->findAll([], 'created_at DESC');
    }
}