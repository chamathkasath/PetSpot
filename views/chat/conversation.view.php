<!DOCTYPE html>
<html>
<head>
    <title>Chat Conversation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        html, body {
            height: 100%;
            background: transparent;
        }
        body {
            min-height: 100%;
            margin: 0;
            padding: 0;
            background: transparent;
        }
        .chat-popup-outer {
            height: 100vh;
            min-height: 100%;
            width: 100%;
            display: flex;
            flex-direction: column;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(44,83,100,0.10);
        }
        .chat-popup-header {
            background: linear-gradient(90deg, #2563eb 60%, #3b82f6 100%);
            color: #fff;
            padding: 14px 18px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
            position: sticky;
            top: 0;
            z-index: 10;
            min-height: 60px;
        }
        .chat-header-user {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .chat-avatar {
            width: 80px;
            height: 80ox;
            border-radius: 50%;
            border: 2px solid #fff;
            object-fit: cover;
            background-color: #fff;
            display: block;
        }
        .chat-title {
            font-size: 1.1rem;
            font-weight: 600;
        }
        .chat-status {
            font-size: 0.9rem;
            color: #d1fae5;
        }
        .close-btn {
            background: none;
            border: none;
            color: #fff;
            font-size: 1.5rem;
            cursor: pointer;
        }
        .chat-box {
            flex: 1 1 auto;
            overflow-y: auto;
            padding: 1em 1em 0.5em 1em;
            background: #f8f8f8;
        }
        .chat-msg {
            margin-bottom: 0.5em;
            max-width: 75%;
            padding: 10px 16px;
            border-radius: 16px;
            clear: both;
            display: inline-block;
            word-break: break-word;
            box-shadow: 0 2px 8px rgba(44,83,100,0.06);
        }
        .chat-msg.me {
            background: #2563eb;
            color: #fff;
            float: right;
            text-align: right;
        }
        .chat-msg.them {
            background: #e5e5ea;
            color: #222;
            float: left;
            text-align: left;
        }
        .time {
            font-size: 0.8em;
            margin-left: 0.5em;
            display: block;
            color: #888;
        }
        .chat-msg.me .time {
            color: #fff;
        }
        .chat-form {
            display: flex;
            padding: 10px;
            border-top: 1px solid #eee;
            background: #fff;
            border-bottom-left-radius: 16px;
            border-bottom-right-radius: 16px;
        }
        .chat-form textarea {
            flex: 1;
            resize: none;
            border-radius: 8px;
            border: 1px solid #ccc;
            padding: 8px;
            margin-right: 8px;
            min-height: 40px;
        }
        .chat-form button {
            background: #2563eb;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 8px 16px;
            cursor: pointer;
            font-weight: bold;
        }
    
        .chat-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid #fff;
            object-fit: cover;
            background-color: #fff;
            display: block;
        }
        .chat-toast {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #38b000;
            color: #fff;
            padding: 16px 28px;
            border-radius: 30px;
            font-size: 1.1rem;
            box-shadow: 0 4px 24px rgba(44,83,100,0.15);
            z-index: 9999;
            opacity: 0.95;
        }

        @keyframes slideIn {
            from {
                transform: translateY(10px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }
    </style>
</head>
<body>
    <div class="chat-popup-outer">
        <div class="chat-popup-header">
            <div class="chat-header-user">
                <!-- Back button -->
                <button class="close-btn me-2" onclick="goBackToList()" title="Back" style="font-size:1.3rem;background:rgba(0,0,0,0.08);color:#fff;border-radius:50%;width:32px;height:32px;display:flex;align-items:center;justify-content:center;border:none;">
                    <i class="fa fa-arrow-left"></i>
                </button>
                <img src="/PetSpot_clinic/public/assets/images/pet12.jpg" alt="Avatar" class="chat-avatar">
                <div>
                    <div class="chat-title">Chat with PetSpot</div>
                    <div class="chat-status">We're online</div>
                </div>
            </div>
            <button class="close-btn" onclick="closeChatPopup()" title="Close">&times;</button>
        </div>
        <div class="chat-box" id="chat-box">
            <?php foreach ($messages as $msg): ?>
                <div class="chat-msg <?= ($msg->sender_type === (isset($_SESSION['user_ID']) ? 'user' : 'staff') && $msg->sender_id == ($_SESSION['user_ID'] ?? $_SESSION['staff_id'])) ? 'me' : 'them' ?>">
                    <div class="text"><?= nl2br(htmlspecialchars($msg->message)) ?></div>
                    <span class="time"><?= htmlspecialchars(date('H:i', strtotime($msg->sent_at))) ?></span>
                </div>
            <?php endforeach; ?>
            <div style="clear:both"></div>
        </div>
        <form class="chat-form" method="post" action="/PetSpot_clinic/public/chat/send">
            <input type="hidden" name="receiver_id" value="<?= htmlspecialchars($_GET['with_id']) ?>">
            <input type="hidden" name="receiver_type" value="<?= htmlspecialchars($_GET['with_type']) ?>">
            <textarea name="message" required placeholder="Type your message..."></textarea>
            <button type="submit"><i class="fa-solid fa-paper-plane"></i></button>
        </form>
    </div>
    <script>
        // Scroll to bottom on load
        var chatBox = document.getElementById('chat-box');
        chatBox.scrollTop = chatBox.scrollHeight;

        // Fix close button for iframe popup
        function closeChatPopup() {
            // Try multiple methods to close the chat
            try {
                // Method 1: Parent toggle functions
                if(window.parent && typeof window.parent.toggleGlobalChatPopup === 'function') {
                    window.parent.toggleGlobalChatPopup();
                    return;
                }
                if(window.parent && typeof window.parent.toggleVetChatPopup === 'function') {
                    window.parent.toggleVetChatPopup();
                    return;
                }
                
                // Method 2: Find and hide parent chat popup containers
                if(window.parent && window.parent !== window) {
                    const containers = [
                        'global-chat-popup-container',
                        'vet-chat-popup-container', 
                        'chat-popup'
                    ];
                    
                    for(let containerId of containers) {
                        const parentChatPopup = window.parent.document.getElementById(containerId);
                        if(parentChatPopup) {
                            parentChatPopup.style.display = 'none';
                            return;
                        }
                    }
                    
                    // Method 3: Try to find chat iframe and hide its container
                    const frames = [
                        'global-chat-popup-frame',
                        'vet-chat-popup-frame',
                        'chat-popup-frame'
                    ];
                    
                    for(let frameId of frames) {
                        const chatFrame = window.parent.document.getElementById(frameId);
                        if(chatFrame && chatFrame.parentElement) {
                            chatFrame.parentElement.style.display = 'none';
                            return;
                        }
                    }
                }
                
                // Method 4: Try to close current window
                window.close();
            } catch(e) {
                console.log('Error closing chat:', e);
                // Final fallback - reload to parent page
                if(window.parent && window.parent !== window) {
                    window.parent.location.reload();
                } else {
                    window.location.href = '/PetSpot_clinic/public';
                }
            }
        }

        function goBackToList() {
            try {
                // If in iframe, load chat user list in parent iframe
                const frames = [
                    'global-chat-popup-frame',
                    'vet-chat-popup-frame',
                    'chat-popup-frame'
                ];
                
                for(let frameId of frames) {
                    if(window.parent && window.parent.document.getElementById(frameId)) {
                        window.parent.document.getElementById(frameId).src = '/PetSpot_clinic/public/chat';
                        return;
                    }
                }
                
                if(window.parent && window.parent !== window) {
                    // Try to navigate parent window
                    window.parent.location.href = '/PetSpot_clinic/public/chat';
                } else {
                    // Navigate current window
                    window.location.href = '/PetSpot_clinic/public/chat';
                }
            } catch(e) {
                console.log('Error going back:', e);
                // Fallback
                window.location.href = '/PetSpot_clinic/public/chat';
            }
        }
    </script>
    <script>
const ws = new WebSocket('ws://localhost:8080');

// Identify user on connect
ws.onopen = function() {
    ws.send(JSON.stringify({
        type: "identify",
        user_id: "<?= $_SESSION['user_ID'] ?? $_SESSION['staff_id'] ?>"
    }));
};

// Detect if chat popup is open (you may need to adapt this for your implementation)
function isChatOpen() {
    const popup = document.getElementById('chat-popup');
    return popup && popup.style.display !== 'none';
}

// Access the chatFab and badge in the parent window (if in iframe)
const chatFab = window.parent ? window.parent.document.getElementById('chat-fab') : document.getElementById('chat-fab');
const chatBadge = window.parent ? window.parent.document.getElementById('chat-badge') : document.getElementById('chat-badge');
let unreadCount = 0;

// Listen for new messages
ws.onmessage = function(event) {
    const data = JSON.parse(event.data);
    console.log("Received WebSocket message:", data);

    const myId = "<?= $_SESSION['user_ID'] ?? $_SESSION['staff_id'] ?>";

    if (!isChatOpen() && data.receiver == myId) {
        console.log("New message received, updating badge.");
        unreadCount++;
        const chatBadge = document.getElementById('chat-badge');
        if (chatBadge) {
            chatBadge.style.display = 'block';
            chatBadge.textContent = unreadCount;
        }
    }
};

document.querySelector('.chat-form').onsubmit = function(e) {
    e.preventDefault();
    const textarea = this.querySelector('textarea[name="message"]');
    const msg = textarea.value.trim();
    if (msg) {
        // Optimistically append the message for sender
        const chatBox = document.getElementById('chat-box');
        const msgElem = document.createElement('div');
        msgElem.className = 'chat-msg me';
        const time = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        msgElem.innerHTML = `<div class="text">${msg}<span class="time">${time}</span></div>`;
        chatBox.appendChild(msgElem);

        // Clear floats after each message
        const clearDiv = document.createElement('div');
        clearDiv.style.clear = 'both';
        chatBox.appendChild(clearDiv);

        chatBox.scrollTop = chatBox.scrollHeight;

        // Send to backend
        fetch('/PetSpot_clinic/public/chat/send', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({
                message: msg,
                receiver: "<?= htmlspecialchars($_GET['with_id']) ?>",
                receiver_type: "<?= htmlspecialchars($_GET['with_type']) ?>"
            })
        });
        textarea.value = '';
    }
};

// When chat is opened, clear the badge
if (chatFab) {
    chatFab.addEventListener('click', function() {
        unreadCount = 0;
        if (chatBadge) {
            chatBadge.style.display = 'none';
            chatBadge.textContent = '0';
        }
    });
}

// Clear notification badge when conversation page loads
window.addEventListener('load', function() {
    // Clear the notification badge in parent window (if in iframe)
    try {
        if (window.parent && window.parent !== window) {
            const parentNotifBadge = window.parent.document.getElementById('notif-badge');
            if (parentNotifBadge) {
                parentNotifBadge.style.display = 'none';
                if (window.parent.notifCount !== undefined) {
                    window.parent.notifCount = 0;
                }
            }
        }
        
        // Also clear local badge if exists
        const localNotifBadge = document.getElementById('notif-badge');
        if (localNotifBadge) {
            localNotifBadge.style.display = 'none';
        }
    } catch (e) {
        console.log('Could not access parent window for notification badge reset');
    }
});

function showToastNotification(msg) {
    let toast = document.createElement('div');
    toast.className = 'chat-toast';
    toast.innerText = msg;
    document.body.appendChild(toast);
    setTimeout(() => { toast.remove(); }, 4000);
}

function sendMessage(receiverId, receiverType, messageText) {
    fetch('/PetSpot_clinic/public/chat/send', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({
            receiver: receiverId,
            receiver_type: receiverType,
            message: messageText
        })
    })
    .then(res => res.json())
    .then(data => {
        // handle response
    });
}
</script>
<script>
    const SENDER_NAME = "<?= htmlspecialchars($sender_name) ?>";
</script>
</body>
</html>