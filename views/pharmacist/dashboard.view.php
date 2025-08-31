<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pharmacist Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background: #f4f7fa;
        }
        .dashboard-card {
            border-radius: 16px;
            box-shadow: 0 2px 8px #0001;
            transition: box-shadow 0.15s, transform 0.15s;
            cursor: pointer;
            border: 1px solid #f0f0f0;
        }
        .dashboard-card:hover {
            box-shadow: 0 6px 24px #0002;
            transform: translateY(-4px) scale(1.03);
            border-color: #e0e0e0;
        }
        .dashboard-card .icon {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            opacity: 0.92;
        }
        /* Chat Icon */
        .global-chat-icon {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: #2563eb;
            color: white;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(44,83,100,0.18);
            z-index: 9999;
        }
    </style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/PetSpot_clinic/public/pharmacist/dashboard">Pharmacist Dashboard</a>
        <div class="collapse navbar-collapse" id="pharmacistNavbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/PetSpot_clinic/public/pharmacist/dashboard">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/PetSpot_clinic/public/pharmacist/prescriptions">Prescriptions</a>
                </li>
                <!-- Bell Icon -->
                <li class="nav-item">
                    <div id="notif-bell" style="position:relative;display:inline-block;cursor:pointer;margin-right:15px;margin-top:8px;">
                        <i class="fa-regular fa-bell" style="font-size:24px;color:#fff;"></i>
                        <span id="notif-badge" style="background:red;color:#fff;border-radius:50%;padding:2px 6px;font-size:11px;display:none;position:absolute;top:-5px;right:-8px;min-width:18px;text-align:center;font-weight:bold;box-shadow:0 2px 6px rgba(0,0,0,0.15);">0</span>
                    </div>
                    <!-- Notification List Popup -->
                    <div id="notif-list" style="display:none;position:absolute;top:50px;right:10px;background:#fff;border:1px solid #eee;box-shadow:0 2px 8px rgba(0,0,0,0.12);border-radius:8px;min-width:220px;z-index:9999;padding:10px;">
                        No new notifications
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/PetSpot_clinic/public/staff/profile">
                        <i class="fas fa-user-circle me-1"></i>Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/PetSpot_clinic/public/logout">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container py-4">
    <h2 class="mb-4 text-center">Pharmacist Dashboard</h2>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-4">
        <!-- Prescriptions Card -->
        <div class="col">
            <a href="/PetSpot_clinic/public/pharmacist/prescriptions" class="text-decoration-none">
                <div class="card text-center dashboard-card h-100 p-3">
                    <div class="icon text-primary"><i class="bi bi-file-medical"></i></div>
                    <h5 class="card-title">Prescriptions</h5>
                    <p class="card-text text-muted">View and manage all prescriptions from veterinarians.</p>
                </div>
            </a>
        </div>
        <!-- Medicine Inventory Card -->
        <div class="col">
            <a href="/PetSpot_clinic/public/pharmacist/inventory" class="text-decoration-none">
                <div class="card text-center dashboard-card h-100 p-3">
                    <div class="icon text-success"><i class="bi bi-pills"></i></div>
                    <h5 class="card-title">Medicine Inventory</h5>
                    <p class="card-text text-muted">Monitor and manage medicine stock levels.</p>
                </div>
            </a>
        </div>
        
    </div>
</div>

<div class="global-chat-icon" onclick="toggleGlobalChatPopup()">
    <i class="fa-regular fa-comments"></i>
</div>

<!-- Chat Popup -->
<div id="global-chat-popup-container" style="display:none; position:fixed; bottom:100px; right:30px; width:370px; height:540px; border-radius:20px; border:1px solid #e0e0e0; box-shadow: 0 8px 32px rgba(44,83,100,0.18); z-index:10000; background:#fff; overflow:hidden;">
    <iframe id="global-chat-popup-frame" src="/PetSpot_clinic/public/chat" style="width:100%; height:100%; border:none; border-radius:20px;"></iframe>
</div>

<script>
let notifCount = 0;
let notifMessages = [];

const notifBell = document.getElementById('notif-bell');
const notifBadge = document.getElementById('notif-badge');
const notifList = document.getElementById('notif-list');

// Show/hide notification list on bell click
notifBell.onclick = function() {
    notifList.style.display = (notifList.style.display === 'none' || notifList.style.display === '') ? 'block' : 'none';
    if (notifList.style.display === 'block') {
        notifBadge.style.display = 'none';
        notifCount = 0;
    }
    if (notifMessages.length === 0) {
        notifList.innerHTML = '<div style="padding: 10px;">No new notifications</div>';
    }
};

