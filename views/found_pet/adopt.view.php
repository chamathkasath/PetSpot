<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adopt Pet</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #f4f7fa;
            min-height: 100vh;
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
        .btn-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border: none;
            font-weight: 600;
        }
        .btn-success:hover {
            background: linear-gradient(135deg, #218838 0%, #17a2b8 100%);
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
        img.rounded.shadow {
            border: 2px solid #dee2e6;
            border-radius: 10px;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
    </style>
</head>
<body>
<div class="container py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Adopt <?= htmlspecialchars($pet->type ?? '') ?> (<?= htmlspecialchars($pet->breed ?? '') ?>)</h2>
        <a href="/PetSpot_clinic/public/found-pet" class="btn btn-secondary">
            Back to List
        </a>
    </div>

    <!-- Adoption Form -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="mb-0">Pet Information</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <?php if (!empty($pet->image_url)): ?>
                                <img src="<?= htmlspecialchars($pet->image_url) ?>" class="rounded shadow" alt="Pet Image" style="width: 100%; height: 200px; object-fit: cover;">
                            <?php endif; ?>
                        </div>
                        <div class="col-md-8">
                            <p><strong>Color:</strong> <?= htmlspecialchars($pet->color) ?></p>
                            <p><strong>Special Markings:</strong> <?= htmlspecialchars($pet->special_markings) ?></p>
                            <p><strong>Found Date:</strong> <?= htmlspecialchars($pet->found_date) ?></p>
                            <p><strong>Location Found:</strong> <?= htmlspecialchars($pet->found_location ?? 'N/A') ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Adoption Application</h4>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Your Name *</label>
                                <input type="text" class="form-control" name="adopter_name" value="<?= htmlspecialchars($_SESSION['fullname'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Your Email *</label>
                                <input type="email" class="form-control" name="adopter_email" value="<?= htmlspecialchars($_SESSION['email'] ?? '') ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Reason for Adopting *</label>
                            <textarea class="form-control" name="reason" rows="2" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Message to Staff (optional)</label>
                            <textarea class="form-control" name="message" rows="3"></textarea>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="agree" name="agree" required>
                            <label class="form-check-label" for="agree">
                                I agree to the <a href="#" target="_blank">terms and conditions</a> of adoption.
                            </label>
                        </div>

                        <div class="alert alert-info">
                            <strong>Important Note:</strong> Adoption requests are subject to review. Please ensure your contact details are correct. Our staff may contact you for further verification.
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">Submit Adoption Request</button>
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