<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Feedbacks | PetSpot Clinic Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <?php include __DIR__ . '/../partials/admin_styles.php'; ?>
    <style>
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1rem;
        }
        .feedback-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 1rem;
            transition: transform 0.2s;
        }
        .feedback-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }
        .rating-stars {
            color: #ffc107;
        }
        .btn-edit {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border: none;
            color: white;
        }
        .btn-delete {
            background: #dc3545;
            border: none;
            color: white;
            font-size: 0.8rem;
            padding: 0.25rem 0.5rem;
        }
        .btn-delete:hover {
            background: #c82333;
            color: white;
        }
        .alert-success-custom {
            background: linear-gradient(45deg, #56ab2f, #a8e6cf);
            border: none;
            color: white;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php $currentPage = 'feedbacks'; include __DIR__ . '/../partials/admin_sidebar.php'; ?>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="container py-4">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2><i class="bi bi-chat-dots me-2"></i>Feedback Management</h2>
                </div>

                <!-- Success/Error Messages -->
                <?php if (isset($_GET['deleted'])): ?>
                    <div class="alert alert-success-custom alert-dismissible fade show" role="alert">
                        <i class="bi bi-trash me-2"></i>Feedback deleted successfully!
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <!-- Feedbacks Table -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="mb-0"><i class="bi bi-chat-dots me-2"></i>All Feedbacks</h4>
                            </div>
                            <div class="card-body">
                                <?php if (empty($allFeedback)): ?>
                                    <div class="text-center py-5">
                                        <i class="bi bi-chat-dots" style="font-size: 4rem; color: #ccc;"></i>
                                        <h5 class="text-muted mt-3">No feedbacks yet</h5>
                                        <p class="text-muted">Feedbacks from users will appear here.</p>
                                    </div>
                                <?php else: ?>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>User</th>
                                                    <th>Email</th>
                                                    <th>Rating</th>
                                                    <th>Comment</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($allFeedback as $feedback): ?>
                                                    <tr>
                                                        <td><?= $feedback->feedback_id ?></td>
                                                        <td>
                                                            <strong><?= htmlspecialchars($feedback->fullname ?? 'Anonymous') ?></strong>
                                                        </td>
                                                        <td><?= htmlspecialchars($feedback->email ?? 'No email') ?></td>
                                                        <td>
                                                            <div class="rating-stars">
                                                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                                                    <i class="bi bi-star<?= $i <= $feedback->rate ? '-fill' : '' ?>"></i>
                                                                <?php endfor; ?>
                                                                <span class="ms-1 text-muted">(<?= $feedback->rate ?>/5)</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" 
                                                                 title="<?= htmlspecialchars($feedback->comment) ?>">
                                                                <?= htmlspecialchars($feedback->comment) ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="badge bg-<?= $feedback->confirmed ? 'success' : 'warning' ?>">
                                                                <?= $feedback->confirmed ? 'Confirmed' : 'Pending' ?>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <small class="text-muted">
                                                                <?= $feedback->created_at ? date('M d, Y', strtotime($feedback->created_at)) : 'No date' ?>
                                                            </small>
                                                        </td>
                                                        <td>
                                                            <a href="/PetSpot_clinic/public/admin/delete-feedback?id=<?= $feedback->feedback_id ?>" 
                                                               class="btn btn-delete btn-sm" 
                                                               onclick="return confirm('Are you sure you want to delete this feedback?')">
                                                                Delete
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
