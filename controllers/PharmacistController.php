<?php
require_once __DIR__ . '/../models/Prescription.php';
require_once __DIR__ . '/../models/Bill.php';
require_once __DIR__ . '/../models/Appointment.php';

class PharmacistController
{
    use Controller;

    public function prescriptions()
    {
        $prescriptionModel = new Prescription();
        $billModel = new Bill();
        $prescriptions = $prescriptionModel->getAllWithUserAndAppointment();

        // Attach bill status to each prescription
        foreach ($prescriptions as &$prescription) {
            $bill = $billModel->first(['prescription_ID' => $prescription->prescription_ID]);
            $prescription->is_paid = $bill ? true : false;
            $prescription->bill = $bill; // Attach bill object
        }

        include __DIR__ . '/../views/pharmacist/prescriptions.view.php';
    }

    public function addBill()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bill = new Bill();

            // Calculate total cost of medicines
            $medicines = $_POST['medicines'] ?? [];
            $cost_of_medicine = 0;
            foreach ($medicines as $med) {
                $cost_of_medicine += floatval($med['price']);
            }

            // Payment method as comma-separated string
            $payment_method = $_POST['payment_method'];

            $data = [
                'prescription_ID' => $_POST['prescription_ID'],
                'cost_of_medicine' => $cost_of_medicine,
                'total_price' => $_POST['total_price'],
                'user_ID' => $_POST['user_ID'],
                'payment_method' => $payment_method,
                'note' => $_POST['note']
            ];
            $bill->insert($data);

            // Update the amount in the appointment table
            if (!empty($_POST['appointment_ID'])) {
                $appointmentModel = new Appointment();
                $appointmentModel->query(
                    "UPDATE appointments SET amount = :amount WHERE appointment_ID = :appointment_ID",
                    [
                        'amount' => $_POST['total_price'],
                        'appointment_ID' => $_POST['appointment_ID']
                    ]
                );
            }
        }
        header("Location: /PetSpot_clinic/public/pharmacist/prescriptions");
        exit;
    }

    public function dashboard()
    {
        // Optionally, check for pharmacist session
        if (empty($_SESSION['staff_role']) || $_SESSION['staff_role'] !== 'Pharmacist') {
            header('Location: /PetSpot_clinic/public/login');
            exit;
        }
        include __DIR__ . '/../views/pharmacist/dashboard.view.php';
    }

    public function viewBill($bill_ID)
    {
        $billModel = new Bill();
        $bill = $billModel->first(['bill_ID' => $bill_ID]);
        if (!$bill) {
            // Handle not found
            die('Bill not found');
        }
        // Optionally fetch prescription or user info if needed
        include __DIR__ . '/../views/pharmacist/bill_details.view.php';
    }

    public function inventory()
    {
        // Check for pharmacist session
        if (empty($_SESSION['staff_role']) || $_SESSION['staff_role'] !== 'Pharmacist') {
            header('Location: /PetSpot_clinic/public/login');
            exit;
        }
        
        // Load the inventory view
        include __DIR__ . '/../views/pharmacist/inventory.view.php';
    }
}