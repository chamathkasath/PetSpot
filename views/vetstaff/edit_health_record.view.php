<?php 
if (isset($_SESSION['staff_role']) && $_SESSION['staff_role'] === 'Veterinarian') {
    include __DIR__ . '/../partials/vet_header.php';
} else {
    include __DIR__ . '/../partials/vetstaff_header.php';
}
?>
<!-- filepath: c:\xampp\htdocs\PetSpot_clinic\app\views\vetstaff\edit_health_record.view.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Health Record</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Health Record</h2>
    <form method="post">
        <div class="mb-3">
            <label>Weight</label>
            <input type="text" name="weight" class="form-control" value="<?= htmlspecialchars($record->weight) ?>" required>
        </div>
        <div class="mb-3">
            <label>Height</label>
            <input type="text" name="height" class="form-control" value="<?= htmlspecialchars($record->height) ?>" required>
        </div>
        <div class="mb-3">
            <label>Current Health Status</label>
            <input type="text" name="current_health_status" class="form-control" value="<?= htmlspecialchars($record->current_health_status) ?>" required>
        </div>
        <div class="mb-3">
            <label>Reactions to Vaccines Before</label>
            <input type="text" name="reactions_to_vaccines_before" class="form-control" value="<?= htmlspecialchars($record->reactions_to_vaccines_before) ?>">
        </div>
        <div class="mb-3">
            <label>Allergies</label>
            <input type="text" name="Allergies" class="form-control" value="<?= htmlspecialchars($record->Allergies) ?>">
        </div>
        <div class="mb-3">
            <label>Health Check Date</label>
            <input type="date" name="Health_check_date" class="form-control" value="<?= htmlspecialchars($record->Health_check_date) ?>" required>
        </div>
        <div class="mb-3">
            <label>Note</label>
            <textarea name="Note" class="form-control"><?= htmlspecialchars($record->Note) ?></textarea>
        </div>
        <div class="mb-3">
            <label>Previous Illness</label>
            <input type="text" name="Previous_illness" class="form-control" value="<?= htmlspecialchars($record->Previous_illness) ?>">
        </div>
        <div class="mb-3">
            <label>Vaccination ID (optional)</label>
            <input type="text" name="vaccination_ID" class="form-control" value="<?= htmlspecialchars($record->vaccination_ID ?? '') ?>">
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="/PetSpot_clinic/public/healthrecord/staff_records" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>