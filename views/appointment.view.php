<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Appointment | PetSpot Clinic</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/PetSpot_clinic/public/assets/css/bookings.css">
    <link rel="stylesheet" href="/PetSpot_clinic/public/assets/css/header.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
</head>
<body style="background:rgb(213, 232, 247);">
<?php $appointmentBills = $appointmentBills ?? []; ?>
<?php include __DIR__ . '/partials/header.php'; ?>

<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card card-appointment shadow-sm mb-5">
                <div class="card-body">
                    <!-- Pet Image -->
                    <div class="text-center mb-4">
                        <img src="/PetSpot_clinic/public/assets/images/pet10.avif" alt="Pet" class="rounded-circle shadow" style="width:120px;height:120px;object-fit:cover;border:4px solid #f8f9fa;">
                    </div>
                    <h2 class="mb-4 text-center text-primary"><i class="bi bi-calendar-plus"></i> Book an Appointment</h2>
                    
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>

                    <form class="row g-3" method="POST" action="">
                        <div class="col-md-6">
                            <label for="pet" class="form-label">Select Pet</label>
                            <select class="form-select" id="pet" name="pet_ID" required>
                                <option value="">Choose...</option>
                                <?php foreach ($pets as $pet): ?>
                                    <option value="<?= $pet->pet_ID ?>"><?= htmlspecialchars($pet->name) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="date" name="date" value="<?= htmlspecialchars($selected_date) ?>" required min="<?= date('Y-m-d') ?>" onchange="this.form.submit()">
                        </div>
                        <div class="col-md-6">
                            <label for="interval" class="form-label">Select Time Slot</label>
                            <select class="form-select" id="interval" name="interval" required>
                                <option value="">Select a slot</option>
                                <?php foreach ($filtered_intervals as $interval): ?>
                                    <option value="<?= $interval['slot_id'] ?>|<?= $interval['interval_start'] ?>">
                                        <?= htmlspecialchars($interval['interval_start'] . ' - ' . $interval['interval_end']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="type" class="form-label">Appointment Type</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="physical">Physical</option>
                                <option value="online">Online</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="reason" class="form-label">Reason</label>
                            <textarea class="form-control" id="reason" name="reason" rows="2" placeholder="Optional"></textarea>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary btn-animated px-5">
                                <i class="bi bi-check-circle"></i> Book Appointment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($appointments)): ?>
        <div class="row">
            <div class="col-12">
                <div class="card shadow rounded-4">
                    <div class="card-body p-5">
                        <h2 class="mb-5 text-center text-primary"><i class="bi bi-calendar3"></i> Your Appointments</h2>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped align-middle text-center mb-0" style="width: 100%; min-width: 1400px; font-size: 14px;">
                                <thead class="table-light">
                                    <tr>
                                        <th style="min-width: 140px; padding: 15px;"><i class="bi bi-shield"></i> Pet</th>
                                        <th style="min-width: 140px; padding: 15px;"><i class="bi bi-calendar-event"></i> Date</th>
                                        <th style="min-width: 140px; padding: 15px;"><i class="bi bi-clock"></i> Time</th>
                                        <th style="min-width: 180px; padding: 15px;"><i class="bi bi-chat-left-text"></i> Reason</th>
                                        <th style="min-width: 120px; padding: 15px;"><i class="bi bi-geo-alt"></i> Type</th>
                                        <th style="min-width: 140px; padding: 15px;"><i class="bi bi-info-circle"></i> Status</th>
                                        <th style="min-width: 180px; padding: 15px;"><i class="bi bi-credit-card"></i> Payment</th>
                                        <th style="min-width: 140px; padding: 15px;"><i class="bi bi-receipt"></i> Bill</th>
                                        <th style="min-width: 180px; padding: 15px;"><i class="bi bi-x-circle"></i> Cancel Request</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($appointments as $appointment): ?>
                                        <tr style="height: 60px;">
                                            <td class="fw-semibold" style="padding: 15px;"><?= htmlspecialchars($appointment->pet_name ?? '') ?></td>
                                            <td style="padding: 15px;"><?= htmlspecialchars($appointment->date ?? '') ?></td>
                                            <td style="padding: 15px;"><?= htmlspecialchars($appointment->time ?? '') ?></td>
                                            <td style="padding: 15px;"><?= htmlspecialchars($appointment->reason ?? '') ?></td>
                                            <td style="padding: 15px;">
                                                <span class="badge <?= ($appointment->type === 'online') ? 'bg-info text-dark' : 'bg-secondary' ?>">
                                                    <i class="bi <?= ($appointment->type === 'online') ? 'bi-laptop' : 'bi-house' ?>"></i>
                                                    <?= htmlspecialchars(ucfirst($appointment->type)) ?>
                                                </span>
                                            </td>
                                            <td style="padding: 15px;">
                                                <?php
                                                    $status = strtolower(trim($appointment->status ?? 'pending'));
                                                    if ($status === 'accepted' || $status === 'confirmed') {
                                                        echo '<span class="badge bg-success"><i class="bi bi-check-circle"></i> Confirmed</span>';
                                                    } elseif ($status === 'rejected') {
                                                        echo '<span class="badge bg-danger"><i class="bi bi-x-circle"></i> Rejected</span>';
                                                    } else {
                                                        echo '<span class="badge bg-warning text-dark"><i class="bi bi-hourglass-split"></i> Pending</span>';
                                                    }
                                                ?>
                                            </td>
                                            <td style="padding: 15px;">
                                                <?php if ($appointment->type === 'online'): ?>
                                                    <?php if (!empty($appointment->meeting_link)): ?>
                                                        <div class="alert alert-info my-2 p-2">
                                                            <i class="bi bi-link-45deg"></i>
                                                            <a href="<?= htmlspecialchars($appointment->meeting_link) ?>" target="_blank">Join Online Meeting</a>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if ($appointment->payment_status != 'paid'): ?>
                                                        <form method="post" action="/PetSpot_clinic/public/payment/checkout" class="d-inline">
                                                            <input type="hidden" name="amount" value="<?= (int)($appointment->amount * 100) ?>">
                                                            <input type="hidden" name="appointment_id" value="<?= $appointment->appointment_ID ?>">
                                                            <input type="hidden" name="description" value="Prescription Payment">
                                                            <button type="submit" class="btn btn-success btn-sm btn-animated">
                                                                <i class="bi bi-cash-coin"></i> Pay
                                                            </button>
                                                        </form>
                                                    <?php else: ?>
                                                        <span class="badge bg-success"><i class="bi bi-currency-dollar"></i> Paid</span>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <!-- For physical appointments, show payment at clinic -->
                                                    <span class="badge bg-info"><i class="bi bi-shop"></i> Paid at Clinic</span>
                                                <?php endif; ?>
                                            </td>
                                            <td style="padding: 15px;">
                                                <?php if (!empty($appointmentBills[$appointment->appointment_ID])): ?>
                                                    <?php foreach ($appointmentBills[$appointment->appointment_ID] as $bill): ?>
                                                        <a href="/PetSpot_clinic/public/user/bill/<?= $bill->bill_ID ?>" class="btn btn-sm btn-info mb-1 btn-animated fw-semibold" target="_blank">
                                                            <i class="bi bi-receipt"></i> View Bill
                                                        </a><br>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <a href="#" class="btn btn-sm btn-secondary mb-1 disabled" tabindex="-1" aria-disabled="true">
                                                        <i class="bi bi-receipt"></i> View Bill
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                            <td style="padding: 15px;">
                                                <?php 
                                                $cancelRequest = $appointment->cancellation_request ?? 'none';
                                                $appointmentStatus = strtolower(trim($appointment->status ?? 'pending'));
                                                $paymentStatus = strtolower(trim($appointment->payment_status ?? 'unpaid'));
                                                $hasBill = !empty($appointmentBills[$appointment->appointment_ID]);
                                                
                                                if ($appointmentStatus === 'cancelled') {
                                                    echo '<span class="badge bg-dark"><i class="bi bi-x-circle"></i> Cancelled</span>';
                                                } elseif ($cancelRequest === 'requested') {
                                                    echo '<span class="badge bg-warning text-dark"><i class="bi bi-hourglass-split"></i> Requested</span>';
                                                } elseif ($cancelRequest === 'approved') {
                                                    echo '<span class="badge bg-success"><i class="bi bi-check-circle"></i> Approved</span>';
                                                } elseif ($cancelRequest === 'rejected') {
                                                    echo '<span class="badge bg-danger"><i class="bi bi-x-circle"></i> Rejected</span>';
                                                } elseif ($hasBill) {
                                                    echo '<span class="text-muted">Bill Generated</span>';
                                                } elseif ($paymentStatus === 'paid') {
                                                    echo '<span class="text-muted">Already Paid</span>';
                                                } elseif (($appointmentStatus === 'pending' || $appointmentStatus === 'confirmed' || $appointmentStatus === 'accepted') && !$hasBill && $paymentStatus !== 'paid') {
                                                    echo '<form method="post" action="/PetSpot_clinic/public/appointment/request-cancellation" class="d-inline">';
                                                    echo '<input type="hidden" name="appointment_id" value="' . $appointment->appointment_ID . '">';
                                                    echo '<button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm(\'Are you sure you want to request cancellation for this appointment?\')">';
                                                    echo '<i class="bi bi-x-circle"></i> Request Cancel';
                                                    echo '</button>';
                                                    echo '</form>';
                                                } else {
                                                    echo '<span class="text-muted">-</span>';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <?php if (empty($appointments)): ?>
                                        <tr><td colspan="8" class="text-center">No appointments found.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
</div>

    <script>
    document.getElementById('slot').addEventListener('change', function() {
        var selected = this.options[this.selectedIndex];
        var timeInput = document.getElementById('time');
        if (selected.value && selected.dataset.range) {
            var range = JSON.parse(selected.dataset.range);
            timeInput.min = range.start;
            timeInput.max = range.end;
            timeInput.disabled = false;
        } else {
            timeInput.value = '';
            timeInput.disabled = true;
        }
    });
    </script>
    
</body>

<footer class="text-center bg-primary text-white py-4" style="width: 100vw !important; margin-left: calc(-50vw + 50%); position: relative; left: 50%; transform: translateX(-50%); padding: 1.5rem 0;">
    <?php include __DIR__ . '/partials/footer.view.php'; ?>
</footer>

</html>