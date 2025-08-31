<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign Up | PetSpot Clinic</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="/PetSpot_clinic/public/assets/css/signup.css?v=2">
</head>

<body>
<div class="signup-container">
    <h2 class="form-title">Create Your Account</h2>
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form method="post" action="">
        <div class="mb-3">
            <label for="fullname" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="fullname" name="fullname" required>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="contact" class="form-label">Contact</label>
            <input type="text" class="form-control" id="contact" name="contact" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="confirmpassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" required>
        </div>
        <button type="submit" class="btn btn-primary w-100 py-2">SIGN UP</button>
    </form>
    <div class="mt-3 text-center">
        <small>Already have an account? <a href="/PetSpot_clinic/public/login">Login</a></small>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.querySelector('form').addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    const confirm = document.getElementById('confirmpassword').value;
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{6,}$/;
    let message = '';
    if (!regex.test(password)) {
        message += 'Password must be at least 6 characters and include uppercase, lowercase, number, and special character.\n';
    }
    if (password !== confirm) {
        message += 'Passwords do not match.';
    }
    if (message) {
        alert(message);
        e.preventDefault();
    }
});
</script>
</body>
</html>