<?php 
// require_once __DIR__ . '/../../vendor/autoload.php';
//
// class PaymentController
// {
//     public function checkout()
//     {
//         //  Stripe secret key (REMOVED FOR SECURITY)
//         //  Example: \Stripe\Stripe::setApiKey('sk_test_xxxxxxxxxxxxxxxxxxxxxxxxx'); // COMMENTED OUT FOR SECURITY
//
//         // Get data from POST (e.g., amount, description, appointment_id)
//         $amount = $_POST['amount']; // in cents
//         $appointment_id = $_POST['appointment_id'];
//         $description = $_POST['description'];
//
//         // $checkout_session = \Stripe\Checkout\Session::create([
//         //     'mode' => 'payment',
//         //     'success_url' => 'http://localhost/PetSpot_clinic/public/payment/success?appointment_id=' . $appointment_id,
//         //     'cancel_url' => 'http://localhost/PetSpot_clinic/public/payment/cancel',
//         //     'locale' => 'auto',
//         //     'line_items' => [[
//         //         'quantity' => 1,
//         //         'price_data' => [
//         //             'currency' => 'usd',
//         //             'unit_amount' => $amount,
//         //             'product_data' => [
//         //                 'name' => $description,
//         //             ],
//         //         ],
//         //     ]],
//         // ]);
//
//         // header('Location: ' . $checkout_session->url, true, 303);
//         // exit;
//
//         // Stripe session creation and redirect commented out for security
//     }
//
//     public function success()
//     {
//         if (isset($_GET['appointment_id'])) {
//             require_once __DIR__ . '/../models/Appointment.php';
//             $appointmentModel = new Appointment();
//             $appointmentModel->updatePaymentStatus($_GET['appointment_id'], 'paid');
//         }
//         include __DIR__ . '/../views/payment_success.view.php';
//     }
//
//     public function cancel()
//     {
//         // Show cancel message or redirect
//         echo "Payment cancelled.";
//     }
// }
?>
