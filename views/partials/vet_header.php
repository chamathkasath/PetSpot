<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Veterinarian Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="/PetSpot_clinic/public/vet/vetdash">
        PetSpot Clinic - Veterinarian
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="/PetSpot_clinic/public/vet/vetdash">
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/PetSpot_clinic/public/vet_slots">
            Appointments & Slots
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/PetSpot_clinic/public/vet_vaccinations">
            Vaccinations
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/PetSpot_clinic/public/vet/add-health-record">
            Add Health Record
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/PetSpot_clinic/public/vet/add-prescription">
            Add Prescription
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/PetSpot_clinic/public/vet/prescriptions">
            View Prescriptions
          </a>
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

<!-- Same notification scripts as vetstaff header -->
<script>
// Notification bell functionality
document.getElementById('notif-bell').addEventListener('click', function() {
    var notifList = document.getElementById('notif-list');
    if (notifList.style.display === 'none' || notifList.style.display === '') {
        notifList.style.display = 'block';
    } else {
        notifList.style.display = 'none';
    }
});

// Close notification list when clicking outside
document.addEventListener('click', function(e) {
    if (!document.getElementById('notif-bell').contains(e.target)) {
        document.getElementById('notif-list').style.display = 'none';
    }
});

// Check for new notifications (you can implement AJAX call here)
function checkNotifications() {
    // Placeholder - implement your notification check logic
    var notifBadge = document.getElementById('notif-badge');
    var notifList = document.getElementById('notif-list');
    
    // Example: Fetch notifications via AJAX and update badge
    // For now, this is just a placeholder
}

// Check notifications on page load
document.addEventListener('DOMContentLoaded', checkNotifications);
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
