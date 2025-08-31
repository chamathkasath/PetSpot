<?php
require_once __DIR__ . '/../models/ChatMessage.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Staff.php';

class ChatController
{
    protected $staffModel;
    protected $userModel;
    protected $chatMessageModel;

    public function __construct()
    {
        $this->staffModel = new Staff();
        $this->userModel = new User();
        $this->chatMessageModel = new ChatMessage();
    }

    public function index()
    {
        $staff = $this->staffModel->findAll();
        $users = $this->userModel->findAll();
        require_once __DIR__ . '/../views/chat/index.view.php';
    }

    public function conversation()
    {
        $with_id = $_GET['with_id'] ?? null;
        $with_type = $_GET['with_type'] ?? null;
        $user1_id = $_SESSION['user_ID'] ?? $_SESSION['staff_id'] ?? null;
        $user1_type = isset($_SESSION['user_ID']) ? 'user' : 'staff';

        if (!$user1_id || !$with_id || !$with_type) {
            die('Invalid chat participants.');
        }

        $messages = $this->chatMessageModel->getConversation($user1_id, $user1_type, $with_id, $with_type);

        // Mark messages as read when conversation is opened
        $this->chatMessageModel->markAsRead($user1_id, $user1_type, $with_id, $with_type);

        $sender_name = '';
        if (isset($_SESSION['user_ID'])) {
            $sender = $this->userModel->findById($_SESSION['user_ID']);
            $sender_name = $sender->fullname ?? 'User';
        } else {
            $sender = $this->staffModel->findById($_SESSION['staff_id']);
            $sender_name = $sender->username ?? 'Staff';
        }
        // Pass $sender_name to the view
        require __DIR__ . '/../views/chat/conversation.view.php';
    }

    public function send()
    {
        // Accept both JSON and form POST
        $input = json_decode(file_get_contents('php://input'), true);
        $sender_id = $_SESSION['user_ID'] ?? $_SESSION['staff_id'] ?? null;
        $sender_type = isset($_SESSION['user_ID']) ? 'user' : 'staff';
        $receiver_id = $input['receiver'] ?? $_POST['receiver_id'] ?? null;
        $receiver_type = $input['receiver_type'] ?? $_POST['receiver_type'] ?? null;
        $message = trim($input['message'] ?? $_POST['message'] ?? '');

        if ($sender_id && $receiver_id && $message) {
            $this->chatMessageModel->insert([
                'sender_id' => $sender_id,
                'sender_type' => $sender_type,
                'receiver_id' => $receiver_id,
                'receiver_type' => $receiver_type,
                'message' => $message,
                'sent_at' => date('Y-m-d H:i:s'),
                'is_read' => 0  // Mark as unread initially
            ]);

            // Get sender's name
            if (isset($_SESSION['user_ID'])) {
                $sender = $this->userModel->findById($_SESSION['user_ID']);
                $senderName = $sender->fullname ?? 'User';
            } else {
                $sender = $this->staffModel->findById($_SESSION['staff_id']);
                $senderName = $sender->username ?? 'Staff';
            }

            // Notify WebSocket server (Ratchet)
            $wsData = [
                'type' => 'chat',
                'sender' => $sender_id,
                'sender_name' => $senderName,
                'receiver' => $receiver_id,
                'message' => $message,
                'sent_at' => date('Y-m-d H:i:s')
            ];
            $this->notifyWebSocket($wsData);

            // Get receiver's email and name
            if ($receiver_type === 'user') {
                $receiver = $this->userModel->findById($receiver_id);
                $receiver_email = $receiver->email ?? null;
                $receiver_name = $receiver->fullname ?? 'User';
            } else {
                $receiver = $this->staffModel->findById($receiver_id);
                $receiver_email = $receiver->email ?? null;
                $receiver_name = $receiver->username ?? 'Staff';
            }

            // Get sender's name
            $sender_name = isset($_SESSION['user_ID'])
                ? ($this->userModel->findById($_SESSION['user_ID'])->fullname ?? 'User')
                : ($this->staffModel->findById($_SESSION['staff_id'])->username ?? 'Staff');

            // Send email if receiver email exists
            if ($receiver_email) {
                require_once __DIR__ . '/../services/MailService.php';
                $mailService = new MailService();
                $subject = "New Chat Message from $sender_name";
                $body = "Hello $receiver_name,<br><br>You have received a new message from $sender_name:<br><br><b>$message</b><br><br>Login to PetSpot Clinic to reply.";
                $mailService->sendGenericMail($receiver_email, $subject, $body);
            }
        }
    }

    public function getUnreadCount()
    {
        $user_id = $_SESSION['user_ID'] ?? $_SESSION['staff_id'] ?? null;
        $user_type = isset($_SESSION['user_ID']) ? 'user' : 'staff';
        
        if ($user_id) {
            $count = $this->chatMessageModel->getUnreadCount($user_id, $user_type);
            $unreadMessages = $this->chatMessageModel->getUnreadMessages($user_id, $user_type);
            
            header('Content-Type: application/json');
            echo json_encode([
                'unread_count' => $count,
                'unread_messages' => $unreadMessages
            ]);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'unread_count' => 0,
                'unread_messages' => []
            ]);
        }
        exit;
    }

    protected function notifyWebSocket($data)
    {
        $fp = fsockopen("localhost", 8080, $errno, $errstr, 1);
        if ($fp) {
            fwrite($fp, json_encode($data) . "\n");
            fclose($fp);
        }
    }
}