<?php
require_once __DIR__ . '/app/models/Vaccination.php';
require_once __DIR__ . '/app/models/User.php';
require_once __DIR__ . '/app/models/Pet.php';
require_once __DIR__ . '/app/services/MailService.php';

$vaccinationModel = new Vaccination();
$userModel = new User();
$petModel = new Pet();
$mailService = new MailService();

// Get dates
$today = date('Y-m-d');
$tomorrow = date('Y-m-d', strtotime('+1 day'));
$week_before = date('Y-m-d', strtotime('+7 day'));

// Find vaccinations due on each date
$due_dates = [
    ['date' => $week_before, 'label' => 'week_before'],
    ['date' => $tomorrow, 'label' => 'day_before'],
    ['date' => $today, 'label' => 'due_today'],
];

foreach ($due_dates as $due) {
    $upcoming = $vaccinationModel->query(
        "SELECT * FROM vaccinations WHERE next_due_date = ?", [$due['date']]
    );

    foreach ($upcoming as $vacc) {
        $owner = $userModel->getById($vacc->user_ID);
        $pet = $petModel->first(['pet_ID' => $vacc->pet_ID]);
        if ($owner && !empty($owner->email) && $pet) {
            if ($due['label'] === 'week_before') {
                $subject = "Upcoming Vaccination for {$pet->name} (1 week left)";
                $body = "Dear {$owner->fullname},<br>Your pet <b>{$pet->name}</b> is due for <b>{$vacc->vaccination_name}</b> vaccination on <b>{$vacc->next_due_date}</b>.<br>This is a reminder one week in advance.<br>Please plan your visit to PetSpot Clinic.";
            } elseif ($due['label'] === 'day_before') {
                $subject = "Vaccination Reminder for {$pet->name} (Tomorrow)";
                $body = "Dear {$owner->fullname},<br>Your pet <b>{$pet->name}</b> is due for <b>{$vacc->vaccination_name}</b> vaccination on <b>{$vacc->next_due_date}</b>.<br>This is a reminder for tomorrow.<br>Please visit PetSpot Clinic for timely vaccination.";
            } else { // due_today
                $subject = "Vaccination Due Today for {$pet->name}";
                $body = "Dear {$owner->fullname},<br>Your pet <b>{$pet->name}</b> is due for <b>{$vacc->vaccination_name}</b> vaccination <b>today ({$vacc->next_due_date})</b>.<br>Please visit PetSpot Clinic today.";
            }
            $mailService->sendGenericMail($owner->email, $subject, $body);
        }
    }
}