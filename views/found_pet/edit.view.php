<?php include __DIR__ . '/../partials/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Found Pet</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        
    body {
        background: #f4f7fa;
        min-height: 100vh;
    }

    .sidebar {
        background: linear-gradient(135deg, #3a7bd5 0%, #00d2ff 100%);
        min-height: 100vh;
        color: #fff;
        padding: 2rem 1rem;
    }

    .sidebar .nav-link {
        color: #fff;
        font-weight: 500;
        margin-bottom: 1rem;
        border-radius: 8px;
        transition: background 0.2s;
    }

    .sidebar .nav-link.active,
    .sidebar .nav-link:hover {
        background: rgba(255, 255, 255, 0.15);
    }

    .sidebar .brand {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-primary {
        background: linear-gradient(135deg, #3a7bd5 0%, #00d2ff 100%);
        border: none;
        font-weight: 600;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #2a5bc5 0%, #00a2cf 100%);
    }

    .btn-secondary {
        background-color: #6c757d;
        color: #fff;
        border: none;
        font-weight: 500;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .form-label {
        font-weight: 600;
        color: #495057;
    }

    .form-control {
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 1rem;
    }

    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #e3e6f0;
        border-radius: 12px 12px 0 0;
    }

    img.rounded.shadow {
        border: 2px solid #dee2e6;
        border-radius: 10px;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }


    </style>
</head>
<body>
<div class="container">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Edit Found Pet</h2>
        <a href="/PetSpot_clinic/public/found-pet" class="btn btn-secondary">
            Back to List
        </a>
    </div>

    <!-- Edit Found Pet Form -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Edit Found Pet Information</h4>
                    <small class="text-muted">Update details about the found pet</small>
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Pet Type *</label>
                                <input type="text" name="type" class="form-control" value="<?= htmlspecialchars($pet->type) ?>" placeholder="e.g., Dog, Cat, Bird" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Breed</label>
                                <input type="text" name="breed" class="form-control" value="<?= htmlspecialchars($pet->breed) ?>" placeholder="e.g., Golden Retriever">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Gender</label>
                                <input type="text" name="gender" class="form-control" value="<?= htmlspecialchars($pet->gender) ?>" placeholder="Male, Female, or Unknown">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Color *</label>
                                <input type="text" name="color" class="form-control" value="<?= htmlspecialchars($pet->color) ?>" placeholder="e.g., Brown, White, Mixed" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Special Markings</label>
                            <textarea name="special_markings" class="form-control" rows="3" placeholder="Describe any distinctive features, markings, or characteristics"><?= htmlspecialchars($pet->special_markings) ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Found Date *</label>
                                <input type="date" name="found_date" class="form-control" value="<?= htmlspecialchars($pet->found_date) ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Found Location *</label>
                                <input type="text" name="found_location" class="form-control" value="<?= htmlspecialchars($pet->found_location) ?>" placeholder="Where was the pet found?" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Current Image</label><br>
                            <?php if (!empty($pet->image_url)): ?>
                                <img src="<?= htmlspecialchars($pet->image_url) ?>" alt="Found Pet Image" style="max-width:150px;max-height:150px;" class="mb-2 rounded shadow">
                            <?php else: ?>
                                <span class="text-muted">No image uploaded.</span>
                            <?php endif; ?>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Change Image</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                            <small class="form-text text-muted">Leave blank to keep the current image.</small>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Update Found Pet</button>
                            <a href="/PetSpot_clinic/public/found-pet" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<footer class="text-center">
  <?php include __DIR__ . '/../partials/footer.view.php'; ?>
</footer>