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
    <title>Edit Pet Profile (Manager)</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Edit Pet Profile</h2>
    
    <a href="/PetSpot_clinic/public/manager/pet-profiles" class="btn btn-secondary mb-3">Back to Pet Profiles</a>
    
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Pet Information</h4>
                    <small class="text-muted">Update pet profile details</small>
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        <input type="hidden" name="pet_ID" value="<?= htmlspecialchars($pet->pet_ID) ?>">
                        
                        <!-- Current Image Display -->
                        <?php if (!empty($pet->image_url)): ?>
                            <div class="mb-3">
                                <label class="form-label">Current Image</label>
                                <div>
                                    <img src="<?= htmlspecialchars($pet->image_url) ?>" alt="Current Pet Image" class="rounded" style="height: 100px; width: 100px; object-fit: cover;">
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Basic Information -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Pet Name *</label>
                                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($pet->name ?? '') ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Type *</label>
                                <input type="text" name="type" class="form-control" value="<?= htmlspecialchars($pet->type ?? '') ?>" placeholder="e.g., Dog, Cat" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Breed</label>
                                <input type="text" name="breed" class="form-control" value="<?= htmlspecialchars($pet->breed ?? '') ?>" placeholder="e.g., Golden Retriever">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Color</label>
                                <input type="text" name="color" class="form-control" value="<?= htmlspecialchars($pet->color ?? '') ?>" placeholder="e.g., Brown, Black">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-control">
                                    <option value="">Select Gender</option>
                                    <option value="Male" <?= ($pet->gender ?? '') === 'Male' ? 'selected' : '' ?>>Male</option>
                                    <option value="Female" <?= ($pet->gender ?? '') === 'Female' ? 'selected' : '' ?>>Female</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-control">
                                    <option value="available" <?= ($pet->status ?? '') === 'available' ? 'selected' : '' ?>>Available</option>
                                    <option value="adopted" <?= ($pet->status ?? '') === 'adopted' ? 'selected' : '' ?>>Adopted</option>
                                    <option value="lost" <?= ($pet->status ?? '') === 'lost' ? 'selected' : '' ?>>Lost</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Special Markings</label>
                            <textarea name="special_markings" class="form-control" rows="3" placeholder="Describe any special markings or features"><?= htmlspecialchars($pet->special_markings ?? '') ?></textarea>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Update Image (optional)</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                            <small class="form-text text-muted">Leave empty to keep current image</small>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Update Pet Profile</button>
                            <a href="/PetSpot_clinic/public/manager/pet-profiles" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
