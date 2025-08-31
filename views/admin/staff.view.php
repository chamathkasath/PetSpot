
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Management | Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            background: #f4f7fa;
            min-height: 100vh;
        }
        .sidebar {
            background: linear-gradient(135deg, #3a7bd5 0%, #00d2ff 100%);
            min-height: 100vh;
            color: #fff;
            padding: 2rem 1rem;
        }
        .sidebar .nav-link {
            color: #fff;
            font-weight: 500;
            margin-bottom: 1rem;
            border-radius: 8px;
            transition: background 0.2s;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.15);
        }
        .sidebar .brand {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar">
                <div class="brand mb-4">
                    <i class="bi bi-heart-pulse"></i> PetSpot Clinic
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="/PetSpot_clinic/public/admin/dashboard">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PetSpot_clinic/public/admin/register-staff">
                            <i class="bi bi-person-plus"></i> Register Staff
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PetSpot_clinic/public/admin/pet-management">
                            <i class="bi bi-paw"></i> Pet Management
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PetSpot_clinic/public/admin/appointments">
                            <i class="bi bi-calendar-event"></i> Appointments
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PetSpot_clinic/public/admin/vaccinations">
                            <i class="bi bi-capsule"></i> Vaccinations
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PetSpot_clinic/public/admin/users">
                            <i class="bi bi-people-fill"></i> Pet Owners
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PetSpot_clinic/public/admin/feedbacks">
                            <i class="bi bi-chat-dots"></i> Feedbacks
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PetSpot_clinic/public/admin/reports">
                            <i class="bi bi-bar-chart"></i> Reports
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PetSpot_clinic/public/admin/found-pets">
                            <i class="bi bi-search"></i> Found Pets
                        </a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="/PetSpot_clinic/public/admin/adoption-requests">
                        <i class="bi bi-clipboard-heart"></i> Adoption Requests
                    </a>
                </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PetSpot_clinic/public/admin/health-records">
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

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container mt-5">
                    <h2>Staff Management</h2>
                    <div class="mb-3">
                        <a href="/PetSpot_clinic/public/admin/register-staff" class="btn btn-success btn-sm">+ Register Staff</a>
                        <a href="/PetSpot_clinic/public/admin/dashboard" class="btn btn-secondary btn-sm">&larr; Back to Dashboard</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($staff as $s): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($s->staff_id) ?></td>
                                        <td><?= htmlspecialchars($s->username) ?></td>
                                        <td><?= htmlspecialchars($s->email ?? '') ?></td>
                                        <td><?= htmlspecialchars($s->role ?? 'Staff') ?></td>
                                        <td>
                                            <a href="/PetSpot_clinic/public/admin/staff/edit?id=<?= $s->staff_id ?>" class="btn btn-sm btn-primary">Edit</a>
                                            <a href="/PetSpot_clinic/public/admin/staff/delete?id=<?= $s->staff_id ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this staff member?');">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php if (empty($staff)): ?>
                                    <tr><td colspan="5" class="text-center">No staff found.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>