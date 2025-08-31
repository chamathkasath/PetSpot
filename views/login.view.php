<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | PetSpot Clinic</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/PetSpot_clinic/public/assets/css/signin.css">
</head>
<body>
    <!-- Beautiful Quote Overlay -->
    <div class="quote-overlay">
        <h2>WELCOME to PetSpot Clinic</h2>
        <p>Where every pet's health journey begins with care and compassion. At PetSpot Clinic, your furry family members are in loving hands.</p>
    </div>
    
    <!-- Transparent Login Container -->
    <div class="login-container">
        <div class="login-header">
            <h2>Login</h2>
        </div>
        
        <form method="post" action="/PetSpot_clinic/public/login">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="chamathkasathru.wani@gmail.com" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="......" required>
                <div class="forgot-password">
                    <a href="/PetSpot_clinic/public/forgotpassword">Request password</a>
                </div>
            </div>
            
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-login">LOGIN</button>
            </div>
            
            <div class="signup-link">
                <p>Don't have an account? <a href="/PetSpot_clinic/public/signup">Sign Up</a></p>
            </div>
            
            <?php if (!empty($data['errors'])): ?>
                <div class="alert alert-danger mt-3">
                    <ul>
                        <?php foreach ($data['errors'] as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>