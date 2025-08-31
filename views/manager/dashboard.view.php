<?php include __DIR__ . '/../partials/manager_header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manager Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
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
<div class="container py-4">
    <h2 class="mb-4 text-center">Manager Dashboard</h2>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-4">
        <!-- Pet Profiles Card -->
        <div class="col">
            <a href="/PetSpot_clinic/public/manager/pet-profiles" class="text-decoration-none">
                <div class="card text-center dashboard-card h-100 p-3">
                    <div class="icon text-primary"><i class="bi bi-clipboard-heart"></i></div>
                    <h5 class="card-title">All Pet Profiles</h5>
                    <p class="card-text text-muted">View and manage all pet profiles in the system.</p>
                </div>
            </a>
        </div>
        <!-- Found Pets Card -->
        <div class="col">
            <a href="/PetSpot_clinic/public/manager/manager-found" class="text-decoration-none">
                <div class="card text-center dashboard-card h-100 p-3">
                    <div class="icon text-success"><i class="bi bi-search"></i></div>
                    <h5 class="card-title">Found Pets</h5>
                    <p class="card-text text-muted">See all found pets and add new found pet reports.</p>
                </div>
            </a>
        </div>
        <!-- Lost Pets Card -->
        <div class="col">
            <a href="/PetSpot_clinic/public/manager/manager-lost" class="text-decoration-none">
                <div class="card text-center dashboard-card h-100 p-3">
                    <div class="icon text-warning"><i class="bi bi-exclamation-triangle"></i></div>
                    <h5 class="card-title">Lost Pets</h5>
                    <p class="card-text text-muted">Browse and manage all lost pet reports.</p>
                </div>
            </a>
        </div>
        <!-- Adoption Requests Card -->
        <div class="col">
            <a href="/PetSpot_clinic/public/manager/adoption-requests" class="text-decoration-none">
                <div class="card text-center dashboard-card h-100 p-3">
                    <div class="icon text-info"><i class="bi bi-house-heart"></i></div>
                    <h5 class="card-title">Adoption Requests</h5>
                    <p class="card-text text-muted">View and manage all adoption requests from users.</p>
                </div>
            </a>
        </div>
        <!-- Contact Messages Card -->
        <div class="col">
            <a href="/PetSpot_clinic/public/manager/contact-messages" class="text-decoration-none">
                <div class="card text-center dashboard-card h-100 p-3">
                    <div class="icon text-danger"><i class="bi bi-envelope"></i></div>
                    <h5 class="card-title">Contact Messages</h5>
                    <p class="card-text text-muted">View and respond to user contact messages.</p>
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
function toggleGlobalChatPopup() {
    const popup = document.getElementById('global-chat-popup-container');
    popup.style.display = (popup.style.display === 'none' || popup.style.display === '') ? 'block' : 'none';
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>