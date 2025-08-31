<!-- filepath: app/views/forgotpassword_reset.view.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/PetSpot_clinic/public/assets/css/forgotpassword.css">
</head>
<body>
<div class="container">
    <h2>Reset Password</h2>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>
    <form action="/PetSpot_clinic/public/forgotpassword/processReset" method="POST">
        <input type="hidden" name="token" value="<?= htmlspecialchars($_GET['token']) ?>">
        <input type="hidden" name="role" value="<?= htmlspecialchars($_GET['role']) ?>">
        <div class="mb-3">
            <label class="form-label">New Password:</label>
            <input type="password" class="form-control" name="new_password" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Confirm Password:</label>
            <input type="password" class="form-control" name="confirm_password" required>
        </div>
        <button type="submit" class="btn btn-primary">Reset Password</button>
    </form>
</div>
</body>
</html>