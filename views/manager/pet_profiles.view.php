
<?php include __DIR__ . '/../partials/manager_header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Pet Profiles</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">All Pet Profiles</h2>
    
    <?php if (isset($_SESSION['flash_message'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($_SESSION['flash_message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['flash_message']); ?>
    <?php endif; ?>
    
    <?php if (empty($pets)): ?>
        <div class="alert alert-info">No pet profiles found.</div>
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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pets as $pet): ?>
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
                        <?php if ($pet->status === 'adopted'): ?>
                            <span class="badge bg-success">Adopted</span>
                        <?php elseif ($pet->status === 'lost'): ?>
                            <span class="badge bg-danger">Lost</span>
                        <?php elseif ($pet->status === 'available'): ?>
                            <span class="badge bg-info">Available</span>
                        <?php else: ?>
                            <span class="badge bg-secondary"><?= htmlspecialchars($pet->status ?? 'Unknown') ?></span>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($pet->owner_email ?? 'N/A') ?></td>
                    <td>
                        <a href="/PetSpot_clinic/public/manager/edit-pet?id=<?= $pet->pet_ID ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form method="post" action="/PetSpot_clinic/public/manager/delete-pet" class="d-inline ms-1" onsubmit="return confirm('Are you sure you want to delete this pet profile?');">
                            <input type="hidden" name="pet_ID" value="<?= $pet->pet_ID ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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