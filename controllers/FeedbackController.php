<?php
require_once __DIR__ . '/../models/Feedback.php';

class FeedbackController
{
    use Controller;

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $feedback = new Feedback();
            $data = [
                'user_ID' => $_SESSION['user_ID'] ?? null,
                'rate' => $_POST['rate'] ?? null,
                'comment' => $_POST['comment'] ?? ''
            ];
            $feedback->insert($data);
            echo "<script>alert('Thank you for your feedback!');window.location.href='/PetSpot_clinic/public/about';</script>";
            exit;
        }
        include __DIR__ . '/../views/feedback.view.php';
    }

    public function dashboard()
    {
        $feedback = new Feedback();
        $allFeedback = $feedback->findAll();

        // Calculate average rating
        $average = 0;
        $count = count($allFeedback);
        if ($count > 0) {
            $sum = array_sum(array_column($allFeedback, 'rate'));
            $average = $sum / $count;
        }

        // You can add more stats here (e.g., most liked, breakdowns, etc.)

        include __DIR__ . '/../views/feedback/dashboard.view.php';
    }

    public function submit()
    {
        if (empty($_SESSION['user_ID'])) {
            header("Location: /PetSpot_clinic/public/login");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $feedback = new Feedback();
            $data = [
                'user_ID' => $_SESSION['user_ID'],
                'rate' => $_POST['rate'] ?? null,
                'comment' => $_POST['comment'] ?? '',
                'confirmed' => 0 // Mark as not confirmed
            ];
            $feedback->insert($data);
            echo "<script>alert('Thank you for your feedback!');window.location.href='/PetSpot_clinic/public/aboutus';</script>";
            exit;
        }
        header("Location: /PetSpot_clinic/public/aboutus");
        exit;
    }
}