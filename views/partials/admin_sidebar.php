<!-- Admin Sidebar Component -->
<nav class="col-md-3 col-lg-2 d-md-block sidebar">
    <div class="brand mb-4">
        <i class="bi bi-heart-pulse"></i> PetSpot Clinic
    </div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link <?= $currentPage === 'dashboard' ? 'active' : '' ?>" href="/PetSpot_clinic/public/admin/dashboard">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $currentPage === 'register-staff' ? 'active' : '' ?>" href="/PetSpot_clinic/public/admin/register-staff">
                <i class="bi bi-person-plus"></i> Register Staff
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $currentPage === 'pet-management' ? 'active' : '' ?>" href="/PetSpot_clinic/public/admin/pet-management">
                <i class="bi bi-paw"></i> Pet Management
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $currentPage === 'appointments' ? 'active' : '' ?>" href="/PetSpot_clinic/public/admin/appointments">
                <i class="bi bi-calendar-event"></i> Appointments
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $currentPage === 'vaccinations' ? 'active' : '' ?>" href="/PetSpot_clinic/public/admin/vaccinations">
                <i class="bi bi-capsule"></i> Vaccinations
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $currentPage === 'users' ? 'active' : '' ?>" href="/PetSpot_clinic/public/admin/users">
                <i class="bi bi-people-fill"></i> Pet Owners
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $currentPage === 'feedbacks' ? 'active' : '' ?>" href="/PetSpot_clinic/public/admin/feedbacks">
                <i class="bi bi-chat-dots"></i> Feedbacks
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $currentPage === 'reports' ? 'active' : '' ?>" href="/PetSpot_clinic/public/admin/reports">
                <i class="bi bi-bar-chart"></i> Reports
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $currentPage === 'found-pets' ? 'active' : '' ?>" href="/PetSpot_clinic/public/admin/found-pets">
                <i class="bi bi-search"></i> Found Pets
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $currentPage === 'adoption-requests' ? 'active' : '' ?>" href="/PetSpot_clinic/public/admin/adoption-requests">
                <i class="bi bi-clipboard-heart"></i> Adoption Requests
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $currentPage === 'health-records' ? 'active' : '' ?>" href="/PetSpot_clinic/public/admin/health-records">
                <i class="bi bi-file-medical"></i> Health Records
            </a>
        </li>
        <li class="nav-item mt-4">
            <a class="nav-link" href="/PetSpot_clinic/public/logout">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </li>
    </ul>
</nav>