// Hide notification list when clicking outside
document.addEventListener('click', function(e) {
    if (!notifBell.contains(e.target) && !notifList.contains(e.target)) {
        notifList.style.display = 'none';
    }
});

// WebSocket connection for notifications
if (typeof window.wsNotif === 'undefined') {
    window.wsNotif = new WebSocket('ws://localhost:8080');

    window.wsNotif.onopen = function() {
        window.wsNotif.send(JSON.stringify({
            type: "identify",
            user_id: "<?= $_SESSION['staff_id'] ?? '' ?>"
        }));
    };

    window.wsNotif.onmessage = function(event) {
        try {
            const data = JSON.parse(event.data);
            const myId = "<?= $_SESSION['staff_id'] ?? '' ?>";
            
            // Check if chat popup is open
            const chatPopup = document.getElementById('global-chat-popup-container');
            const isChatOpen = chatPopup && chatPopup.style.display === 'block';

            if (data.type === 'chat' && data.receiver == myId && !isChatOpen) {
                notifCount++;
                notifBadge.textContent = notifCount;
                notifBadge.style.display = 'inline-block';
                
                const sender = data.sender_name || 'Someone';
                const messagePreview = (data.message && data.message.length > 30) 
                    ? data.message.substring(0, 30) + '...' 
                    : (data.message || 'New message');
                
                const notifHTML = `
                    <div class="notif-item" style="padding:8px 12px;border-bottom:1px solid #eee;cursor:pointer;">
                        <strong>New message from ${sender}</strong><br>
                        <small style="color:#666;">${messagePreview}</small>
                        <div style="font-size:0.8em;color:#999;margin-top:4px;">${new Date().toLocaleTimeString()}</div>
                    </div>
                `;
                
                notifMessages.unshift(notifHTML);
                notifList.innerHTML = notifMessages.join('');
            }
        } catch (error) {
            console.error("Error parsing WebSocket message:", error);
        }
    };
}

// Load unread count on page load
document.addEventListener('DOMContentLoaded', function() {
    fetch('/PetSpot_clinic/public/chat/unread-count')
        .then(response => response.json())
        .then(data => {
            if (data.unread_count > 0) {
                notifCount = data.unread_count;
                notifBadge.textContent = notifCount;
                notifBadge.style.display = 'inline-block';
                
                if (data.unread_messages && data.unread_messages.length > 0) {
                    data.unread_messages.forEach(function(msg) {
                        const senderName = msg.sender_name || 'Someone';
                        const messagePreview = (msg.message && msg.message.length > 30) 
                            ? msg.message.substring(0, 30) + '...' 
                            : (msg.message || 'New message');
                        const messageTime = new Date(msg.sent_at).toLocaleString();
                        
                        const notifHTML = `
                            <div class="notif-item" style="padding:8px 12px;border-bottom:1px solid #eee;cursor:pointer;">
                                <strong>New message from ${senderName}</strong><br>
                                <small style="color:#666;">${messagePreview}</small>
                                <div style="font-size:0.8em;color:#999;margin-top:4px;">${messageTime}</div>
                            </div>
                        `;
                        notifMessages.unshift(notifHTML);
                    });
                    notifList.innerHTML = notifMessages.join('');
                } else {
                    const notifHTML = `
                        <div class="notif-item" style="padding:8px 12px;border-bottom:1px solid #eee;cursor:pointer;">
                            <strong>You have ${data.unread_count} unread message(s)</strong><br>
                            <small style="color:#666;">Click to view your messages</small>
                        </div>
                    `;
                    notifMessages.unshift(notifHTML);
                    notifList.innerHTML = notifMessages.join('');
                }
            }
        })
        .catch(error => {
            console.log("Could not load unread count:", error);
        });
});

function toggleGlobalChatPopup() {
    const popup = document.getElementById('global-chat-popup-container');
    popup.style.display = (popup.style.display === 'none' || popup.style.display === '') ? 'block' : 'none';
}
</script>
<script>
function toggleGlobalChatPopup() {
    const popup = document.getElementById('global-chat-popup-container');
    popup.style.display = (popup.style.display === 'none' || popup.style.display === '') ? 'block' : 'none';
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
</html>