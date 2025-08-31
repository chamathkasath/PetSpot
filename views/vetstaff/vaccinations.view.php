<?php 
if (isset($_SESSION['staff_role']) && $_SESSION['staff_role'] === 'Veterinarian') {
    include __DIR__ . '/../partials/vet_header.php';
} else {
    include __DIR__ . '/../partials/vetstaff_header.php';
}
?>
<!-- filepath: c:\xampp\htdocs\PetSpot_clinic\app\views\vetstaff\vaccinations.view.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Vaccinations List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/PetSpot_clinic/public/assets/css/vetstaff.css">
</head>
<body>
    <div class="container-vetstaff">
        <h2 class="main-title text-center mb-4">Vaccinations</h2>
        <div class="table-responsive-vet">
            <table class="table vet-table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Pet ID</th>
                        <?php if (!empty($_SESSION['staff_id'])): ?>
                            <th>User ID</th>
                        <?php endif; ?>
                        <th>Vaccination Name</th>
                        <th>Type</th>
                        <th>Date of Last Vaccine</th>
                        <th>Next Due Date</th>
                        <?php if (!empty($_SESSION['staff_id'])): ?>
                            <th>Actions</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vaccinations as $v): ?>
                    <tr>
                        <td><?= htmlspecialchars($v->pet_ID) ?></td>
                        <?php if (!empty($_SESSION['staff_id'])): ?>
                            <td><?= htmlspecialchars($v->user_ID) ?></td>
                        <?php endif; ?>
                        <td><?= htmlspecialchars($v->vaccination_name) ?></td>
                        <td><?= htmlspecialchars($v->vaccination_type) ?></td>
                        <td><?= htmlspecialchars($v->date_of_last_vaccine) ?></td>
                        <td><?= htmlspecialchars($v->next_due_date) ?></td>
                        <?php if (!empty($_SESSION['staff_id'])): ?>
                            <td>
                                <a href="/PetSpot_clinic/public/vet_vaccinations/edit?vaccination_ID=<?= $v->vaccination_ID ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="/PetSpot_clinic/public/vet_vaccinations/delete?vaccination_ID=<?= $v->vaccination_ID ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this vaccination record?');">Delete</a>
                            </td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php if (!empty($_SESSION['staff_id'])): ?>
            <div class="text-end mt-3">
                <a href="/PetSpot_clinic/public/vet_vaccinations/add" class="btn btn-vet btn-lg">
                    <i class="bi bi-plus-circle me-2"></i> Add Vaccination
                </a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>