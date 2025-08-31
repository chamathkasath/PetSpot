<?php
if (empty($_SESSION['staff_role']) || $_SESSION['staff_role'] !== 'Manager') {
    header("Location: /PetSpot_clinic/public/login");
    exit;
}
?>
<?php include __DIR__ . '/../partials/manager_header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lost Pets (Manager)</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">All Lost Pets</h2>
    <?php if (empty($lostPets)): ?>
        <div class="alert alert-info">No lost pets found.</div>
    <?php else: ?>
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Type</th>
                <th>Breed</th>
                <th>Color</th>
                <th>Gender</th>
                <th>Special Markings</th>
                <th>Status</th>
                <th>Owner Email</th>
                <th>Lost Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lostPets as $pet): ?>
                <tr>
                    <td>
                        <?php if (!empty($pet->image_url)): ?>
                            <img src="<?= htmlspecialchars($pet->image_url) ?>" alt="Pet Image" class="rounded" style="height: 60px; width: 60px; object-fit: cover;">
                        <?php else: ?>
                            <span class="text-muted">No Image</span>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($pet->name ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($pet->type ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($pet->breed ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($pet->color ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($pet->gender ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($pet->special_markings ?? 'None') ?></td>
                    <td>
                        <span class="badge bg-danger">Lost</span>
                    </td>
                    <td><?= htmlspecialchars($pet->owner_email ?? 'N/A') ?></td>
                    <td><?= isset($pet->lost_date) ? date('d M Y', strtotime($pet->lost_date)) : 'N/A' ?></td>
                    <td>
                        <form method="POST" action="/PetSpot_clinic/public/manager/mark-as-found" style="display: inline;">
                            <input type="hidden" name="pet_id" value="<?= $pet->pet_ID ?>">
                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to mark this pet as found?');">
                                <i class="bi bi-check-circle"></i> Mark as Found
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>
</body>
</html>