<!-- filepath: app/views/forgotpassword.view.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/PetSpot_clinic/public/assets/css/forgotpassword.css">
</head>
<body>
<div class="forgot-container">
    <h2>Forgot Password</h2>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>
    <form action="/PetSpot_clinic/public/forgotpassword/processRequest" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Account Type:</label>
            <select class="form-select" id="role" name="role" required>
                <option value="user">User</option>
                <option value="staff">Staff</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Send Reset Link</button>
    </form>
</div>
</body>
</html>