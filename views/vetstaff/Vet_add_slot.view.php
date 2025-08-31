<?php 
if (isset($_SESSION['staff_role']) && $_SESSION['staff_role'] === 'Veterinarian') {
    include __DIR__ . '/../partials/vet_header.php';
} else {
    include __DIR__ . '/../partials/vetstaff_header.php';
}
?>
<!-- filepath: c:\xampp\htdocs\PetSpot_clinic\app\views\vetstaff\Vet_add_slot.view.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appointments & Slots</title>
    <link rel="stylesheet" href="/PetSpot_clinic/public/assets/css/vetstaff.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FullCalendar CSS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/themes/bootstrap5.min.css" rel="stylesheet">
<!-- FullCalendar JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
</head>
<body>
<div class="container-vetstaff">
    <h2 class="main-title"><i class="bi bi-calendar2-week"></i> Appointments & Slots</h2>

    <!-- Summary Cards -->
    <div class="summary-cards">
        <div class="summary-card primary">
            <div class="summary-label">Total</div>
            <div class="summary-value"><?= $total ?? 0 ?></div>
        </div>
        <div class="summary-card success">
            <div class="summary-label">Upcoming</div>
            <div class="summary-value"><?= $upcoming ?? 0 ?></div>
        </div>
        <div class="summary-card info">
            <div class="summary-label">Accepted</div>
            <div class="summary-value"><?= $accepted ?? 0 ?></div>
        </div>
        <div class="summary-card danger">
            <div class="summary-label">Rejected</div>
            <div class="summary-value"><?= $rejected ?? 0 ?></div>
        </div>
    </div>

    <!-- New Appointments Alert -->
    <?php if ($newAppointments > 0): ?>
        <div class="alert alert-info">
            You have <?= $newAppointments ?> new appointment(s)!
        </div>
    <?php endif; ?>

    <!-- Flash Message -->
    <?php if (!empty($_SESSION['flash_message'])): ?>
        <div class="alert alert-info">
            <?= $_SESSION['flash_message']; unset($_SESSION['flash_message']); ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <!-- Left: Appointments Table - Make it larger -->
        <div class="col-lg-9 mb-4">
            <div class="card-appointments">
                <div class="card-header-appointments">
                    <i class="bi bi-list-check"></i> All Appointments
                </div>
                <div class="card-body-appointments">
                    <?php if (!empty($appointments)): ?>
                    <div class="table-responsive-vet">
                        <table class="vet-table">
                            <thead>
                                <tr>
                                    <th>Pet Name</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Reason</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Cancel Request</th>
                                    <th class="text-center">Actions</th>
                                    <th class="text-center">Cancellation Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($appointments as $appointment): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($appointment->pet_name ?? '') ?></td>
                                        <td><?= htmlspecialchars($appointment->date ?? '') ?></td>
                                        <td><?= htmlspecialchars($appointment->time ?? '') ?></td>
                                        <td><?= htmlspecialchars($appointment->reason ?? '') ?></td>
                                        <td><?= htmlspecialchars(ucfirst($appointment->type ?? 'Physical')) ?></td> <!-- Add this line -->
                                        <td>
                                            <?php
                                                $status = strtolower(trim($appointment->status ?? 'pending'));
                                                if ($status === 'accepted') {
                                                    echo '<span class="badge-vet badge-success">Accepted</span>';
                                                } elseif ($status === 'rejected') {
                                                    echo '<span class="badge-vet badge-danger">Rejected</span>';
                                                } else {
                                                    echo '<span class="badge-vet badge-warning">Pending</span>';
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                $cancelRequest = $appointment->cancellation_request ?? 'none';
                                                if ($cancelRequest === 'requested') {
                                                    echo '<span class="badge-vet badge-warning">Cancel Requested</span>';
                                                } elseif ($cancelRequest === 'approved') {
                                                    echo '<span class="badge-vet badge-success">Cancel Approved</span>';
                                                } elseif ($cancelRequest === 'rejected') {
                                                    echo '<span class="badge-vet badge-danger">Cancel Rejected</span>';
                                                } else {
                                                    echo '<span class="badge-vet badge-secondary">No Request</span>';
                                                }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($status === 'pending'): ?>
                                                <form method="POST" action="/PetSpot_clinic/public/vet_slots/updateAppointmentStatus" class="inline-form" style="display:inline-block;">
                                                    <input type="hidden" name="appointment_ID" value="<?= htmlspecialchars($appointment->appointment_ID) ?>">
                                                    <?php if (($appointment->type ?? '') === 'online'): ?>
                                                        <input type="url" name="meeting_link" class="form-control mb-1" style="display:inline-block;width:auto;" placeholder="Meeting Link (required)" required>
                                                    <?php endif; ?>
                                                    <button type="submit" name="action" value="accept" class="btn-vet btn-success-vet" title="Confirm">
                                                        <i class="bi bi-check-circle"></i> Accept
                                                    </button>
                                                    <button type="submit" name="action" value="reject" class="btn-vet btn-danger-vet" title="Reject">
                                                        <i class="bi bi-x-circle"></i> Reject
                                                    </button>
                                                </form>
                                            <?php elseif ($status === 'accepted'): ?>
                                                <span class="status-text success" style="font-weight:600;">
                                                    <i class="bi bi-check-circle-fill"></i> Confirmed
                                                </span>
                                            <?php elseif ($status === 'rejected'): ?>
                                                <span class="status-text danger" style="font-weight:600;">
                                                    <i class="bi bi-x-circle-fill"></i> Rejected
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($cancelRequest === 'requested'): ?>
                                                <form method="POST" action="/PetSpot_clinic/public/appointment/process-cancellation" class="inline-form" style="display:inline-block;">
                                                    <input type="hidden" name="appointment_id" value="<?= htmlspecialchars($appointment->appointment_ID) ?>">
                                                    <button type="submit" name="action" value="approve" class="btn-vet btn-warning-vet btn-sm" title="Approve Cancellation" onclick="return confirm('Are you sure you want to approve this cancellation request?')">
                                                        <i class="bi bi-check-square"></i> Approve
                                                    </button>
                                                    <button type="submit" name="action" value="reject" class="btn-vet btn-secondary-vet btn-sm" title="Reject Cancellation">
                                                        <i class="bi bi-x-square"></i> Reject
                                                    </button>
                                                </form>
                                            <?php else: ?>
                                                <span class="text-muted">-</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                        <div class="alert-vet info">No appointments found.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Right: Slot Form + Calendar - Make it smaller -->
        <div class="col-lg-3">
            <div class="card-slot mb-4">
                <div class="card-header-slot">
                    <i class="bi bi-plus-circle"></i> Add Available Slot
                </div>
                <div class="card-body-slot">
                    <form method="POST" action="/PetSpot_clinic/public/vet_slots" class="slot-form">
                        <div>
                            <label>Date</label>
                            <input type="date" name="date" required>
                        </div>
                        <div>
                            <label>Start Time</label>
                            <input type="time" name="start_time" required>
                        </div>
                        <div>
                            <label>End Time</label>
                            <input type="time" name="end_time" required>
                        </div>
                        <div>
                            <button type="submit" class="btn-vet btn-success-vet">
                                <i class="bi bi-plus-circle"></i> Add Slot
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Calendar below slot form -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="bi bi-calendar-event"></i> Upcoming Accepted Appointments Calendar
                </div>
                <div class="card-body">
                    <div id="appointments-calendar"></div>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (!isset($calendarEvents)) {
        $calendarEvents = [];
        $today = date('Y-m-d');
        foreach ($appointments as $appointment) {
            // Include all accepted appointments from today onwards
            if (($appointment->status ?? '') === 'accepted' && $appointment->date >= $today) {
                $calendarEvents[] = [
                    'title' => ($appointment->pet_name ?? 'Pet') . ' (' . ucfirst($appointment->type ?? 'Physical') . ')',
                    'start' => $appointment->date . 'T' . $appointment->time,
                    'description' => $appointment->reason ?? 'No reason provided',
                ];
            }
        }
    }
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('appointments-calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            themeSystem: 'bootstrap5',
            initialView: 'dayGridMonth',
            height: 350,
            events: <?= json_encode($calendarEvents) ?>,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth'
            },
            dayMaxEventRows: 3, // Show up to 3 events per day
            showNonCurrentDates: false,
            selectable: false,
            // Highlight today's date
            dayCellDidMount: function(info) {
                if (info.date.toDateString() === new Date().toDateString()) {
                    info.el.style.backgroundColor = '#e3f2fd';
                    info.el.style.fontWeight = 'bold';
                }
            },
            eventClassNames: function(arg) {
                if (arg.event.title.includes('(Online)')) {
                    return ['bg-info', 'text-white', 'border-0'];
                } else {
                    return ['bg-success', 'text-white', 'border-0'];
                }
            },
            dateClick: function(info) {
                // Remove highlight from all cells
                document.querySelectorAll('.fc-daygrid-day').forEach(function(cell) {
                    cell.classList.remove('fc-highlighted');
                });
                // Highlight clicked cell
                info.dayEl.classList.add('fc-highlighted');

                // Filter events for this date
                var events = calendar.getEvents().filter(function(event) {
                    return event.startStr.startsWith(info.dateStr);
                });

                // Build HTML for modal
                var html = '';
                if (events.length > 0) {
                    html += '<ul class="list-group">';
                    events.forEach(function(event) {
                        html += '<li class="list-group-item">';
                        html += '<strong>' + event.title + '</strong>';
                        if (event.extendedProps.description) {
                            html += '<br><span>' + event.extendedProps.description + '</span>';
                        }
                        html += '<br><span class="text-muted">' + event.start.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'}) + '</span>';
                        html += '</li>';
                    });
                    html += '</ul>';
                } else {
                    html = '<div class="text-center text-muted">No accepted appointments for this date.</div>';
                }

                document.getElementById('appointmentsModalBody').innerHTML = html;
                var modal = new bootstrap.Modal(document.getElementById('appointmentsModal'));
                modal.show();
            }
        });
        calendar.render();
    });
    </script>

    <!-- Appointment Modal -->
<div class="modal fade" id="appointmentsModal" tabindex="-1" aria-labelledby="appointmentsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="appointmentsModalLabel">Accepted Appointments</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="appointmentsModalBody">
        <!-- Appointments will be loaded here -->
      </div>
    </div>
  </div>
</div>
</div>
</body>
</html>