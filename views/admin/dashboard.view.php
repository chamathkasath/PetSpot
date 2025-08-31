<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | PetSpot Clinic</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <?php include __DIR__ . '/../partials/admin_styles.php'; ?>
    <style>
        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        .dashboard-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 2px 8px #0001;
            padding: 2.5rem 1rem 1.2rem 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: box-shadow 0.15s, transform 0.15s;
            cursor: pointer;
            border: 1px solid #f0f0f0;
            text-decoration: none;
        }
        .dashboard-card:hover {
            box-shadow: 0 6px 24px #0002;
            transform: translateY(-4px) scale(1.03);
            border-color: #e0e0e0;
        }
        .dashboard-card .icon {
            font-size: 2.8rem;
            margin-bottom: 0.5rem;
            opacity: 0.92;
        }
        .dashboard-card .card-title {
            font-size: 1rem;
            color: #222;
            margin-bottom: 0;
            font-weight: 500;
            letter-spacing: 0.01em;
        }
        @media (max-width: 900px) {
            .dashboard-cards { grid-template-columns: 1fr 1fr; gap: 1.2rem; }
        }
        @media (max-width: 600px) {
            .dashboard-cards { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php $currentPage = 'dashboard'; include __DIR__ . '/../partials/admin_sidebar.php'; ?>
        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4">
                <h1 class="h2">Admin Dashboard</h1>
            </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mt-4">
                <div class="col">
                    <a href="/PetSpot_clinic/public/admin/pet-management" class="dashboard-card text-center text-decoration-none">
                        <span class="icon text-primary"><i class="bi bi-clipboard-heart"></i></span>
                        <div class="card-title">Pet Management</div>
                    </a>
                </div>
                <div class="col">
                    <a href="/PetSpot_clinic/public/admin/register-staff" class="dashboard-card text-center text-decoration-none">
                        <span class="icon text-success"><i class="bi bi-person-bounding-box"></i></span>
                        <div class="card-title">Staff Directory</div>
                    </a>
                </div>
                <div class="col">
    <a href="/PetSpot_clinic/public/admin/staff" class="dashboard-card text-center text-decoration-none">
        <span class="icon text-info"><i class="bi bi-people"></i></span>
        <div class="card-title">Staff Management</div>
    </a>
</div>
                <div class="col">
                    <a href="/PetSpot_clinic/public/admin/appointments" class="dashboard-card text-center text-decoration-none">
                        <span class="icon text-warning"><i class="bi bi-calendar-week"></i></span>
                        <div class="card-title">Appointments</div>
                    </a>
                </div>
                <div class="col">
                    <a href="/PetSpot_clinic/public/admin/vaccinations" class="dashboard-card text-center text-decoration-none">
                        <span class="icon text-danger"><i class="bi bi-capsule"></i></span>
                        <div class="card-title">Vaccinations</div>
                    </a>
                </div>
                <div class="col">
                    <a href="/PetSpot_clinic/public/admin/users" class="dashboard-card text-center text-decoration-none">
                        <span class="icon text-info"><i class="bi bi-people-fill"></i></span>
                        <div class="card-title">Pet Owners</div>
                    </a>
                </div>
                <div class="col">
                    <a href="/PetSpot_clinic/public/admin/feedbacks" class="dashboard-card text-center text-decoration-none">
                        <span class="icon text-secondary"><i class="bi bi-chat-dots"></i></span>
                        <div class="card-title">Feedbacks</div>
                    </a>
                </div>
                <div class="col">
                    <a href="/PetSpot_clinic/public/admin/reports" class="dashboard-card text-center text-decoration-none">
                        <span class="icon text-dark"><i class="bi bi-bar-chart"></i></span>
                        <div class="card-title">Reports</div>
                    </a>
                </div>
                <div class="col">
                    <a href="/PetSpot_clinic/public/logout" class="dashboard-card text-center text-decoration-none">
                        <span class="icon text-danger"><i class="bi bi-box-arrow-right"></i></span>
                        <div class="card-title">Logout</div>
                    </a>
                </div>
                <div class="col">
                    <a href="/PetSpot_clinic/public/admin/found-pets" class="dashboard-card text-center text-decoration-none">
                        <span class="icon text-info"><i class="bi bi-search"></i></span>
                        <div class="card-title">Found Pets</div>
                    </a>
                </div>
                <div class="col">
                    <a href="/PetSpot_clinic/public/admin/adopted-pets" class="dashboard-card text-center text-decoration-none">
                        <span class="icon text-success"><i class="bi bi-house-heart"></i></span>
                        <div class="card-title">Adopted Pets</div>
                    </a>
                </div>
                <div class="col">
                    <a href="/PetSpot_clinic/public/admin/health-records" class="dashboard-card text-center text-decoration-none">
                        <span class="icon text-secondary"><i class="bi bi-file-medical"></i></span>
                        <div class="card-title">Health Records</div>
                    </a>
                </div>
            </div>
        </main>
    </div>
</div>
</body>
</html>