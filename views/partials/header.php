<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<nav class="navbar navbar-expand-lg navbar-light custom-navbar py-3">
  <div class="container">
    <div class="navbar-left">
      <ul class="navbar-nav left">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/PetSpot_clinic/public/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/PetSpot_clinic/public/pets">Pet</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/PetSpot_clinic/public/aboutus">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/PetSpot_clinic/public/contact">Contact Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/PetSpot_clinic/public/healthrecord/user_records">Health Records</a>
        </li>
      </ul>
    </div>
    <a class="navbar-brand" href="/PetSpot_clinic/public/" style="display: flex; align-items: center; text-decoration: none;">
      <div style="width: 45px; height: 45px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3); background: #f8f9fa;">
        <img src="/PetSpot_clinic/public/assets/images/head1.jpg" alt="Logo" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.style.display='none'"/>
      </div>
      <span class="brand-text" style="font-weight: 600; font-size: 1.4rem; color: #1f2937;">PetSpot Clinic</span>
    </a>
    <div class="navbar-right">
      <ul class="navbar-nav right">
        <li class="nav-item">
          <a class="nav-link" href="/PetSpot_clinic/public/appointment">Appointments</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/PetSpot_clinic/public/vaccinations">Vaccinations</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/PetSpot_clinic/public/blogs">Blogs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/PetSpot_clinic/public/found-pet">Found Pets</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/PetSpot_clinic/public/pets/lost">Lost Pets</a>
        </li>
        <?php if (empty($_SESSION['user_ID'])): ?>
          <li class="nav-item">
            <a href="/PetSpot_clinic/public/login" class="btn btn-outline-light btn-sm nav-btn">Login</a>
          </li>
        <?php else: ?>
          <!-- Bell Icon -->
          <li class="nav-item">
            <div id="notif-bell" style="position:relative;display:inline-block;cursor:pointer;margin-right:15px;margin-top:8px;">
              <i class="fa-regular fa-bell" style="font-size:24px;color:#1f2937;transition:color 0.3s;"></i>
              <span id="notif-badge" style="background:#dc3545;color:#fff;border-radius:50%;padding:2px 6px;font-size:11px;display:none;position:absolute;top:-5px;right:-8px;min-width:18px;text-align:center;font-weight:bold;box-shadow:0 2px 6px rgba(0,0,0,0.15);">0</span>
            </div>
            <!-- Notification List Popup -->
            <div id="notif-list" style="display:none;position:absolute;top:50px;right:10px;background:#fff;border:1px solid #eee;box-shadow:0 2px 8px rgba(0,0,0,0.12);border-radius:8px;min-width:220px;z-index:9999;padding:10px;">
              No new notifications
            </div>
          </li>
          <li class="nav-item">
            <a href="/PetSpot_clinic/public/profile" class="nav-link" title="My Profile" style="padding: 8px 12px;">
              <i class="fa-solid fa-user-circle" style="font-size:24px;color:#1f2937;transition:color 0.3s;"></i>
            </a>
          </li>
          <li class="nav-item">
            <a href="/PetSpot_clinic/public/logout" class="btn btn-danger btn-sm nav-btn logout-btn">Logout</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>

<!-- Notification Bell Icon -->
<style>
/* Bell and Profile Icon Hover Effects */
#notif-bell:hover i {
    color: #3498db !important;
    transform: scale(1.1);
}

.nav-link[href*="profile"]:hover i {
    color: #3498db !important;
    transform: scale(1.1);
}

#notif-bell i,
.nav-link[href*="profile"] i {
    transition: all 0.3s ease;
}
</style>

<script>
let notifCount = 0; //initialize notification count
let notifMessages = []; //store all notifications

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
    console.log("Initializing WebSocket for notifications...");
    window.wsNotif = new WebSocket('ws://localhost:8080');

    window.wsNotif.onopen = function() {
        console.log("WebSocket connected for notifications.");
        window.wsNotif.send(JSON.stringify({
            type: "identify",
            user_id: "<?= $_SESSION['user_ID'] ?? $_SESSION['staff_id'] ?>"
        }));
    };

    window.wsNotif.onmessage = function(event) {
        console.log("=== NOTIFICATION DEBUG ===");
        console.log("Raw WebSocket data:", event.data);
        
        try {
            const data = JSON.parse(event.data);
            console.log("Parsed data:", data);
            
            const myId = "<?= $_SESSION['user_ID'] ?? $_SESSION['staff_id'] ?>";
            console.log("My ID:", myId, "(type:", typeof myId, ")");
            console.log("Receiver ID:", data.receiver, "(type:", typeof data.receiver, ")");
            console.log("Message type:", data.type);
            
            // Check if chat popup is open
            const chatPopup = document.getElementById('global-chat-popup-container');
            const isChatOpen = chatPopup && chatPopup.style.display === 'block';
            console.log("Chat popup element found:", !!chatPopup);
            console.log("Chat popup display style:", chatPopup ? chatPopup.style.display : 'N/A');
            console.log("Is chat open:", isChatOpen);

            // Check all conditions
            const isChat = data.type === 'chat';
            const isForMe = data.receiver == myId;
            const chatClosed = !isChatOpen;
            
            console.log("Condition checks:");
            console.log("- Is chat message:", isChat);
            console.log("- Is for me:", isForMe);
            console.log("- Chat closed:", chatClosed);
            console.log("- All conditions met:", isChat && isForMe && chatClosed);

            if (isChat && isForMe && chatClosed) {
                console.log("✓ Showing notification for message:", data.message);
                
                notifCount++;
                console.log("Updated notification count:", notifCount);
                
                notifBadge.textContent = notifCount;
                notifBadge.style.display = 'inline-block';
                console.log("Badge updated - text:", notifBadge.textContent, "display:", notifBadge.style.display);
                
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
                
                console.log("✓ Notification fully processed");
            } else {
                console.log("✗ Notification conditions not met");
            }
        } catch (error) {
            console.error("Error parsing WebSocket message:", error);
        }
        
        console.log("=== END DEBUG ===");
    };

    window.wsNotif.onerror = function(error) {
        console.error("WebSocket error:", error);
    };

    window.wsNotif.onclose = function() {
        console.log("WebSocket connection closed.");
    };
}

// Load unread count on page load
document.addEventListener('DOMContentLoaded', function() {
    fetch('/PetSpot_clinic/public/chat/unread-count')
        .then(response => response.json())
        .then(data => {
            console.log("Loaded unread count:", data.unread_count);
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
                    // Fallback for when we have count but no message details
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
