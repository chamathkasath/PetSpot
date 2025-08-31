<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Prescription Management | PetSpot Clinic Pharmacist</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background: #f4f7fa;
            min-height: 100vh;
        }
        .table th {
            background: #343a40 !important;
            color: white !important;
            font-weight: 600;
            border: none !important;
            padding: 1rem 0.75rem;
        }
        .table td {
            vertical-align: middle;
            padding: 1rem 0.75rem;
            border-color: #e9ecef;
        }
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        .btn-primary {
            background: #007bff;
            border: none;
            color: white;
            font-size: 0.8rem;
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            font-weight: 500;
        }
        .btn-primary:hover {
            background: #0056b3;
            color: white;
        }
        .btn-success {
            background: #28a745;
            border: none;
            color: white;
            font-size: 0.8rem;
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            font-weight: 500;
        }
        .btn-success:hover {
            background: #218838;
            color: white;
        }
        .btn-info {
            background: #17a2b8;
            border: none;
            color: white;
            font-size: 0.8rem;
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            font-weight: 500;
        }
        .btn-info:hover {
            background: #138496;
            color: white;
        }
        .btn-warning {
            background: #ffc107;
            border: none;
            color: #212529;
            font-size: 0.8rem;
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            font-weight: 500;
        }
        .btn-warning:hover {
            background: #e0a800;
            color: #212529;
        }
        .alert {
            border-radius: 8px;
            border: none;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/PetSpot_clinic/public/pharmacist/dashboard">Pharmacist Dashboard</a>
            <div class="collapse navbar-collapse" id="pharmacistNavbar">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/PetSpot_clinic/public/pharmacist/dashboard">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/PetSpot_clinic/public/pharmacist/prescriptions">Prescriptions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PetSpot_clinic/public/staff/profile">
                            <i class="fas fa-user-circle me-1"></i>Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PetSpot_clinic/public/logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <!-- Header -->
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">
                <i class="bi bi-file-medical me-2"></i>
                Prescription Management
            </h1>
        </div>

        <!-- Prescriptions Table -->
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">
                    <i class="bi bi-table me-2"></i>
                    Active Prescriptions
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Prescription ID</th>
                                <th>Pet Owner</th>
                                <th>Pet Name</th>
                                <th>Medicine Details</th>
                                <th>Notes</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($prescriptions as $prescription): ?>
                                            <tr>
                                                <td><strong>#<?= htmlspecialchars($prescription->prescription_ID) ?></strong></td>
                                                <td><?= htmlspecialchars($prescription->fullname) ?> <br><small class="text-muted"><?= htmlspecialchars($prescription->email) ?></small></td>
                                                <td><?= htmlspecialchars($prescription->pet_name) ?></td>
                                                <td>
                                                    <?php
                                                    $medicines = json_decode($prescription->medicines, true);
                                                    if (is_array($medicines)) {
                                                        foreach ($medicines as $med) {
                                                            echo '<div class="mb-1">';
                                                            echo '<strong>' . htmlspecialchars($med['medicine']) . '</strong><br>';
                                                            if (!empty($med['dosage'])) {
                                                                echo '<small class="text-muted">Dosage: ' . htmlspecialchars($med['dosage']) . '</small><br>';
                                                            }
                                                            echo '<small class="text-info">Time: ' . htmlspecialchars($med['drink_time']) . '</small>';
                                                            echo '</div>';
                                                        }
                                                    } else {
                                                        echo '<span class="text-muted">' . htmlspecialchars($prescription->medicines) . '</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php if (!empty($prescription->note)): ?>
                                                        <span class="text-dark"><?= htmlspecialchars($prescription->note) ?></span>
                                                    <?php else: ?>
                                                        <span class="text-muted">No notes</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <?php if (!empty($prescription->is_paid)): ?>
                                                            <?php if (!empty($prescription->payment_method) && $prescription->payment_method === 'Online'): ?>
                                                                <button class="btn btn-warning btn-sm" disabled>
                                                                    <i class="bi bi-clock me-1"></i>Pending
                                                                </button>
                                                            <?php else: ?>
                                                                <button class="btn btn-success btn-sm" disabled>
                                                                    <i class="bi bi-check-circle me-1"></i>Paid
                                                                </button>
                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#billModal<?= $prescription->prescription_ID ?>">
                                                                <i class="bi bi-receipt me-1"></i>Generate Bill
                                                            </button>
                                                        <?php endif; ?>
                                                        
                                                        <?php if (!empty($prescription->bill)): ?>
                                                            <a href="/PetSpot_clinic/public/pharmacist/view-bill/<?= $prescription->bill->bill_ID ?>" class="btn btn-info btn-sm" target="_blank">
                                                                <i class="bi bi-eye me-1"></i>View Bill
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Bill Modal for this prescription -->
                                            <div class="modal fade" id="billModal<?= $prescription->prescription_ID ?>" tabindex="-1" aria-labelledby="billModalLabel<?= $prescription->prescription_ID ?>" aria-hidden="true">
              <div class="modal-dialog">
                <form method="post" action="/PetSpot_clinic/public/pharmacist/add-bill">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="billModalLabel<?= $prescription->prescription_ID ?>">Generate Bill</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="prescription_ID" value="<?= $prescription->prescription_ID ?>">
                        <input type="hidden" name="user_ID" value="<?= $prescription->user_ID ?>">
                        <input type="hidden" name="appointment_ID" value="<?= $prescription->appointment_ID ?>">

                        <div class="mb-3">
                            <label class="form-label">Medicines & Prices</label>
                            <div id="medicines-list-<?= $prescription->prescription_ID ?>">
                                <?php
                                $medicines = json_decode($prescription->medicines, true);
                                if (is_array($medicines)) {
                                    foreach ($medicines as $idx => $med) {
                                        ?>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text">
                                                <?= htmlspecialchars($med['medicine']) ?>
                                                <?php if (!empty($med['dosage'])): ?>
                                                    <span class="ms-2 badge bg-info text-dark">Dosage: <?= htmlspecialchars($med['dosage']) ?></span>
                                                <?php endif; ?>
                                                (<?= htmlspecialchars($med['drink_time']) ?>)
                                            </span>
                                            <input type="number" step="0.01" min="0" name="medicine_prices[<?= $idx ?>]" class="form-control medicine-price" placeholder="Price" required>
                                            <input type="hidden" name="medicine_names[<?= $idx ?>]" value="<?= htmlspecialchars($med['medicine']) ?>">
                                        </div>
                                        <?php
                                    }
                                } else {
                                    echo '<div class="text-danger">Invalid medicine data</div>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Channeling Fee</label>
                            <input type="number" step="0.01" min="0" name="channeling_fee" class="form-control channeling-fee" placeholder="Channeling Fee" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Total Price</label>
                            <input type="number" step="0.01" name="total_price" class="form-control total-price" readonly required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Payment Method</label>
                            <select name="payment_method" class="form-control" required>
                                <option value="">Select Method</option>
                                <option value="Cash">Cash</option>
                                <option value="Card">Card</option>
                                <option value="Online">Online</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Note</label>
                            <textarea name="note" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-success">Save Bill</button>
                    </div>
                  </div>
                </form>
                
              </div>
            </div>

            <!-- Bill Details Modal -->
            <div class="modal fade" id="billDetailsModal<?= $prescription->prescription_ID ?>" tabindex="-1" aria-labelledby="billDetailsModalLabel<?= $prescription->prescription_ID ?>" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="billDetailsModalLabel<?= $prescription->prescription_ID ?>">Bill Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <!-- Bill details content here -->
                    <?php
                    // Fetch bill details from the database or use existing data
                    $billDetails = json_decode($prescription->bill_details, true);
                    if (is_array($billDetails)) {
                        foreach ($billDetails as $detail) {
                            ?>
                            <div class="mb-3">
                                <strong><?= htmlspecialchars($detail['item']) ?>:</strong>
                                <?= htmlspecialchars($detail['description']) ?> -
                                <span class="text-success"><?= htmlspecialchars($detail['price']) ?> LKR</span>
                            </div>
                            <?php
                        }
                    } else {
                        echo '<div class="text-danger">No bill details found</div>';
                    }
                    ?>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('[id^="billModal"]').forEach(function(modal) {
        modal.addEventListener('shown.bs.modal', function () {
            updateTotal(modal);
        });
        modal.querySelectorAll('.medicine-price, .channeling-fee').forEach(function(input) {
            input.addEventListener('input', function() {
                updateTotal(modal);
            });
        });
    });

    function updateTotal(modal) {
        let total = 0;
        modal.querySelectorAll('.medicine-price').forEach(function(input) {
            total += parseFloat(input.value) || 0;
        });
        let channeling = parseFloat(modal.querySelector('.channeling-fee').value) || 0;
        total += channeling;
        modal.querySelector('.total-price').value = total.toFixed(2);
    }
});
</script>
</body>
</html>