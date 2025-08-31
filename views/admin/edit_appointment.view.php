<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Appointment | PetSpot Clinic Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
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
        .form-control:focus {
            border-color: #3a7bd5;
            box-shadow: 0 0 0 0.2rem rgba(58, 123, 213, 0.25);
        }
        .btn-primary {
            background: linear-gradient(135deg, #3a7bd5 0%, #00d2ff 100%);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #2c5aa0 0%, #00a8cc 100%);
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
                    <a class="nav-link" href="/PetSpot_clinic/public/admin/dashboard">
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
                    <a class="nav-link active" href="/PetSpot_clinic/public/admin/appointments">
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
                    <a class="nav-link" href="/PetSpot_clinic/public/admin/adopted-pets">
                        <i class="bi bi-house-heart"></i> Adopted Pets
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
            <div class="container py-4">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><i class="bi bi-calendar-event me-2"></i>Edit Appointment</h2>
                    <a href="/PetSpot_clinic/public/admin/appointments" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back to Appointments
                    </a>
                </div>

                <!-- Edit Form -->
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="mb-0">Appointment Details</h4>
                            </div>
                            <div class="card-body">
                                <?php if (isset($appointment) && $appointment): ?>
                                    <form method="POST">
                                        <input type="hidden" name="appointment_ID" value="<?= $appointment->appointment_ID ?>">
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="date" class="form-label">Date</label>
                                                    <input type="date" class="form-control" id="date" name="date" value="<?= htmlspecialchars($appointment->date ?? '') ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="time" class="form-label">Time</label>
                                                    <input type="time" class="form-control" id="time" name="time" value="<?= htmlspecialchars($appointment->time ?? '') ?>" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="type" class="form-label">Type</label>
                                                    <select class="form-control" id="type" name="type" required>
                                                        <option value="general" <?= ($appointment->type ?? '') === 'general' ? 'selected' : '' ?>>General</option>
                                                        <option value="emergency" <?= ($appointment->type ?? '') === 'emergency' ? 'selected' : '' ?>>Emergency</option>
                                                        <option value="checkup" <?= ($appointment->type ?? '') === 'checkup' ? 'selected' : '' ?>>Checkup</option>
                                                        <option value="vaccination" <?= ($appointment->type ?? '') === 'vaccination' ? 'selected' : '' ?>>Vaccination</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Status</label>
                                                    <select class="form-control" id="status" name="status" required>
                                                        <option value="pending" <?= ($appointment->status ?? '') === 'pending' ? 'selected' : '' ?>>Pending</option>
                                                        <option value="accepted" <?= ($appointment->status ?? '') === 'accepted' ? 'selected' : '' ?>>Accepted</option>
                                                        <option value="rejected" <?= ($appointment->status ?? '') === 'rejected' ? 'selected' : '' ?>>Rejected</option>
                                                        <option value="completed" <?= ($appointment->status ?? '') === 'completed' ? 'selected' : '' ?>>Completed</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="reason" class="form-label">Reason</label>
                                            <textarea class="form-control" id="reason" name="reason" rows="3"><?= htmlspecialchars($appointment->reason ?? '') ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="amount" class="form-label">Amount ($)</label>
                                            <input type="number" step="0.01" class="form-control" id="amount" name="amount" value="<?= htmlspecialchars($appointment->amount ?? '') ?>">
                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <a href="/PetSpot_clinic/public/admin/appointments" class="btn btn-secondary">Cancel</a>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-check-circle"></i> Update Appointment
                                            </button>
                                        </div>
                                    </form>
                                <?php else: ?>
                                    <div class="text-center py-5">
                                        <h5 class="text-muted">Appointment not found</h5>
                                        <a href="/PetSpot_clinic/public/admin/appointments" class="btn btn-primary mt-3">Back to Appointments</a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
