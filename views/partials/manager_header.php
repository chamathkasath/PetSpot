<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/PetSpot_clinic/public/manager/dashboard">Manager Dashboard</a>
        <div class="collapse navbar-collapse" id="managerNavbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/PetSpot_clinic/public/manager/dashboard">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/PetSpot_clinic/public/manager/pet-profiles">All Pet Profiles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/PetSpot_clinic/public/manager/manager-found">Found Pets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/PetSpot_clinic/public/manager/manager-lost">Lost Pets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/PetSpot_clinic/public/manager/feedbacks">Feedbacks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/PetSpot_clinic/public/manager/adoption-requests">Adoption Requests</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/PetSpot_clinic/public/manager/contact-messages">Contact Messages</a>
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
                
                // Add to notification list
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
                
                // Add actual unread messages to the notification list
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
</script>