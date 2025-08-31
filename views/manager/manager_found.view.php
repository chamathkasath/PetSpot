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
    <title>Found Pets (Manager)</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">All Found Pets</h2>
    
    <a href="/PetSpot_clinic/public/found-pet/add" class="btn btn-success mb-3">Add Found Pet</a>
    
    <?php if (empty($foundPets)): ?>
        <div class="alert alert-info">No found pets found.</div>
    <?php else: ?>
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>Image</th>
                <th>Type</th>
                <th>Breed</th>
                <th>Color</th>
                <th>Special Markings</th>
                <th>Found Date</th>
                <th>Status</th>
                <th>Reporter Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($foundPets as $pet): ?>
                <tr>
                    <td>
                        <?php if (!empty($pet->image_url)): ?>
                            <img src="<?= htmlspecialchars($pet->image_url) ?>" alt="Found Pet Image" class="rounded" style="height: 60px; width: 60px; object-fit: cover;">
                        <?php else: ?>
                            <span class="text-muted">No Image</span>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($pet->type ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($pet->breed ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($pet->color ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($pet->special_markings ?? 'None') ?></td>
                    <td><?= date('d M Y', strtotime($pet->found_date)) ?></td>
                    <td>
                        <?php if ($pet->status === 'Adopted'): ?>
                            <span class="badge bg-success">Adopted</span>
                        <?php elseif ($pet->status === 'Unclaimed'): ?>
                            <span class="badge bg-warning text-dark">Unclaimed</span>
                        <?php else: ?>
                            <span class="badge bg-info"><?= htmlspecialchars($pet->status ?? 'Unknown') ?></span>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($pet->reporter_email ?? 'N/A') ?></td>
                    <td>
                        <a href="/PetSpot_clinic/public/manager/found-pet/edit?id=<?= $pet->found_ID ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form method="post" action="/PetSpot_clinic/public/manager/found-pet/delete" class="d-inline ms-1" onsubmit="return confirm('Are you sure you want to delete this pet?');">
                            <input type="hidden" name="found_ID" value="<?= $pet->found_ID ?>">
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
<