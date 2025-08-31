<!-- Pharmacist Navigation Header -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #007bff;">
    <div class="container-fluid">
        <a class="navbar-brand" href="/PetSpot_clinic/public/pharmacist/dashboard">
            <i class="fas fa-pills me-2"></i>Pharmacist Dashboard
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#pharmacistNav" aria-controls="pharmacistNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="pharmacistNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/PetSpot_clinic/public/pharmacist/dashboard">
                        <i class="fas fa-home me-1"></i>Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/PetSpot_clinic/public/pharmacist/prescriptions">
                        <i class="fas fa-prescription-bottle me-1"></i>Prescriptions
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/PetSpot_clinic/public/pharmacist/inventory">
                        <i class="fas fa-boxes me-1"></i>Inventory
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="pharmacistProfileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle me-1"></i>
                        <?= isset($_SESSION['staff_name']) ? htmlspecialchars($_SESSION['staff_name']) : 'Pharmacist' ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="pharmacistProfileDropdown">
                        <li><a class="dropdown-item" href="/PetSpot_clinic/public/staff/profile">
                            <i class="fas fa-user me-2"></i>Profile
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/PetSpot_clinic/public/logout">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
