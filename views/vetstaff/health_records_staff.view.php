
<?php 
if (isset($_SESSION['staff_role']) && $_SESSION['staff_role'] === 'Veterinarian') {
    include __DIR__ . '/../partials/vet_header.php';
} else {
    include __DIR__ . '/../partials/vetstaff_header.php';
}
?>

<!-- filepath: c:\xampp\htdocs\PetSpot_clinic\app\views\vetstaff\health_records_staff.view.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Added Health Records</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Your Added Health Records</h2>
    <a href="/PetSpot_clinic/public/healthrecord/add" class="btn btn-success mb-3">Add New Health Record</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Pet ID</th>
                <th>Owner ID</th>
                <th>Weight</th>
                <th>Height</th>
                <th>Status</th>
                <th>Check Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($records as $rec): ?>
            <tr>
                <td><?= htmlspecialchars($rec->pet_ID) ?></td>
                <td><?= htmlspecialchars($rec->user_ID) ?></td>
                <td><?= htmlspecialchars($rec->weight) ?></td>
                <td><?= htmlspecialchars($rec->height) ?></td>
                <td><?= htmlspecialchars($rec->current_health_status) ?></td>
                <td><?= htmlspecialchars($rec->Health_check_date) ?></td>
                <td>
                    <a href="/PetSpot_clinic/public/healthrecord/edit?health_record_ID=<?= $rec->health_record_ID ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="/PetSpot_clinic/public/healthrecord/delete?health_record_ID=<?= $rec->health_record_ID ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>