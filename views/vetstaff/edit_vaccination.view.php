
<?php 
if (isset($_SESSION['staff_role']) && $_SESSION['staff_role'] === 'Veterinarian') {
    include __DIR__ . '/../partials/vet_header.php';
} else {
    include __DIR__ . '/../partials/vetstaff_header.php';
}
?>

<!-- filepath: c:\xampp\htdocs\PetSpot_clinic\app\views\vetstaff\edit_vaccination.view.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Vaccination | PetSpot Clinic</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Vaccination Record</h2>
        <form method="post">
            <div class="mb-3">
                <label>Pet</label>
                <select name="pet_ID" class="form-control" required>
                    <?php foreach ($pets as $pet): ?>
                        <option value="<?= $pet->pet_ID ?>" <?= $pet->pet_ID == $vaccination->pet_ID ? 'selected' : '' ?>>
                            <?= htmlspecialchars($pet->name) ?> (ID: <?= $pet->pet_ID ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label>Vaccination Name</label>
                <input type="text" name="vaccination_name" class="form-control" value="<?= htmlspecialchars($vaccination->vaccination_name) ?>" required>
            </div>
            <div class="mb-3">
                <label>Vaccination Type</label>
                <input type="text" name="vaccination_type" class="form-control" value="<?= htmlspecialchars($vaccination->vaccination_type) ?>">
            </div>
            <div class="mb-3">
                <label>Date of Last Vaccine</label>
                <input type="date" name="date_of_last_vaccine" class="form-control" value="<?= htmlspecialchars($vaccination->date_of_last_vaccine) ?>">
            </div>
            <div class="mb-3">
                <label>Next Due Date</label>
                <input type="date" name="next_due_date" class="form-control" value="<?= htmlspecialchars($vaccination->next_due_date) ?>">
            </div>
            <div class="mb-3">
                <label>User ID</label>
                <input type="text" name="user_ID" class="form-control" value="<?= htmlspecialchars($vaccination->user_ID) ?>" readonly>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="/PetSpot_clinic/public/vet_vaccinations" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>