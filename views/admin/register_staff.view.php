<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Staff | PetSpot Clinic</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #f4f7fa;
            min-height: 100vh;
        }
        .register-card {
            max-width: 500px;
            margin: 40px auto;
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(44,83,100,0.10);
            background: #fff;
            padding: 2.5rem 2rem 2rem 2rem;
        }
        .register-card h2 {
            font-weight: 700;
            margin-bottom: 1.5rem;
        }
        .form-label {
            font-weight: 500;
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
                <div class="register-card">
                    <h2 class="text-center mb-4"><i class="bi bi-person-plus"></i> Register Staff Member</h2>
                    <?php if (!empty($success)): ?>
                        <div class="alert alert-success">Staff registered successfully!</div>
                    <?php elseif (!empty($staff->errors)): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach ($staff->errors as $err): ?>
                                    <li><?= htmlspecialchars($err) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <form method="post" autocomplete="off">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-select" required>
                                <option value="">Select Role</option>
                                <option value="Manager">Manager</option>
                                <option value="Vet Staff">Vet Staff</option>
                                <option value="Veterinarian">Veterinarian</option>
                                <option value="Doctor">Doctor</option>
                                <option value="Pharmacist">Pharmacist</option>
                                <option value="staff">Staff</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contact</label>
                            <input type="text" name="contact" class="form-control" placeholder="Contact" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">NIC</label>
                            <input type="text" name="NIC" class="form-control" placeholder="NIC" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password" required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <button type="submit" class="btn btn-primary px-4">Register</button>
                            <a href="/PetSpot_clinic/public/admin/dashboard" class="btn btn-outline-secondary">Back to Dashboard</a>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</body>
</html>