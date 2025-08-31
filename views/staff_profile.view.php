<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Profile | PetSpot Clinic</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        .profile-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border: 1px solid #e9ecef;
        }
        .profile-header {
            background: #007bff;
            color: white;
            padding: 2rem;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .profile-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid white;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 2rem;
            color: #007bff;
        }
        .profile-body {
            padding: 2rem;
        }
        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #007bff;
        }
        .info-icon {
            color: #007bff;
            margin-right: 1rem;
            font-size: 1.1rem;
        }
        .btn-custom {
            border-radius: 6px;
            padding: 0.5rem 1.2rem;
            margin: 0.25rem;
        }
    </style>
</head>
<body>
    

<div class="container py-5">
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="profile-card">
                <div class="profile-header">
                    <div class="profile-avatar">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <h2><?= htmlspecialchars($staff->fullname ?? 'Staff Member') ?></h2>
                    <p class="mb-0"><?= htmlspecialchars($staff->role ?? 'Staff') ?></p>
                </div>
                
                <div class="profile-body">
                    <div class="info-item">
                        <i class="fas fa-envelope info-icon"></i>
                        <div>
                            <strong>Email:</strong><br>
                            <?= htmlspecialchars($staff->email ?? 'Not provided') ?>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <i class="fas fa-phone info-icon"></i>
                        <div>
                            <strong>Contact:</strong><br>
                            <?= htmlspecialchars($staff->contact ?? 'Not provided') ?>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <i class="fas fa-user-tag info-icon"></i>
                        <div>
                            <strong>Role:</strong><br>
                            <?= htmlspecialchars($staff->role ?? 'Staff') ?>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <button class="btn btn-primary btn-custom" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                            <i class="fas fa-edit me-2"></i>Edit Profile
                        </button>
                        <button class="btn btn-outline-primary btn-custom" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                            <i class="fas fa-key me-2"></i>Change Password
                        </button>
                        <hr class="my-3">
                        <form method="post" action="/PetSpot_clinic/public/staff/profile/delete_account" style="display: inline;">
                            <button type="submit" class="btn btn-outline-danger btn-custom" onclick="return confirm('Are you sure you want to deactivate your account?')">
                                <i class="fas fa-user-times me-2"></i>Deactivate Account
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="post" action="/PetSpot_clinic/public/staff/profile/edit" id="editProfileForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="fullname" class="form-control" value="<?= htmlspecialchars($staff->fullname ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($staff->email ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contact Number</label>
                        <input type="text" name="contact" class="form-control" value="<?= htmlspecialchars($staff->contact ?? '') ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="post" action="/PetSpot_clinic/public/staff/profile/change_password" id="changePasswordForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Current Password</label>
                        <input type="password" name="current_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" name="new_password" class="form-control" minlength="6" required>
                        <small class="text-muted">Password must be at least 6 characters long.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" name="confirm_password" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Add debugging for form submissions
document.getElementById('editProfileForm').addEventListener('submit', function(e) {
    console.log('Edit profile form submitted');
    console.log('Form data:', new FormData(this));
});

document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
    console.log('Change password form submitted');
    console.log('Form data:', new FormData(this));
});

// Password confirmation validation
document.querySelector('input[name="confirm_password"]').addEventListener('input', function() {
    const newPassword = document.querySelector('input[name="new_password"]').value;
    if (this.value !== newPassword) {
        this.setCustomValidity('Passwords do not match');
    } else {
        this.setCustomValidity('');
    }
});
</script>

<footer class="text-center mt-5">
    <?php include __DIR__ . '/partials/footer.view.php'; ?>
</footer>
</body>
</html>
