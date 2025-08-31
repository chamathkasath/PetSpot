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
    <title>Contact Messages</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Contact Messages</h2>
    
    <?php if (isset($_SESSION['flash_message'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($_SESSION['flash_message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['flash_message']); ?>
    <?php endif; ?>
    
    <?php if (empty($messages)): ?>
        <div class="alert alert-info">No contact messages found.</div>
    <?php else: ?>
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>Date</th>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messages as $msg): ?>
                <tr>
                    <td><?= date('d M Y', strtotime($msg->created_at)) ?></td>
                    <td><?= htmlspecialchars($msg->name ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($msg->email ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($msg->subject ?? 'No Subject') ?></td>
                    <td>
                        <div style="max-width: 400px; word-wrap: break-word;">
                            <?= nl2br(htmlspecialchars($msg->message)) ?>
                        </div>
                    </td>
                    <td>
                        <?php if (isset($msg->replied) && $msg->replied): ?>
                            <span class="badge bg-success">Replied</span>
                        <?php else: ?>
                            <span class="badge bg-warning text-dark">Pending</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (!isset($msg->replied) || !$msg->replied): ?>
                            <div class="reply-section">
                                <div class="mb-2">
                                    <textarea class="form-control form-control-sm" id="reply_<?= $msg->id ?>" placeholder="Type your reply message here..." rows="2" style="width: 100%; min-width: 250px;"></textarea>
                                </div>
                                <div class="d-flex gap-1">
                                    <button type="button" class="btn btn-primary btn-sm" onclick="sendReply(<?= $msg->id ?>, '<?= htmlspecialchars($msg->name ?? 'User', ENT_QUOTES) ?>', '<?= htmlspecialchars($msg->email, ENT_QUOTES) ?>')">
                                        Send Reply
                                    </button>
                                </div>
                            </div>
                        <?php else: ?>
                            <span class="badge bg-secondary">Replied</span>
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
function sendReply(messageId, userName, userEmail) {
    const replyTextArea = document.getElementById('reply_' + messageId);
    const replyText = replyTextArea.value.trim();
    
    if (replyText === '') {
        alert('Please enter a reply message before sending.');
        replyTextArea.focus();
        return;
    }
    
    const confirmMessage = `Are you sure you want to send this reply to ${userName} (${userEmail})?\n\nYour reply: "${replyText}"`;
    
    if (confirm(confirmMessage)) {
        // Create and submit a form
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/PetSpot_clinic/public/manager/handle-contact-reply';
        
        // Add hidden inputs
        const messageIdInput = document.createElement('input');
        messageIdInput.type = 'hidden';
        messageIdInput.name = 'message_id';
        messageIdInput.value = messageId;
        
        const replyInput = document.createElement('input');
        replyInput.type = 'hidden';
        replyInput.name = 'reply_message';
        replyInput.value = replyText;
        
        const emailInput = document.createElement('input');
        emailInput.type = 'hidden';
        emailInput.name = 'user_email';
        emailInput.value = userEmail;
        
        const nameInput = document.createElement('input');
        nameInput.type = 'hidden';
        nameInput.name = 'user_name';
        nameInput.value = userName;
        
        form.appendChild(messageIdInput);
        form.appendChild(replyInput);
        form.appendChild(emailInput);
        form.appendChild(nameInput);
        
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
</body>
</html>