<?php
/**
 * Variables expected:
 * $userFullName (string)
 * $status (string) // 'accepted' or 'rejected'
 * $appointmentDate (string)
 * $appointmentTime (string)
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Appointment Status Notification</title>
</head>
<body>
    <p>Dear <?= htmlspecialchars($userFullName) ?>,</p>
    <p>Your appointment on <strong><?= htmlspecialchars($appointmentDate) ?></strong> at <strong><?= htmlspecialchars($appointmentTime) ?></strong> has been <span style="color:<?= $status === 'accepted' ? 'green' : 'red' ?>;"><b><?= $status ?></b></span> by PetSpot Clinic.</p>
    <?php if ($status === 'rejected'): ?>
        <p>Please try booking another slot or contact us for more information.</p>
    <?php endif; ?>
    <br>
    <p>Thank you,<br>PetSpot Clinic Team</p>
</body>
</html>