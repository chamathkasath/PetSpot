<?php 
if (isset($_SESSION['staff_role']) && $_SESSION['staff_role'] === 'Veterinarian') {
    include __DIR__ . '/../partials/vet_header.php';
} else {
    include __DIR__ . '/../partials/vetstaff_header.php';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Vaccination | PetSpot Clinic</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/PetSpot_clinic/public/assets/css/vetstaff.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body>
    <div class="container-vetstaff">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card advanced-vaccination-card shadow-lg border-0">
                    <div class="card-header bg-gradient-vet d-flex align-items-center">
                        <i class="bi bi-shield-plus me-2 fs-3 text-primary"></i>
                        <span class="fs-4 fw-bold">Add Vaccination Record</span>
                    </div>
                    <div class="card-body">
                        <h2 class="mb-4 text-center vaccination-title">Add Vaccination Record</h2>
                        <hr class="vaccination-divider">
                        <form method="post" action="/PetSpot_clinic/public/vet_vaccinations/add" autocomplete="off">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label"><i class="bi bi-hash"></i> Pet</label>
                                    <select name="pet_ID" id="pet-select" class="form-select form-select-lg" required>
                                        <option value="">Select Pet</option>
                                        <?php foreach ($pets as $pet): ?>
                                            <option value="<?= $pet->pet_ID ?>" data-user="<?= $pet->user_ID ?>">
                                                <?= htmlspecialchars($pet->name) ?> (ID: <?= $pet->pet_ID ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"><i class="bi bi-capsule"></i> Vaccination Name</label>
                                    <input type="text" name="vaccination_name" class="form-control form-control-lg" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"><i class="bi bi-clipboard2-pulse"></i> Vaccination Type</label>
                                    <input type="text" name="vaccination_type" class="form-control form-control-lg">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"><i class="bi bi-calendar-check"></i> Date of Last Vaccine</label>
                                    <input type="date" name="date_of_last_vaccine" class="form-control form-control-lg">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"><i class="bi bi-calendar-event"></i> Next Due Date</label>
                                    <input type="date" name="next_due_date" class="form-control form-control-lg">
                                </div>
                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-vet btn-lg">
                                    <i class="bi bi-plus-circle me-2"></i> Add Vaccination
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
</body>
</html>