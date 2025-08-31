<?php
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

require __DIR__ . '/vendor/autoload.php';

class Chat implements MessageComponentInterface {
    protected $clients = [];
    protected $userConnections = [];

    public function onOpen(ConnectionInterface $conn) {
        $this->clients[$conn->resourceId] = $conn;
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $data = json_decode($msg, true);

        // Register user connection on identify message
        if (isset($data['type']) && $data['type'] === 'identify' && isset($data['user_id'])) {
            $this->userConnections[$data['user_id']] = $from;
            echo "User {$data['user_id']} connected\n";
            return;
        }

        // On chat message, also register sender 
        if (isset($data['sender'])) {
            $this->userConnections[$data['sender']] = $from;
        }

        // Add sender_name if missing
        if (isset($data['sender']) && !isset($data['sender_name'])) {
            $data['sender_name'] = 'User ' . $data['sender'];
        }

        echo "Broadcasting message from {$data['sender']} to {$data['receiver']}\n";
        echo "Message data: " . json_encode($data) . "\n";

        // Send to receiver if connected
        if (isset($data['receiver']) && isset($this->userConnections[$data['receiver']])) {
            $messageToSend = [
                'type' => 'chat',
                'sender' => $data['sender'],
                'sender_name' => $data['sender_name'] ?? 'Unknown',
                'receiver' => $data['receiver'],
                'message' => $data['message'],
                'sent_at' => date('H:i')
            ];
            
            echo "Sending to receiver {$data['receiver']}: " . json_encode($messageToSend) . "\n";
            $this->userConnections[$data['receiver']]->send(json_encode($messageToSend));
        } else {
            echo "Receiver {$data['receiver']} not connected\n";
        }

        // Also send to sender (so sender sees their own message in real time)
        if (isset($data['sender']) && isset($this->userConnections[$data['sender']])) {
            $this->userConnections[$data['sender']]->send(json_encode($data));
        }
    }

    public function onClose(ConnectionInterface $conn) {
        unset($this->clients[$conn->resourceId]);
        // Remove from userConnections as well
        foreach ($this->userConnections as $userId => $connection) {
            if ($connection === $conn) {
                unset($this->userConnections[$userId]);
                break;
            }
        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
    }
}

$server = Ratchet\Server\IoServer::factory(
    new Ratchet\Http\HttpServer(
        new Ratchet\WebSocket\WsServer(
            new Chat()
        )
    ),
    8080
);

$server->run();