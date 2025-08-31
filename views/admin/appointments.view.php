
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Appointments | PetSpot Clinic Admin</title>
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
            <div class="container py-4">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><i class="bi bi-calendar-event me-2"></i>Appointment Management</h2>
                </div>

                <!-- Success/Error Messages -->
                <?php if (isset($_GET['deleted'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-trash me-2"></i>Appointment deleted successfully!
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <!-- Appointments Table -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="mb-0"><i class="bi bi-calendar-event me-2"></i>All Appointments</h4>
                                <small class="text-muted">Complete appointment information and management</small>
                            </div>
                            <div class="card-body">
                                <?php if (empty($appointments)): ?>
                                    <div class="text-center py-5">
                                        <i class="bi bi-calendar-event" style="font-size: 4rem; color: #ccc;"></i>
                                        <h5 class="text-muted mt-3">No appointments found</h5>
                                        <p class="text-muted">Scheduled appointments will appear here.</p>
                                    </div>
                                <?php else: ?>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Pet Info</th>
                                                    <th>Owner Info</th>
                                                    <th>Appointment Details</th>
                                                    <th>Type & Reason</th>
                                                    <th>Status</th>
                                                    <th>Payment</th>
                                                    <th>Actions</th>
                                                 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($appointments as $appointment): ?>
                                                    <tr>
                                                        <td>
                                                            <strong><?= htmlspecialchars($appointment->appointment_ID) ?></strong>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <strong><?= htmlspecialchars($appointment->pet_name ?? 'Unknown Pet') ?></strong>
                                                            </div>
                                                            <small class="text-muted">Pet ID: <?= htmlspecialchars($appointment->pet_ID ?? 'N/A') ?></small>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <strong><?= htmlspecialchars($appointment->owner_name ?? 'Unknown Owner') ?></strong>
                                                            </div>
                                                          
                                                        </td>
                                                        <td>
                                                            <div><strong>Date:</strong> <?= htmlspecialchars($appointment->date ?? 'N/A') ?></div>
                                                            <div><strong>Time:</strong> <?= htmlspecialchars($appointment->time ?? 'N/A') ?></div>
                                                            
                                                        </td>
                                                        <td>
                                                            <div><strong>Type:</strong> <?= htmlspecialchars(ucfirst($appointment->type ?? 'General')) ?></div>
                                                            <?php if (!empty($appointment->reason)): ?>
                                                                <div style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" 
                                                                     title="<?= htmlspecialchars($appointment->reason) ?>">
                                                                    <small><strong>Reason:</strong> <?= htmlspecialchars($appointment->reason) ?></small>
                                                                </div>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $status = strtolower(trim($appointment->status ?? 'pending'));
                                                                if ($status === 'accepted') {
                                                                    echo '<span class="badge bg-success">Accepted</span>';
                                                                } elseif ($status === 'rejected') {
                                                                    echo '<span class="badge bg-danger">Rejected</span>';
                                                                } else {
                                                                    echo '<span class="badge bg-warning text-dark">Pending</span>';
                                                                }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                $paymentStatus = strtolower(trim($appointment->payment_status ?? 'pending'));
                                                                if ($paymentStatus === 'paid') {
                                                                    echo '<span class="badge bg-success">Paid</span>';
                                                                } elseif ($paymentStatus === 'failed') {
                                                                    echo '<span class="badge bg-danger">Failed</span>';
                                                                } elseif ($paymentStatus === 'pending' || $paymentStatus === 'unpaid') {
                                                                    // For cash and card payments, show "Paid at Clinic" instead of unpaid
                                                                    $appointmentType = strtolower(trim($appointment->type ?? 'physical'));
                                                                    if ($appointmentType === 'physical') {
                                                                        echo '<span class="badge bg-info">Paid at Clinic</span>';
                                                                    } else {
                                                                        echo '<span class="badge bg-warning text-dark">Pending</span>';
                                                                    }
                                                                } else {
                                                                    echo '<span class="badge bg-warning text-dark">Pending</span>';
                                                                }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <a href="/PetSpot_clinic/public/admin/delete-appointment?id=<?= $appointment->appointment_ID ?>" 
                                                               class="btn btn-delete btn-sm" 
                                                               onclick="return confirm('Are you sure you want to delete this appointment?')">
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