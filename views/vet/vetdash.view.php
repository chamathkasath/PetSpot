<?php 
if (isset($_SESSION['staff_role']) && $_SESSION['staff_role'] === 'Veterinarian') {
    include __DIR__ . '/../partials/vet_header.php';
} else {
    include __DIR__ . '/../partials/vetstaff_header.php';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Veterinarian Dashboard</title>
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
        .vet-chat-icon {
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
<div class="container py-4">
    <h2 class="mb-4 text-center">Veterinarian Dashboard</h2>
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-center dashboard-card h-100 p-3">
                <div class="icon text-primary"><i class="bi bi-calendar-week"></i></div>
                <h5 class="card-title">Total Appointments</h5>
                <p class="display-6"><?= isset($totalAppointments) ? $totalAppointments : '0' ?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center dashboard-card h-100 p-3">
                <div class="icon text-success"><i class="bi bi-people"></i></div>
                <h5 class="card-title">Total Users</h5>
                <p class="display-6"><?= isset($totalUsers) ? $totalUsers : '0' ?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center dashboard-card h-100 p-3">
                <div class="icon text-warning"><i class="bi bi-clock"></i></div>
                <h5 class="card-title">Upcoming Appointments</h5>
                <p class="display-6"><?= isset($totalUpcoming) ? $totalUpcoming : '0' ?></p>
            </div>
        </div>
    </div>
    <div class="row g-4">
        <!-- Appointments & Slots Card -->
        <div class="col-md-4">
            <a href="/PetSpot_clinic/public/vet_slots" class="text-decoration-none">
                <div class="card text-center dashboard-card h-100 p-3">
                    <div class="icon text-primary"><i class="bi bi-calendar-week"></i></div>
                    <h5 class="card-title">Appointments & Slots</h5>
                    <p class="card-text text-muted">Manage appointments and available slots.</p>
                </div>
            </a>
        </div>
        <!-- Vaccinations Card -->
        <div class="col-md-4">
            <a href="/PetSpot_clinic/public/vet_vaccinations" class="text-decoration-none">
                <div class="card text-center dashboard-card h-100 p-3">
                    <div class="icon text-danger"><i class="bi bi-capsule"></i></div>
                    <h5 class="card-title">Vaccinations</h5>
                    <p class="card-text text-muted">Manage and record pet vaccinations.</p>
                </div>
            </a>
        </div>
        <!-- Add Health Record Card -->
        <div class="col-md-4">
            <a href="/PetSpot_clinic/public/vet/add-health-record" class="text-decoration-none">
                <div class="card text-center dashboard-card h-100 p-3">
                    <div class="icon text-success"><i class="bi bi-file-earmark-medical"></i></div>
                    <h5 class="card-title">Add Health Record</h5>
                    <p class="card-text text-muted">Add new health records for pets.</p>
                </div>
            </a>
        </div>
        <!-- Add Prescription Card -->
        <div class="col-md-4">
            <a href="/PetSpot_clinic/public/vet/add-prescription" class="text-decoration-none">
                <div class="card text-center dashboard-card h-100 p-3">
                    <div class="icon text-warning"><i class="bi bi-clipboard-plus"></i></div>
                    <h5 class="card-title">Add Prescription</h5>
                    <p class="card-text text-muted">Create and manage prescriptions.</p>
                </div>
            </a>
        </div>
        <!-- View Prescriptions Card -->
        <div class="col-md-4">
            <a href="/PetSpot_clinic/public/vet/prescriptions" class="text-decoration-none">
                <div class="card text-center dashboard-card h-100 p-3">
                    <div class="icon text-info"><i class="bi bi-file-earmark-text"></i></div>
                    <h5 class="card-title">View Prescriptions</h5>
                    <p class="card-text text-muted">View all prescriptions issued.</p>
                </div>
            </a>
        </div>
        <!-- Logout Card -->
        <div class="col-md-4">
            <a href="/PetSpot_clinic/public/logout" class="text-decoration-none">
                <div class="card text-center dashboard-card h-100 p-3">
                    <div class="icon text-danger"><i class="bi bi-box-arrow-right"></i></div>
                    <h5 class="card-title">Logout</h5>
                    <p class="card-text text-muted">Sign out of your account.</p>
                </div>
            </a>
        </div>
    </div>
</div>

<!-- Chat Icon -->
<div class="vet-chat-icon" onclick="toggleVetChatPopup()">
    <i class="fa-regular fa-comments"></i>
</div>

<!-- Chat Popup -->
<div id="vet-chat-popup-container" style="display:none; position:fixed; bottom:100px; right:30px; width:370px; height:540px; border-radius:20px; border:1px solid #e0e0e0; box-shadow: 0 8px 32px rgba(44,83,100,0.18); z-index:10000; background:#fff; overflow:hidden;">
    <iframe id="vet-chat-popup-frame" src="/PetSpot_clinic/public/chat" style="width:100%; height:100%; border:none; border-radius:20px;"></iframe>
</div>
<script>
function toggleVetChatPopup() {
    const popup = document.getElementById('vet-chat-popup-container');
    popup.style.display = (popup.style.display === 'none' || popup.style.display === '') ? 'block' : 'none';
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>