<?php 
if (isset($_SESSION['staff_role']) && $_SESSION['staff_role'] === 'Veterinarian') {
    include __DIR__ . '/../partials/vet_header.php';
} else {
    include __DIR__ . '/../partials/vetstaff_header.php';
}
?>
<!-- filepath: app/views/vetstaff/health_record_add.view.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Health Record</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/PetSpot_clinic/public/assets/css/healthrecord.css">
</head>
<body>
<div class="container d-flex justify-content-center">
    <div class="card-form w-100">
        <h2 class="mb-4 text-center"><i class="bi bi-clipboard-plus"></i> Add Health Record</h2>
        <!-- Step 1: Search Owner -->
        <form method="get" class="mb-3">
            <label for="owner_name" class="form-label"><i class="bi bi-search"></i>Pet Owner Name:</label>
            <div class="input-group mb-2">
                <input type="text" name="owner_name" id="owner_name" class="form-control" value="<?= htmlspecialchars($_GET['owner_name'] ?? '') ?>">
                <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Search</button>
            </div>
            <label for="owner_dropdown" class="form-label mt-2"><i class="bi bi-list"></i> Or select owner:</label>
            <select name="user_ID" id="owner_dropdown" class="form-select" onchange="if(this.value) window.location='?user_ID='+this.value;">
                <option value="">-- Select Owner --</option>
                <?php if (!empty($allUsers)): ?>
                    <?php foreach ($allUsers as $user): ?>
                        <option value="<?= $user->user_ID ?>" <?= (isset($_GET['user_ID']) && $_GET['user_ID'] == $user->user_ID) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($user->fullname) ?> (<?= htmlspecialchars($user->email) ?>)
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </form>

        <?php if (!empty($users) && !$selectedOwner): ?>
            <div class="alert alert-info"><i class="bi bi-info-circle"></i> Multiple owners found. Please refine your search.</div>
            <ul>
                <?php foreach ($users as $user): ?>
                    <li><?= htmlspecialchars($user->fullname) ?> (<?= htmlspecialchars($user->email) ?>)</li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <?php if ($selectedOwner): ?>
            <div class="owner-info mb-3">
                <i class="bi bi-person-circle"></i>
                <div>
                    <strong><?= htmlspecialchars($selectedOwner->fullname) ?></strong><br>
                    <span class="text-muted"><?= htmlspecialchars($selectedOwner->email) ?></span>
                </div>
            </div>
            <?php if (!empty($pets)): ?>
                <form method="post">
                    <input type="hidden" name="user_ID" value="<?= $selectedOwner->user_ID ?>">
                    <div class="form-section-title"><i class="bi bi-github"></i>Select Pet:</div>
                    <div class="mb-3 pet-radio">
                        <?php foreach ($pets as $pet): ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pet_ID" id="pet<?= $pet->pet_ID ?>" value="<?= $pet->pet_ID ?>" required>
                                <label class="form-check-label" for="pet<?= $pet->pet_ID ?>"><i class="bi bi-shield-plus"></i> <?= htmlspecialchars($pet->name) ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="form-section-title"><i class="bi bi-activity"></i>Health Record Details</div>
                    <div class="mb-3">
                        <label class="form-label"><i class="bi bi-bar-chart"></i>Weight</label>
                        <input type="text" name="weight" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="bi bi-arrows-expand"></i>Height</label>
                        <input type="text" name="height" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="bi bi-heart-pulse"></i>Current Health Status</label>
                        <input type="text" name="current_health_status" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="bi bi-emoji-frown"></i>Reactions to Vaccines Before</label>
                        <input type="text" name="reactions_to_vaccines_before" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="bi bi-exclamation-triangle"></i>Allergies</label>
                        <input type="text" name="Allergies" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="bi bi-calendar-check"></i>Health Check Date</label>
                        <input type="date" name="Health_check_date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="bi bi-journal-text"></i>Note</label>
                        <textarea name="Note" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="bi bi-clipboard-data"></i>Previous Illness</label>
                        <input type="text" name="Previous_illness" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="bi bi-capsule"></i>Vaccination ID (optional)</label>
                        <input type="text" name="vaccination_ID" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success w-100"><i class="bi bi-plus-circle"></i> Add Health Record</button>
                </form>
            <?php else: ?>
                <div class="alert alert-warning"><i class="bi bi-exclamation-circle"></i> This owner has no pets registered.</div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="alert alert-success mt-3"><i class="bi bi-check-circle"></i> Health record added successfully!</div>
        <?php endif; ?>
    </div>
</div>

<div class="container mt-5">
    <a href="/PetSpot_clinic/public/healthrecord/staff_records" class="btn btn-primary mb-3">View Your Health Records</a>
    <form method="post">
        <!-- ...your form fields... -->
    </form>
</div>
</body>
</html>