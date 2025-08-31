<!-- filepath: app/views/emails/adoption_notification.view.php -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Adoption Request Notification</title>
</head>
<body>
    <h2>Pet Adoption Request Update</h2>
    <p>Dear <?= htmlspecialchars($adopter_name ?? 'User') ?>,</p>
    <p>Your request to adopt <strong><?= htmlspecialchars($pet_name ?? 'the pet') ?></strong> has been <strong><?= htmlspecialchars($status ?? '') ?></strong>.</p>
    <?php if (!empty($manager_message)): ?>
        <p>Message from Manager: <?= nl2br(htmlspecialchars($manager_message)) ?></p>
    <?php endif; ?>
    <p>please contact PetSpot Clinic for more information.</p>
    <p>Phone: <strong>+1-800-555-1234</strong></p>
    <p>Email: <strong>petspotclinic@gmail.com</strong></p>
    <p>Thank you for using PetSpot Clinic!</p>
</body>
</html>