<!-- filepath: c:\xampp\htdocs\PetSpot_clinic\app\views\manager\adoption_requests.view.php -->
<?php include __DIR__ . '/../partials/manager_header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adoption Requests</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Adoption Requests</h2>
    <?php if (empty($requests)): ?>
        <div class="alert alert-info">No adoption requests found.</div>
    <?php else: ?>
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>Request ID</th>
                <th>Pet ID</th>
                <th>User ID</th>
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
                    <td><?= htmlspecialchars($req->id) ?></td>
                    <td><?= htmlspecialchars($req->found_ID) ?></td>
                    <td><?= htmlspecialchars($req->user_ID) ?></td>
                    <td>
                        <?php if ($req->status === 'Accepted'): ?>
                            <span class="badge bg-success">Accepted</span>
                        <?php elseif ($req->status === 'Rejected'): ?>
                            <span class="badge bg-danger">Rejected</span>
                        <?php else: ?>
                            <span class="badge bg-warning text-dark">Pending</span>
                        <?php endif; ?>
                    </td>
                    <td><?= date('d M Y', strtotime($req->requested_at)) ?></td>
                    <td><?= htmlspecialchars($req->message) ?></td>
                    <td><?= htmlspecialchars($req->manager_reply ?? '') ?></td>
                    <td>
                        <?php if ($req->status === 'Pending'): ?>
                            <div class="reply-section">
                                <div class="mb-2">
                                    <textarea class="form-control form-control-sm" id="reply_<?= $req->id ?>" placeholder="Type your reply message here..." rows="2" style="width: 100%; min-width: 250px;"></textarea>
                                </div>
                                <div class="d-flex gap-1">
                                    <button type="button" class="btn btn-success btn-sm" onclick="processRequest(<?= $req->id ?>, 'accept', '<?= htmlspecialchars($req->adopter_name ?? 'User', ENT_QUOTES) ?>')">
                                        Accept
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="processRequest(<?= $req->id ?>, 'reject', '<?= htmlspecialchars($req->adopter_name ?? 'User', ENT_QUOTES) ?>')">
                                        Reject
                                    </button>
                                </div>
                            </div>
                        <?php else: ?>
                            <span class="badge bg-secondary">Processed</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
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
        form.action = '/PetSpot_clinic/public/manager/handle-adoption-request';
        
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
        replyInput.name = 'manager_reply';
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