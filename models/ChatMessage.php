<?php
require_once __DIR__ . '/../core/Database.php';

class ChatMessage
{
    use Model;

    protected $table = 'chat_messages';

    protected $allowedColumns = [
        'sender_id', 'sender_type', 'receiver_id', 'receiver_type', 'message', 'sent_at', 'is_read'
    ];

    public function getConversation($user1_id, $user1_type, $user2_id, $user2_type)
    {
        $sql = "SELECT * FROM {$this->table}
                WHERE (sender_id = :u1 AND sender_type = :t1 AND receiver_id = :u2 AND receiver_type = :t2)
                   OR (sender_id = :u2 AND sender_type = :t2 AND receiver_id = :u1 AND receiver_type = :t1)
                ORDER BY sent_at ASC";
        return $this->query($sql, [
            'u1' => $user1_id, 't1' => $user1_type,
            'u2' => $user2_id, 't2' => $user2_type
        ]);
    }

    public function getUnreadCount($user_id, $user_type)
    {
        $sql = "SELECT COUNT(*) as count FROM {$this->table}
                WHERE receiver_id = :user_id AND receiver_type = :user_type AND (is_read = 0 OR is_read IS NULL)";
        $result = $this->query($sql, [
            'user_id' => $user_id,
            'user_type' => $user_type
        ]);
        return $result ? (int)$result[0]->count : 0;
    }

    public function getUnreadMessages($user_id, $user_type)
    {
        $sql = "SELECT cm.*, 
                CASE 
                    WHEN cm.sender_type = 'user' THEN u.fullname 
                    ELSE s.username 
                END as sender_name
                FROM {$this->table} cm
                LEFT JOIN users u ON cm.sender_id = u.user_ID AND cm.sender_type = 'user'
                LEFT JOIN staff s ON cm.sender_id = s.staff_id AND cm.sender_type = 'staff'
                WHERE cm.receiver_id = :user_id AND cm.receiver_type = :user_type 
                AND (cm.is_read = 0 OR cm.is_read IS NULL)
                ORDER BY cm.sent_at DESC 
                LIMIT 5";
        
        return $this->query($sql, [
            'user_id' => $user_id,
            'user_type' => $user_type
        ]);
    }

    public function markAsRead($user_id, $user_type, $sender_id = null, $sender_type = null)
    {
        if ($sender_id && $sender_type) {
            // Mark specific conversation as read
            $sql = "UPDATE {$this->table} SET is_read = 1 
                    WHERE receiver_id = :user_id AND receiver_type = :user_type 
                    AND sender_id = :sender_id AND sender_type = :sender_type 
                    AND (is_read = 0 OR is_read IS NULL)";
            return $this->query($sql, [
                'user_id' => $user_id,
                'user_type' => $user_type,
                'sender_id' => $sender_id,
                'sender_type' => $sender_type
            ]);
        } else {
            // Mark all messages as read for this user
            $sql = "UPDATE {$this->table} SET is_read = 1 
                    WHERE receiver_id = :user_id AND receiver_type = :user_type 
                    AND (is_read = 0 OR is_read IS NULL)";
            return $this->query($sql, [
                'user_id' => $user_id,
                'user_type' => $user_type
            ]);
        }
    }
}