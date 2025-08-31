
<!DOCTYPE html>
<html>
<head>
    <title>Chat - PetSpot Clinic</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background: #f8f9fa;
        }
        .chat-container {
            max-width: 400px;
            margin: 40px auto;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(44,83,100,0.10);
            padding: 32px 24px;
        }
        .chat-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 18px;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }
        .list-group-item {
            border: none;
            border-radius: 8px;
            margin-bottom: 6px;
            transition: background 0.2s;
        }
        .list-group-item:hover {
            background: #f1f5ff;
        }
        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-top: 20px;
            margin-bottom: 8px;
            color: #333;
        }
        .fa-user, .fa-user-tie {
            color: #2563eb;
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <div class="chat-title">
            <div class="d-flex align-items-center">
                <i class="fa-regular fa-comments"></i> Start a Chat
            </div>
            <button class="btn-close" onclick="closeChatPopup()" title="Close Chat" style="background: none; border: none; font-size: 1.2rem; color: #666; cursor: pointer;">&times;</button>
        </div>
        <div class="section-title">Staff</div>
        <ul class="list-group mb-3">
            <?php foreach ($staff as $s): ?>
                <li class="list-group-item">
                    <a href="/PetSpot_clinic/public/chat/conversation?with_id=<?= $s->staff_id ?>&with_type=staff" class="text-decoration-none text-dark">
                        <i class="fa-solid fa-user-tie"></i>
                        <?= htmlspecialchars(($s->role ?? 'Staff') . ' - ' . ($s->username ?? $s->staff_id)) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="section-title">Users</div>
        <ul class="list-group">
            <?php foreach ($users as $u): ?>
                <li class="list-group-item">
                    <a href="/PetSpot_clinic/public/chat/conversation?with_id=<?= $u->user_ID ?>&with_type=user" class="text-decoration-none text-dark">
                        <i class="fa-solid fa-user"></i>
                        <?= htmlspecialchars($u->fullname ?? $u->user_ID) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    
    <script>
        function closeChatPopup() {
            // If in iframe, close the parent popup
            if(window.parent && typeof window.parent.toggleGlobalChatPopup === 'function') {
                window.parent.toggleGlobalChatPopup();
            } else if(window.parent && typeof window.parent.toggleVetChatPopup === 'function') {
                window.parent.toggleVetChatPopup();
            } else if(window.parent && window.parent !== window) {
                // Try to find and hide chat popup containers in parent
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
            } else {
                // Fallback - close current window
                window.close();
            }
        }
    </script>
</body>
</html>