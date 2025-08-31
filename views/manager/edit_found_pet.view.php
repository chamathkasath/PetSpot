
<?php if (empty($_SESSION['staff_role']) || $_SESSION['staff_role'] !== 'Manager') {
    header("Location: /PetSpot_clinic/public/login");
    exit;
} ?>
<?php include __DIR__ . '/../partials/manager_header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Found Pet</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Found Pet</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="found_ID" value="<?= htmlspecialchars($pet->found_ID) ?>">
        <div class="mb-3">
            <label class="form-label">Color</label>
            <input type="text" name="color" class="form-control" value="<?= htmlspecialchars($pet->color) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Special Markings</label>
            <input type="text" name="special_markings" class="form-control" value="<?= htmlspecialchars($pet->special_markings) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Found Date</label>
            <input type="date" name="found_date" class="form-control" value="<?= htmlspecialchars($pet->found_date) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Found Location</label>
            <input type="text" name="found_location" class="form-control" value="<?= htmlspecialchars($pet->found_location) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Reporter Email</label>
            <input type="email" name="reporter_email" class="form-control" value="<?= htmlspecialchars($pet->reporter_email) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Type</label>
            <input type="text" name="type" class="form-control" value="<?= htmlspecialchars($pet->type) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Breed</label>
            <input type="text" name="breed" class="form-control" value="<?= htmlspecialchars($pet->breed) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Gender</label>
            <input type="text" name="gender" class="form-control" value="<?= htmlspecialchars($pet->gender) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <input type="text" name="status" class="form-control" value="<?= htmlspecialchars($pet->status) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Image</label>
            <?php if (!empty($pet->image_url)): ?>
                <img src="<?= htmlspecialchars($pet->image_url) ?>" alt="Pet Image" style="height:60px;"><br>
            <?php endif; ?>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="/PetSpot_clinic/public/manager/manager-found" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>