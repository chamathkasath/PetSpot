<?php include __DIR__ . '/partials/header.php'; ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/PetSpot_clinic/public/assets/css/header.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">My Profile</h2>
        </div>
    </div>
    
    <!-- Success/Error Messages -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i><?= htmlspecialchars($_SESSION['success']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i><?= htmlspecialchars($_SESSION['error']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-8">
            <!-- Profile Information -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Profile Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <!-- Profile Picture -->
                            <?php if (!empty($user->profile_pic)): ?>
                                <img src="/PetSpot_clinic/public/uploads/<?= htmlspecialchars($user->profile_pic) ?>" class="rounded-circle mb-3" width="100" height="100" alt="Profile Picture">
                            <?php else: ?>
                                <img src="https://ui-avatars.com/api/?name=<?= urlencode($user->fullname ?? 'User') ?>&background=007bff&color=fff&size=100" class="rounded-circle mb-3" width="100" height="100" alt="Profile Picture">
                            <?php endif; ?>
                        </div>
                        <div class="col-md-9">
                            <div class="row mb-3">
                                <div class="col-sm-4"><strong>Name:</strong></div>
                                <div class="col-sm-8"><?= htmlspecialchars($user->fullname ?? '') ?></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4"><strong>Email:</strong></div>
                                <div class="col-sm-8"><?= htmlspecialchars($user->email ?? '') ?></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4"><strong>Username:</strong></div>
                                <div class="col-sm-8"><?= htmlspecialchars($user->username ?? '') ?></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4"><strong>Contact:</strong></div>
                                <div class="col-sm-8"><?= htmlspecialchars($user->contact ?? 'Not provided') ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <!-- Action Buttons -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Account Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                            <i class="fas fa-edit me-2"></i>Edit Profile
                        </button>
                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                            <i class="fas fa-key me-2"></i>Change Password
                        </button>
                        <hr>
                        <form method="post" action="/PetSpot_clinic/public/profile/delete_account" style="display: inline;">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to deactivate your account? This action cannot be undone.')">
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
            <form class="modal-content" method="post" action="/PetSpot_clinic/public/profile/edit" id="editProfileForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="fullname" class="form-control" value="<?= htmlspecialchars($user->fullname ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user->email ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contact Number</label>
                        <input type="text" name="contact" class="form-control" value="<?= htmlspecialchars($user->contact ?? '') ?>">
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
            <form class="modal-content" method="post" action="/PetSpot_clinic/public/profile/change_password" id="changePasswordForm">
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
                    <button type="submit" class="btn btn-warning">Change Password</button>
                </div>
            </form>
        </div>
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