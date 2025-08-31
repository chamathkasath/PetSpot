
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Staff | Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Staff Member</h2>
    <form method="post">
        <input type="hidden" name="staff_id" value="<?= htmlspecialchars($staff->staff_id) ?>">
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($staff->username) ?>" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($staff->email) ?>" required>
        </div>
        <div class="mb-3">
            <label>Role</label>
            <input type="text" name="role" class="form-control" value="<?= htmlspecialchars($staff->role) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
        <a href="/PetSpot_clinic/public/admin/staff" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>