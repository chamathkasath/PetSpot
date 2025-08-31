<!-- filepath: c:\xampp\htdocs\PetSpot_clinic\app\views\admin\update_vaccination.view.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Vaccination | Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Update Vaccination</h1>
    
    <form method="post" action="/PetSpot_clinic/public/admin/vaccinations/update">
        <input type="hidden" name="vaccination_ID" value="<?= htmlspecialchars($vaccination->vaccination_ID) ?>">
        <div class="mb-3">
            <label for="vaccination_name" class="form-label">Vaccination Name</label>
            <input type="text" name="vaccination_name" id="vaccination_name" class="form-control" value="<?= htmlspecialchars($vaccination->vaccination_name) ?>" required>
        </div>
        <div class="mb-3">
            <label for="vaccination_type" class="form-label">Type</label>
            <input type="text" name="vaccination_type" id="vaccination_type" class="form-control" value="<?= htmlspecialchars($vaccination->vaccination_type) ?>" required>
        </div>
        <div class="mb-3">
            <label for="date_of_last_vaccine" class="form-label">Date of Last Vaccine</label>
            <input type="date" name="date_of_last_vaccine" id="date_of_last_vaccine" class="form-control" value="<?= htmlspecialchars($vaccination->date_of_last_vaccine) ?>" required>
        </div>
        <div class="mb-3">
            <label for="next_due_date" class="form-label">Next Due Date</label>
            <input type="date" name="next_due_date" id="next_due_date" class="form-control" value="<?= htmlspecialchars($vaccination->next_due_date) ?>" required>
        </div>
        <div class="mb-3">
            <label for="pet_ID" class="form-label">Pet ID</label>
            <input type="number" name="pet_ID" id="pet_ID" class="form-control" value="<?= htmlspecialchars($vaccination->pet_ID) ?>" required>
        </div>
        <div class="mb-3">
            <label for="user_ID" class="form-label">User ID</label>
            <input type="number" name="user_ID" id="user_ID" class="form-control" value="<?= htmlspecialchars($vaccination->user_ID) ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="/PetSpot_clinic/public/admin/vaccinations" class="btn btn-secondary">Cancel</a>
    </form>
    
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>