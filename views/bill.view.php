
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Bill</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background: #f4f7fa;
        }
        .bill-header {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
            border-radius: 10px 10px 0 0;
        }
        .bill-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .bill-item {
            border-left: 4px solid #007bff;
            background: #f8f9fa;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card bill-card">
                <div class="card-header bill-header text-center py-4">
                    <h2 class="mb-0">
                        <i class="bi bi-receipt me-2"></i>
                        Bill Invoice #<?= htmlspecialchars($bill->bill_ID) ?>
                    </h2>
                    <p class="mb-0 mt-2 opacity-75">PetSpot Clinic - Pharmacy Department</p>
                </div>
                <div class="card-body p-4">
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="text-muted mb-3">
                                <i class="bi bi-file-earmark-text me-2"></i>
                                Bill Details
                            </h5>
                        </div>
                    </div>

                    <?php if (!empty($prescription)): ?>
                    <!-- Prescription/Medicine Details -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h6 class="text-primary mb-3">
                                <i class="bi bi-capsule me-2"></i>
                                Prescribed Medicines
                            </h6>
                            <div class="card bill-item">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="mb-1"><strong>Medicine Names:</strong> <?= htmlspecialchars($prescription->medicines ?? 'N/A') ?></p>
                                        </div>
                                        
                                    </div>
                                    <?php if (!empty($prescription->note)): ?>
                                    <div class="mt-2">
                                        <p class="mb-0"><strong>Additional Notes:</strong> <?= htmlspecialchars($prescription->note) ?></p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="card bill-item">
                                <div class="card-body text-center">
                                    <h6 class="text-primary mb-2">
                                        <i class="bi bi-currency-dollar me-1"></i>
                                        Total Amount
                                    </h6>
                                    <h4 class="text-success mb-0">LKR <?= htmlspecialchars($bill->total_price) ?></h4>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="card bill-item">
                                <div class="card-body">
                                    <h6 class="text-primary mb-2">
                                        <i class="bi bi-sticky me-1"></i>
                                        Additional Notes
                                    </h6>
                                    <p class="mb-0"><?= !empty($bill->note) ? htmlspecialchars($bill->note) : 'No additional notes provided.' ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <div class="text-center">
                        <a href="/PetSpot_clinic/public/appointments" class="btn btn-primary btn-lg">
                            <i class="bi bi-arrow-left me-2"></i>
                            Back to Appointments
                        </a>
                        <button onclick="window.print()" class="btn btn-outline-secondary btn-lg ms-2">
                            <i class="bi bi-printer me-2"></i>
                            Print Bill
                        </button>
                    </div>
                </div>
                <div class="card-footer text-center text-muted py-3">
                    <small>
                        <i class="bi bi-shield-check me-1"></i>
                        Thank you for choosing PetSpot Clinic
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>