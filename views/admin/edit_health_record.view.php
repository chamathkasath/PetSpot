<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Health Record | PetSpot Clinic Admin</title>
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
        .btn-primary {
            background: linear-gradient(135deg, #3a7bd5 0%, #00d2ff 100%);
            border: none;
            font-weight: 600;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #2a5bc5 0%, #00a2cf 100%);
        }
        .form-label {
            font-weight: 600;
            color: #495057;
        }
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
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
                    <a class="nav-link" href="/PetSpot_clinic/public/admin/adopted-pets">
                        Adopted Pets
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
                    <h2>Edit Health Record</h2>
                    <a href="/PetSpot_clinic/public/admin/health-records" class="btn btn-secondary">
                        Back to List
                    </a>
                </div>

                <!-- Edit Health Record Form -->
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="mb-0">Health Record Information</h4>
                                <small class="text-muted">Update health record details</small>
                            </div>
                            <div class="card-body">
                                <form method="post">
                                    <input type="hidden" name="record_ID" value="<?= htmlspecialchars($healthRecord->health_record_ID) ?>">
                                    
                                    <!-- Current Pet and Owner Info Display -->
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="border rounded p-3 bg-light">
                                                <h6 class="fw-bold">Current Pet Information</h6>
                                                <p class="mb-1"><strong>Pet:</strong> <?= htmlspecialchars($healthRecord->pet_name ?? 'Unknown') ?></p>
                                                <p class="mb-1"><strong>Type:</strong> <?= htmlspecialchars($healthRecord->pet_type ?? 'N/A') ?></p>
                                                <p class="mb-0"><strong>Breed:</strong> <?= htmlspecialchars($healthRecord->pet_breed ?? 'N/A') ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="border rounded p-3 bg-light">
                                                <h6 class="fw-bold">Current Owner Information</h6>
                                                <p class="mb-1"><strong>Owner:</strong> <?= htmlspecialchars($healthRecord->owner_name ?? 'Unknown') ?></p>
                                                <p class="mb-0"><strong>Email:</strong> <?= htmlspecialchars($healthRecord->owner_email ?? 'N/A') ?></p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pet Selection -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Pet *</label>
                                            <select name="pet_ID" class="form-control" required>
                                                <option value="">Select Pet</option>
                                                <?php foreach ($pets as $pet): ?>
                                                    <option value="<?= $pet->pet_ID ?>" <?= ($pet->pet_ID == $healthRecord->pet_ID) ? 'selected' : '' ?>>
                                                        <?= htmlspecialchars($pet->name ?? 'Unnamed') ?> (<?= htmlspecialchars($pet->type ?? '') ?> - ID: <?= $pet->pet_ID ?>)
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Owner *</label>
                                            <select name="user_ID" class="form-control" required>
                                                <option value="">Select Owner</option>
                                                <?php foreach ($users as $user): ?>
                                                    <option value="<?= $user->user_ID ?>" <?= ($user->user_ID == $healthRecord->user_ID) ? 'selected' : '' ?>>
                                                        <?= htmlspecialchars($user->fullname ?? $user->username) ?> (ID: <?= $user->user_ID ?>)
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Health Information -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Weight (kg)</label>
                                            <input type="number" step="0.1" name="weight" class="form-control" value="<?= htmlspecialchars($healthRecord->weight ?? '') ?>" placeholder="e.g., 25.5">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Height (cm)</label>
                                            <input type="number" step="0.1" name="height" class="form-control" value="<?= htmlspecialchars($healthRecord->height ?? '') ?>" placeholder="e.g., 60.0">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Current Health Status</label>
                                        <input type="text" name="current_health_status" class="form-control" value="<?= htmlspecialchars($healthRecord->current_health_status ?? '') ?>" placeholder="e.g., Healthy, Sick, Fair">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Previous Illness</label>
                                        <textarea name="Previous_illness" class="form-control" rows="3" placeholder="Describe any previous illnesses"><?= htmlspecialchars($healthRecord->Previous_illness ?? '') ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Allergies</label>
                                        <textarea name="Allergies" class="form-control" rows="2" placeholder="List any known allergies"><?= htmlspecialchars($healthRecord->Allergies ?? '') ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Reactions to Vaccines Before</label>
                                        <textarea name="reactions_to_vaccines_before" class="form-control" rows="2" placeholder="Describe any previous vaccine reactions"><?= htmlspecialchars($healthRecord->reactions_to_vaccines_before ?? '') ?></textarea>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Health Check Date *</label>
                                            <input type="date" name="Health_check_date" class="form-control" value="<?= htmlspecialchars($healthRecord->Health_check_date ?? '') ?>" required>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Notes</label>
                                        <textarea name="Note" class="form-control" rows="4" placeholder="Additional notes about the health record"><?= htmlspecialchars($healthRecord->Note ?? '') ?></textarea>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">Update Health Record</button>
                                        <a href="/PetSpot_clinic/public/admin/health-records" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </form>
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
