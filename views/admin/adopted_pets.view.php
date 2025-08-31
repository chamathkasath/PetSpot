<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adoption Requests | PetSpot Clinic Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background: #f4f7fa;
            min-height: 100vh;
        }
        .sidebar {
            background: linear-gradient(135deg, #3a7bd5 0%, #00d2ff 100%);
            min-height: 100vh;
            color: #fff;
            padding: 2rem 1rem;
        }
        .sidebar .nav-link {
            color: #fff;
            font-weight: 500;
            margin-bottom: 1rem;
            border-radius: 8px;
            transition: background 0.2s;
            padding: 0.75rem 1rem;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.15);
            color: #fff;
        }
        .sidebar .brand {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #fff;
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
        .btn-accept {
            background: #28a745;
            border: none;
            color: white;
            font-size: 0.8rem;
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            font-weight: 500;
        }
        .btn-accept:hover {
            background: #218838;
            color: white;
        }
        .btn-reject {
            background: #dc3545;
            border: none;
            color: white;
            font-size: 0.8rem;
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            font-weight: 500;
        }
        .btn-reject:hover {
            background: #c82333;
            color: white;
        }
        .reply-section {
            min-width: 300px;
        }
        .reply-section textarea {
            border-radius: 6px;
            border: 2px solid #e9ecef;
            transition: border-color 0.2s;
        }
        .reply-section textarea:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }
        .badge {
            font-size: 0.8rem;
            padding: 0.5rem 0.8rem;
            border-radius: 6px;
        }
        .alert {
            border-radius: 8px;
            border: none;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar">
                <div class="brand mb-4">
                    <i class="bi bi-heart-pulse"></i> PetSpot Clinic
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="/PetSpot_clinic/public/admin/dashboard">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PetSpot_clinic/public/admin/register-staff">
                            <i class="bi bi-person-plus"></i> Register Staff
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PetSpot_clinic/public/admin/pet-management">
                            <i class="bi bi-paw"></i> Pet Management
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PetSpot_clinic/public/admin/appointments">
                            <i class="bi bi-calendar-event"></i> Appointments
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PetSpot_clinic/public/admin/vaccinations">
                            <i class="bi bi-capsule"></i> Vaccinations
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PetSpot_clinic/public/admin/users">
                            <i class="bi bi-people-fill"></i> Pet Owners
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PetSpot_clinic/public/admin/feedbacks">
                            <i class="bi bi-chat-dots"></i> Feedbacks
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PetSpot_clinic/public/admin/reports">
                            <i class="bi bi-bar-chart"></i> Reports
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PetSpot_clinic/public/admin/found-pets">
                            <i class="bi bi-search"></i> Found Pets
                        </a>
                    </li>
                    
                    <li class="nav-item">
                    <a class="nav-link" href="/PetSpot_clinic/public/admin/adoption-requests">
                        <i class="bi bi-clipboard-heart"></i> Adoption Requests
                    </a>
                </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PetSpot_clinic/public/admin/health-records">
                            <i class="bi bi-file-medical"></i> Health Records
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PetSpot_clinic/public/admin/staff">
                            <i class="bi bi-person-badge"></i> Staff Management
                        </a>
                    </li>
                    <li class="nav-item mt-4">
                        <a class="nav-link" href="/PetSpot_clinic/public/logout">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container py-4">
                    <!-- Header -->
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">
                            <i class="bi bi-clipboard-heart me-2"></i>
                            Adoption Requests Management
                        </h1>
                    </div>

                    <?php if (isset($_SESSION['flash_message'])): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i>
                            <?= htmlspecialchars($_SESSION['flash_message']) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php unset($_SESSION['flash_message']); ?>
                    <?php endif; ?>

                    <?php if (empty($requests)): ?>
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>
                            No adoption requests found.
                        </div>
                    <?php else: ?>
                        <!-- Adoption Requests Table -->
                        <div class="card">
                            <div class="card-header bg-dark text-white">
                                <h5 class="mb-0">
                                    <i class="bi bi-table me-2"></i>
                                    Adoption Requests
                                </h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Request ID</th>
                                                <th>Pet Info</th>
                                                <th>Adopter Details</th>
                                                <th>Status</th>
                                                <th>Requested At</th>
                                                <th>Message</th>
                                                <th>Reply</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php foreach ($requests as $req): ?>
                                        <tr>
                                            <td><strong><?= htmlspecialchars($req->id) ?></strong></td>
                                            <td>
                                                <div>
                                                    <strong>Pet ID:</strong> <?= htmlspecialchars($req->found_ID) ?><br>
                                                    <small class="text-muted"><?= htmlspecialchars($req->pet_name ?? 'Unknown Pet') ?></small>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <strong><?= htmlspecialchars($req->adopter_name) ?></strong><br>
                                                    <small class="text-muted"><?= htmlspecialchars($req->adopter_email) ?></small><br>
                                                    <small class="text-muted">User ID: <?= htmlspecialchars($req->user_ID) ?></small>
                                                </div>
                                            </td>
                                            <td>
                                                <?php if ($req->status === 'Accepted'): ?>
                                                    <span class="badge bg-success">
                                                        <i class="bi bi-check-circle me-1"></i>Accepted
                                                    </span>
                                                <?php elseif ($req->status === 'Rejected'): ?>
                                                    <span class="badge bg-danger">
                                                        <i class="bi bi-x-circle me-1"></i>Rejected
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge bg-warning text-dark">
                                                        <i class="bi bi-clock me-1"></i>Pending
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <small><?= date('d M Y', strtotime($req->requested_at)) ?></small><br>
                                                <small class="text-muted"><?= date('g:i A', strtotime($req->requested_at)) ?></small>
                                            </td>
                                            <td>
                                                <div style="max-width: 200px;">
                                                    <?= htmlspecialchars(substr($req->message ?? '', 0, 100)) ?>
                                                    <?= strlen($req->message ?? '') > 100 ? '...' : '' ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div style="max-width: 200px;">
                                                    <?= htmlspecialchars(substr($req->manager_reply ?? '', 0, 100)) ?>
                                                    <?= strlen($req->manager_reply ?? '') > 100 ? '...' : '' ?>
                                                </div>
                                            </td>
                                            <td>
                                                <?php if ($req->status === 'Pending'): ?>
                                                    <div class="reply-section">
                                                        <div class="mb-2">
                                                            <textarea class="form-control form-control-sm" id="reply_<?= $req->id ?>" placeholder="Type your reply message here..." rows="2"></textarea>
                                                        </div>
                                                        <div class="d-flex gap-1">
                                                            <button type="button" class="btn btn-accept btn-sm" onclick="processRequest(<?= $req->id ?>, 'accept', '<?= htmlspecialchars($req->adopter_name ?? 'User', ENT_QUOTES) ?>')">
                                                                <i class="bi bi-check-lg me-1"></i>Accept
                                                            </button>
                                                            <button type="button" class="btn btn-reject btn-sm" onclick="processRequest(<?= $req->id ?>, 'reject', '<?= htmlspecialchars($req->adopter_name ?? 'User', ENT_QUOTES) ?>')">
                                                                <i class="bi bi-x-lg me-1"></i>Reject
                                                            </button>
                                                        </div>
                                                    </div>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary">
                                                        <i class="bi bi-check2 me-1"></i>Processed
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function processRequest(requestId, action, adopterName) {
        const replyTextArea = document.getElementById('reply_' + requestId);
        const replyText = replyTextArea.value.trim();
        
        if (replyText === '') {
            alert('Please enter a reply message before proceeding.');
            replyTextArea.focus();
            return;
        }
        
        const actionText = action === 'accept' ? 'accept' : 'reject';
        const confirmMessage = `Are you sure you want to ${actionText} the adoption request from ${adopterName}?\n\nYour reply: "${replyText}"`;
        
        if (confirm(confirmMessage)) {
            // Create and submit a form
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/PetSpot_clinic/public/admin/handle-adoption-request';
            
            // Add hidden inputs
            const requestIdInput = document.createElement('input');
            requestIdInput.type = 'hidden';
            requestIdInput.name = 'request_id';
            requestIdInput.value = requestId;
            
            const actionInput = document.createElement('input');
            actionInput.type = 'hidden';
            actionInput.name = 'action';
            actionInput.value = action;
            
            const replyInput = document.createElement('input');
            replyInput.type = 'hidden';
            replyInput.name = 'admin_reply';
            replyInput.value = replyText;
            
            form.appendChild(requestIdInput);
            form.appendChild(actionInput);
            form.appendChild(replyInput);
            
            document.body.appendChild(form);
            form.submit();
        }
    }
    </script>
</body>
</html>