<!-- filepath: app/views/admin/pet_management.view.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pet Management | PetSpot Clinic Admin</title>
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
            background: #007bff;
            border: none;
            color: white;
            font-size: 0.8rem;
            padding: 0.25rem 0.5rem;
            margin-right: 0.25rem;
        }
        .btn-edit:hover {
            background: #0056b3;
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
                    <a class="nav-link active" href="/PetSpot_clinic/public/admin/pet-management">
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
            <div class="container py-4">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><i class="bi bi-paw me-2"></i>Pet Management</h2>
                </div>

                <!-- Success/Error Messages -->
                <?php if (isset($_GET['updated'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>Pet updated successfully!
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['deleted'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-trash me-2"></i>Pet deleted successfully!
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <!-- Pet Owners & Pets Table -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="mb-0"><i class="bi bi-paw me-2"></i>All Pet Details</h4>
                                <small class="text-muted">Complete information about pets and their owners</small>
                            </div>
                            <div class="card-body">
                                <?php if (empty($owners)): ?>
                                    <div class="text-center py-5">
                                        <i class="bi bi-paw" style="font-size: 4rem; color: #ccc;"></i>
                                        <h5 class="text-muted mt-3">No pets found</h5>
                                        <p class="text-muted">Pet owners and their pets will appear here.</p>
                                    </div>
                                <?php else: ?>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Pet ID</th>
                                                    <th>Owner Info</th>
                                                    <th>Pet Details</th>
                                                    <th>Physical Info</th>
                                                    <th>Registration</th>
                                                    <th>Status</th>
                                                    <th>Special Info</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($owners as $row): ?>
                                                    <tr>
                                                        <td>
                                                            <?php if (!empty($row->pet_ID)): ?>
                                                                <strong>#<?= $row->pet_ID ?></strong>
                                                            <?php else: ?>
                                                                <span class="text-muted">No pet</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <strong><?= htmlspecialchars($row->username) ?></strong>
                                                            </div>
                                                            <small class="text-muted"><?= htmlspecialchars($row->email) ?></small>
                                                        </td>
                                                        <td>
                                                            <?php if (!empty($row->pet_name)): ?>
                                                                <div><strong><?= htmlspecialchars($row->pet_name) ?></strong></div>
                                                                <?php if (!empty($row->type)): ?>
                                                                    <small class="text-muted">Type: <?= htmlspecialchars($row->type) ?></small>
                                                                <?php endif; ?>
                                                                <?php if (!empty($row->breed)): ?>
                                                                    <br><small class="text-muted">Breed: <?= htmlspecialchars($row->breed) ?></small>
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                <span class="text-muted">No pet registered</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php if (!empty($row->pet_name)): ?>
                                                                <?php if (!empty($row->color)): ?>
                                                                    <div><small><strong>Color:</strong> <?= htmlspecialchars($row->color) ?></small></div>
                                                                <?php endif; ?>
                                                                <?php if (!empty($row->gender)): ?>
                                                                    <div><small><strong>Gender:</strong> <?= htmlspecialchars($row->gender) ?></small></div>
                                                                <?php endif; ?>
                                                                <?php if (!empty($row->special_markings)): ?>
                                                                    <div><small><strong>Markings:</strong> <?= htmlspecialchars($row->special_markings) ?></small></div>
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                <span class="text-muted">-</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php if (!empty($row->date_registered)): ?>
                                                                <small><?= date('M d, Y', strtotime($row->date_registered)) ?></small>
                                                            <?php else: ?>
                                                                <span class="text-muted">-</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                if (empty($row->pet_status)) {
                                                                    echo '<span class="text-muted">-</span>';
                                                                } elseif ($row->pet_status === 'active') {
                                                                    echo '<span class="badge bg-success">Active</span>';
                                                                } elseif ($row->pet_status === 'lost') {
                                                                    echo '<span class="badge bg-danger">Lost</span>';
                                                                    if (!empty($row->last_seen_location)) {
                                                                        echo '<br><small class="text-muted">Last seen: ' . htmlspecialchars($row->last_seen_location) . '</small>';
                                                                    }
                                                                    if (!empty($row->last_seen_date)) {
                                                                        echo '<br><small class="text-muted">' . date('M d, Y', strtotime($row->last_seen_date)) . '</small>';
                                                                    }
                                                                } elseif ($row->pet_status === 'adopted') {
                                                                    echo '<span class="badge bg-primary">Adopted</span>';
                                                                } else {
                                                                    echo '<span class="badge bg-secondary">' . htmlspecialchars($row->pet_status) . '</span>';
                                                                }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php if (!empty($row->special_note)): ?>
                                                                <div style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" 
                                                                     title="<?= htmlspecialchars($row->special_note) ?>">
                                                                    <small><?= htmlspecialchars($row->special_note) ?></small>
                                                                </div>
                                                            <?php else: ?>
                                                                <span class="text-muted">-</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php if (!empty($row->pet_ID)): ?>
                                                                <a href="/PetSpot_clinic/public/admin/edit-pet?id=<?= $row->pet_ID ?>" 
                                                                   class="btn btn-edit btn-sm">
                                                                    Edit
                                                                </a>
                                                                <a href="/PetSpot_clinic/public/admin/delete-pet?id=<?= $row->pet_ID ?>" 
                                                                   class="btn btn-delete btn-sm" 
                                                                   onclick="return confirm('Are you sure you want to delete this pet?')">
                                                                    Delete
                                                                </a>
                                                            <?php else: ?>
                                                                <span class="text-muted">No actions</span>
                                                            <?php endif; ?>
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