<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Pet | PetSpot Clinic Admin</title>
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
                    <h2><i class="bi bi-pencil me-2"></i>Edit Pet</h2>
                    <a href="/PetSpot_clinic/public/admin/pet-management" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back to Pet Management
                    </a>
                </div>

                <!-- Edit Pet Form -->
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="mb-0">Edit Pet Information</h4>
                            </div>
                            <div class="card-body">
                                <?php if (isset($pet)): ?>
                                    <form method="POST" action="/PetSpot_clinic/public/admin/edit-pet">
                                        <input type="hidden" name="pet_ID" value="<?= $pet->pet_ID ?>">
                                        
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Pet Name</label>
                                            <input type="text" class="form-control" id="name" name="name" 
                                                   value="<?= htmlspecialchars($pet->name ?? '') ?>" required>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="species" class="form-label">Species</label>
                                            <select class="form-control" id="species" name="species" required>
                                                <option value="dog" <?= ($pet->species ?? '') === 'dog' ? 'selected' : '' ?>>Dog</option>
                                                <option value="cat" <?= ($pet->species ?? '') === 'cat' ? 'selected' : '' ?>>Cat</option>
                                                <option value="bird" <?= ($pet->species ?? '') === 'bird' ? 'selected' : '' ?>>Bird</option>
                                                <option value="rabbit" <?= ($pet->species ?? '') === 'rabbit' ? 'selected' : '' ?>>Rabbit</option>
                                                <option value="other" <?= ($pet->species ?? '') === 'other' ? 'selected' : '' ?>>Other</option>
                                            </select>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="breed" class="form-label">Breed</label>
                                            <input type="text" class="form-control" id="breed" name="breed" 
                                                   value="<?= htmlspecialchars($pet->breed ?? '') ?>">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="age" class="form-label">Age</label>
                                            <input type="number" class="form-control" id="age" name="age" 
                                                   value="<?= htmlspecialchars($pet->age ?? '') ?>" min="0">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="gender" class="form-label">Gender</label>
                                            <select class="form-control" id="gender" name="gender" required>
                                                <option value="male" <?= ($pet->gender ?? '') === 'male' ? 'selected' : '' ?>>Male</option>
                                                <option value="female" <?= ($pet->gender ?? '') === 'female' ? 'selected' : '' ?>>Female</option>
                                            </select>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-control" id="status" name="status" required>
                                                <option value="active" <?= ($pet->status ?? '') === 'active' ? 'selected' : '' ?>>Active</option>
                                                <option value="lost" <?= ($pet->status ?? '') === 'lost' ? 'selected' : '' ?>>Lost</option>
                                                <option value="found" <?= ($pet->status ?? '') === 'found' ? 'selected' : '' ?>>Found</option>
                                                <option value="adopted" <?= ($pet->status ?? '') === 'adopted' ? 'selected' : '' ?>>Adopted</option>
                                            </select>
                                        </div>
                                        
                                        <div class="d-flex justify-content-between">
                                            <a href="/PetSpot_clinic/public/admin/pet-management" class="btn btn-secondary">Cancel</a>
                                            <button type="submit" class="btn btn-primary">Update Pet</button>
                                        </div>
                                    </form>
                                <?php else: ?>
                                    <div class="alert alert-danger">
                                        Pet not found.
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
