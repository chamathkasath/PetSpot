<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Found Pets | PetSpot Clinic Admin</title>
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
        .btn-add {
            background: linear-gradient(135deg, #3a7bd5 0%, #00d2ff 100%);
            border: none;
            color: white;
            font-weight: 600;
            padding: 0.5rem 1rem;
        }
        .btn-add:hover {
            background: linear-gradient(135deg, #2a5bc5 0%, #00a2cf 100%);
            color: white;
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
                    <a class="nav-link active" href="/PetSpot_clinic/public/admin/found-pets">
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
                    <a class="nav-link" href="/PetSpot_clinic/public/admin/health-records">
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
                    <h2>Found Pets Management</h2>
                    <a href="/PetSpot_clinic/public/admin/found-pets/add" class="btn btn-add">
                        Add Found Pet
                    </a>
                </div>

                <!-- Success/Error Messages -->
                <?php if (isset($_GET['added'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Found pet added successfully!
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['updated'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Found pet updated successfully!
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['deleted'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Found pet deleted successfully!
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <!-- Found Pets Table -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="mb-0">All Found Pets</h4>
                                <small class="text-muted">Complete found pet information and management</small>
                            </div>
                            <div class="card-body">
                                <?php if (empty($foundPets)): ?>
                                    <div class="text-center py-5">
                                        <i class="bi bi-search" style="font-size: 4rem; color: #ccc;"></i>
                                        <h5 class="text-muted mt-3">No found pets records</h5>
                                        <p class="text-muted">Found pet records will appear here.</p>
                                    </div>
                                <?php else: ?>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Image</th>
                                                    <th>Type</th>
                                                    <th>Breed</th>
                                                    <th>Gender</th>
                                                    <th>Color</th>
                                                    <th>Found Date</th>
                                                    <th>Found Location</th>
                                                    <th>Reporter Email</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($foundPets as $pet): ?>
                                                    <tr>
                                                        <td>
                                                            <strong><?= htmlspecialchars($pet->found_ID) ?></strong>
                                                        </td>
                                                        <td>
                                                            <?php if (!empty($pet->image_url)): ?>
                                                                <img src="<?= htmlspecialchars($pet->image_url) ?>" 
                                                                     alt="Found Pet" 
                                                                     style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                                            <?php else: ?>
                                                                <div class="bg-light d-flex align-items-center justify-content-center" 
                                                                     style="width: 50px; height: 50px; border-radius: 5px;">
                                                                    <small class="text-muted">No Image</small>
                                                                </div>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?= htmlspecialchars($pet->type ?? 'N/A') ?></td>
                                                        <td><?= htmlspecialchars($pet->breed ?? 'N/A') ?></td>
                                                        <td><?= htmlspecialchars($pet->gender ?? 'N/A') ?></td>
                                                        <td><?= htmlspecialchars($pet->color ?? 'N/A') ?></td>
                                                        <td>
                                                            <?php if (!empty($pet->found_date)): ?>
                                                                <?= date('M d, Y', strtotime($pet->found_date)) ?>
                                                            <?php else: ?>
                                                                <span class="text-muted">No date</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php if (!empty($pet->found_location)): ?>
                                                                <div style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" 
                                                                     title="<?= htmlspecialchars($pet->found_location) ?>">
                                                                    <?= htmlspecialchars($pet->found_location) ?>
                                                                </div>
                                                            <?php else: ?>
                                                                <span class="text-muted">N/A</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?= htmlspecialchars($pet->reporter_email ?? 'N/A') ?></td>
                                                        <td>
                                                            <?php
                                                            $status = $pet->status ?? 'Unclaimed';
                                                            $badgeClass = match($status) {
                                                                'Adopted' => 'bg-success',
                                                                'Claimed' => 'bg-primary', 
                                                                'Unclaimed' => 'bg-warning',
                                                                default => 'bg-secondary'
                                                            };
                                                            ?>
                                                            <span class="badge <?= $badgeClass ?>"><?= htmlspecialchars($status) ?></span>
                                                        </td>
                                                        <td>
                                                            <a href="/PetSpot_clinic/public/admin/found-pets/edit?id=<?= $pet->found_ID ?>" 
                                                               class="btn btn-edit btn-sm">
                                                                Edit
                                                            </a>
                                                            <a href="/PetSpot_clinic/public/admin/found-pets/delete?id=<?= $pet->found_ID ?>" 
                                                               class="btn btn-delete btn-sm" 
                                                               onclick="return confirm('Are you sure you want to delete this found pet record?')">
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
