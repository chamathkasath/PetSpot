<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailService
{
    private $mailer;
    private $config;

    public function __construct()
    {
        $this->config = include __DIR__ . '/../config/mail.php';
        $this->mailer = new PHPMailer(true);
        $this->configureMailer();
    }

    private function configureMailer()
    {
        $this->mailer->isSMTP();
        $this->mailer->Host = $this->config['host'];
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = $this->config['username'];
        $this->mailer->Password = $this->config['password'];
        $this->mailer->SMTPSecure = $this->config['encryption'];
        $this->mailer->Port = $this->config['port'];
        $this->mailer->setFrom($this->config['from_address'], $this->config['from_name']);
    }

    public function sendPetMatchNotification($to, $ownerName, $lostPet, $foundPet)
    {
        try {
            $this->mailer->clearAddresses();
            $this->mailer->addAddress($to, $ownerName);
            if (!empty($foundPet['reporter_email'])) {
                $this->mailer->addReplyTo($foundPet['reporter_email']);
            }
            $this->mailer->isHTML(true);
            $this->mailer->Subject = 'Possible Match Found for Your Lost Pet';

            // Render email body from template
            ob_start();
            include __DIR__ . '/../views/emails/pet_match_notification.php';
            $body = ob_get_clean();

            $this->mailer->Body = $body;
            return $this->mailer->send();
        } catch (Exception $e) {
            error_log("Mailer Error: " . $e->getMessage());
            return false;
        }
    }

    public function sendGenericMail($to, $subject, $body)
    {
        try {
            $this->mailer->clearAddresses();
            $this->mailer->addAddress($to);
            $this->mailer->isHTML(true);
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $body;
            return $this->mailer->send();
        } catch (Exception $e) {
            error_log("Mailer Error: " . $e->getMessage()); // <-- Add this line
            return false;
        }
    }

    public function sendAppointmentStatusSMS($userFullName, $appointmentDate, $appointmentTime, $status)
    {
        $sms = "Dear {$userFullName}, your appointment on {$appointmentDate} at {$appointmentTime} has been {$status} by PetSpot Clinic.";
        if ($status === 'rejected') {
            $sms .= " Please try booking another slot or contact us for more information.";
        }
        // Code to send SMS using an SMS gateway API
        // ...
    }
    public function sendAdoptionNotification($to, $adopter_name, $found_ID, $status, $pet_name = '', $manager_message = '')
    {
        try {
            $this->mailer->clearAddresses();
            $this->mailer->addAddress($to, $adopter_name);
            $this->mailer->isHTML(true);
            $this->mailer->Subject = 'Your Pet Adoption Request Status';

            // Render email body from template
            ob_start();
            $adopter_name = $adopter_name;
            $found_ID = $found_ID;
            $status = $status;
            $pet_name = $pet_name;
            $manager_message = $manager_message;
            include __DIR__ . '/../views/emails/adoption_notification.view.php';
            $body = ob_get_clean();

            $this->mailer->Body = $body;
            return $this->mailer->send();
        } catch (Exception $e) {
            error_log("Mailer Error: " . $e->getMessage());
            return false;
        }
    }

    public function sendContactReply($to, $user_name, $reply_message)
    {
        try {
            $this->mailer->clearAddresses();
            $this->mailer->addAddress($to, $user_name);
            $this->mailer->isHTML(true);
            $this->mailer->Subject = 'Reply from PetSpot Clinic';

            $body = "
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset='UTF-8'>
                <title>Reply from PetSpot Clinic</title>
            </head>
            <body>
                <h2>Reply from PetSpot Clinic</h2>
                <p>Dear " . htmlspecialchars($user_name) . ",</p>
                <p>Thank you for contacting PetSpot Clinic. Here is our response to your inquiry:</p>
                <div style='background-color: #f8f9fa; padding: 15px; border-left: 4px solid #007bff; margin: 20px 0;'>
                    " . nl2br(htmlspecialchars($reply_message)) . "
                </div>
                <p>If you have any further questions, please don't hesitate to contact us.</p>
                <p>Best regards,<br>
                PetSpot Clinic Team</p>
                <hr>
                <p style='color: #666; font-size: 12px;'>
                    PetSpot Clinic<br>
                    Phone: +1-800-555-1234<br>
                    Email: petspotclinic@gmail.com
                </p>
            </body>
            </html>
            ";

            $this->mailer->Body = $body;
            return $this->mailer->send();
        } catch (Exception $e) {
            error_log("Mailer Error: " . $e->getMessage());
            return false;
        }
    }
}