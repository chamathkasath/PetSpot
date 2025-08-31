<!-- filepath: c:\xampp\htdocs\PetSpot_clinic\app\views\manager\feedbacks.view.php -->
<?php
if (empty($_SESSION['staff_role']) || $_SESSION['staff_role'] !== 'Manager') {
    header("Location: /PetSpot_clinic/public/login");
    exit;
}
?>
<?php include __DIR__ . '/../partials/manager_header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All User Feedbacks (Manager)</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">All User Feedbacks</h2>
    <?php if (empty($allFeedbacks)): ?>
        <div class="alert alert-info">No feedbacks found.</div>
    <?php else: ?>
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>User ID</th>
                <th>Rating</th>
                <th>Comment</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($allFeedbacks as $fb): ?>
            <tr>
                <td><?= htmlspecialchars($fb->user_ID ?? '') ?></td>
                <td>
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <span style="color:<?= $i <= $fb->rate ? '#ffc107' : '#e4e5e9' ?>;">&#9733;</span>
                    <?php endfor; ?>
                </td>
                <td><?= htmlspecialchars($fb->comment ?? '') ?></td>
                <td><?= date('d M Y', strtotime($fb->created_at)) ?></td>
                <td>
                    <?php if ($fb->confirmed): ?>
                        <span class="badge bg-success">Confirmed</span>
                    <?php else: ?>
                        <span class="badge bg-warning text-dark">Pending</span>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if (!$fb->confirmed): ?>
                        <form method="post" action="/PetSpot_clinic/public/manager/confirm-feedback" class="d-inline">
                            <input type="hidden" name="feedback_id" value="<?= $fb->feedback_id ?>">
                            <input type="hidden" name="action" value="confirm">
                            <button type="submit" class="btn btn-success btn-sm">Confirm</button>
                        </form>
                    <?php else: ?>
                        <form method="post" action="/PetSpot_clinic/public/manager/confirm-feedback" class="d-inline">
                            <input type="hidden" name="feedback_id" value="<?= $fb->feedback_id ?>">
                            <input type="hidden" name="action" value="cancel">
                            <button type="submit" class="btn btn-warning btn-sm">Cancel Confirm</button>
                        </form>
                    <?php endif; ?>
                    <form method="post" action="/PetSpot_clinic/public/manager/delete-feedback" class="d-inline ms-1" onsubmit="return confirm('Are you sure you want to delete this feedback?');">
                        <input type="hidden" name="feedback_id" value="<?= $fb->feedback_id ?>">
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>
</body>
</html>