<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Health Records | PetSpot Clinic Admin</title>
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
        .btn-edit {
            background: linear-gradient(135deg, #3a7bd5 0%, #00d2ff 100%);
            border: none;
            color: white;
            font-size: 0.8rem;
            padding: 0.25rem 0.5rem;
        }
        .btn-edit:hover {
            background: linear-gradient(135deg, #2a5bc5 0%, #00a2cf 100%);
            color: white;
        }
        .btn-delete {
            background: #dc3545;
            border: none;
            color: white;
            font-size: 0.8rem;
            padding: 0.25rem 0.5rem;
        }
        .btn-delete:hover {
            background: #c82333;
            color: white;
        }
        .table td {
            vertical-align: middle;
            padding: 1rem 0.75rem;
        }
        .table th {
            background: #343a40 !important;
            color: white !important;
            font-weight: 600;
            border: none !important;
        }
        .badge {
            font-size: 0.75rem;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block sidebar">
            <div class="brand mb-4">
                PetSpot Clinic
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="/PetSpot_clinic/public/admin/dashboard">
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/PetSpot_clinic/public/admin/register-staff">
                        Register Staff
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/PetSpot_clinic/public/admin/pet-management">
                        Pet Management
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/PetSpot_clinic/public/admin/appointments">
                        Appointments
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/PetSpot_clinic/public/admin/vaccinations">
                        Vaccinations
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/PetSpot_clinic/public/admin/users">
                        Pet Owners
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/PetSpot_clinic/public/admin/found-pets">
                        Found Pets
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/PetSpot_clinic/public/admin/feedbacks">
                        Feedbacks
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/PetSpot_clinic/public/admin/reports">
                        Reports
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/PetSpot_clinic/public/admin/adoption-requests">
                        <i class="bi bi-clipboard-heart"></i> Adoption Requests
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/PetSpot_clinic/public/admin/health-records">
                        Health Records
                    </a>
                </li>
                <li class="nav-item mt-4">
                    <a class="nav-link" href="/PetSpot_clinic/public/logout">
                        Logout
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="container py-4">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Health Records Management</h2>
                </div>

                <!-- Success/Error Messages -->
                <?php if (isset($_GET['updated'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Health record updated successfully!
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['deleted'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Health record deleted successfully!
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <!-- Health Records Table -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="mb-0">All Health Records</h4>
                                <small class="text-muted">Complete health record information and management</small>
                            </div>
                            <div class="card-body">
                                <?php if (empty($healthRecords)): ?>
                                    <div class="text-center py-5">
                                        <i class="bi bi-file-medical" style="font-size: 4rem; color: #ccc;"></i>
                                        <h5 class="text-muted mt-3">No health records found</h5>
                                        <p class="text-muted">Health records will appear here.</p>
                                    </div>
                                <?php else: ?>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Record ID</th>
                                                    <th>Pet Info</th>
                                                    <th>Owner Info</th>
                                                    <th>Health Status</th>
                                                    <th>Weight</th>
                                                    <th>Height</th>
                                                    <th>Reactions to Vaccinations</th>
                                                    <th>Previous Illness</th>
                                                    <th>Allergies</th>
                                                    <th>Check Date</th>
                                                    <th>Veterinarian</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($healthRecords as $record): ?>
                                                    <tr>
                                                        <td>
                                                            <strong><?= htmlspecialchars($record->health_record_ID) ?></strong>
                                                        </td>
                                                        <td>
                                                            <?php if (!empty($record->pet_name)): ?>
                                                                <div><strong><?= htmlspecialchars($record->pet_name) ?></strong></div>
                                                                <small class="text-muted"><?= htmlspecialchars($record->pet_type ?? '') ?> - <?= htmlspecialchars($record->pet_breed ?? '') ?></small>
                                                            <?php else: ?>
                                                                <span class="text-muted">Pet ID: <?= htmlspecialchars($record->pet_ID) ?></span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php if (!empty($record->owner_name)): ?>
                                                                <div><strong><?= htmlspecialchars($record->owner_name) ?></strong></div>
                                                                <small class="text-muted"><?= htmlspecialchars($record->owner_email ?? '') ?></small>
                                                            <?php else: ?>
                                                                <span class="text-muted">User ID: <?= htmlspecialchars($record->user_ID) ?></span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $status = $record->current_health_status ?? 'Unknown';
                                                            $badgeClass = match(strtolower($status)) {
                                                                'healthy', 'good' => 'bg-success',
                                                                'sick', 'poor' => 'bg-danger',
                                                                'fair', 'moderate' => 'bg-warning',
                                                                default => 'bg-secondary'
                                                            };
                                                            ?>
                                                            <span class="badge <?= $badgeClass ?>"><?= htmlspecialchars($status) ?></span>
                                                        </td>
                                                        <td>
                                                            <?= htmlspecialchars($record->weight ?? 'N/A') ?>
                                                            <?php if (!empty($record->weight)): ?>
                                                                <small class="text-muted"></small>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?= htmlspecialchars($record->height ?? 'N/A') ?>
                                                            <?php if (!empty($record->height)): ?>
                                                                <small class="text-muted"></small>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?= htmlspecialchars($record->reactions_to_vaccines_before ?? 'N/A') ?>
                                                        </td>
                                                        <td>
                                                            <?= htmlspecialchars($record->Previous_illness ?? 'N/A') ?>
                                                        </td>
                                                        <td>
                                                            <?= htmlspecialchars($record->Allergies ?? 'N/A') ?>
                                                        </td>
                                                        <td>
                                                            <?php if (!empty($record->Health_check_date)): ?>
                                                                <?= date('M d, Y', strtotime($record->Health_check_date)) ?>
                                                            <?php else: ?>
                                                                <span class="text-muted">No date</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?= htmlspecialchars($record->vet_name ?? 'N/A') ?>
                                                        </td>
                                                        <td>
                                                            <a href="/PetSpot_clinic/public/admin/health-records/edit?id=<?= $record->health_record_ID ?>" 
                                                               class="btn btn-edit btn-sm">
                                                                Edit
                                                            </a>
                                                            <a href="/PetSpot_clinic/public/admin/health-records/delete?id=<?= $record->health_record_ID ?>" 
                                                               class="btn btn-delete btn-sm" 
                                                               onclick="return confirm('Are you sure you want to delete this health record?')">
                                                                Delete
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
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
