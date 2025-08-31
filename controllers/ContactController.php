<?php

require_once __DIR__ . '/../models/ContactMessage.php';
require_once __DIR__ . '/../services/MailService.php';

class ContactController
{
    public function index()
    {
        $success = false;
        $error = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $message = trim($_POST['message'] ?? '');

            if ($name && $email && $message) {
                // Save to DB
                $contact = new ContactMessage();
                $contact->insert([
                    'name' => $name,
                    'email' => $email,
                    'message' => $message,
                ]);

                // Send email to manager
                $mailService = new MailService();
                $managerEmail = 'manager@petspot.com'; // Change to your manager's email
                $subject = "New Contact Message from $name";
                $body = "<strong>Name:</strong> $name<br><strong>Email:</strong> $email<br><strong>Message:</strong><br>" . nl2br(htmlspecialchars($message));
                $mailService->sendGenericMail($managerEmail, $subject, $body);

                $success = true;
            } else {
                $error = "Please fill in all fields.";
            }
        }

        include "../app/views/contact.view.php";
    }
}