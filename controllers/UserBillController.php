
<?php
require_once __DIR__ . '/../models/Bill.php';
require_once __DIR__ . '/../models/Prescription.php';

class UserBillController
{
    public function view($bill_ID)
    {
     
        if (empty($_SESSION['user_ID'])) {
            header('Location: /PetSpot_clinic/public/login');
            exit;
        }

        $billModel = new Bill();
        $prescriptionModel = new Prescription();
        
        $bill = $billModel->first(['bill_ID' => $bill_ID, 'user_ID' => $_SESSION['user_ID']]);
        if (!$bill) {
            // Bill not found or not owned by user
            header('Location: /PetSpot_clinic/public/404');
            exit;
        }

        // Get prescription details for this bill
        $prescription = null;
        if (!empty($bill->prescription_ID)) {
            $prescription = $prescriptionModel->first(['prescription_ID' => $bill->prescription_ID]);
        }

        include __DIR__ . '/../views/bill.view.php';
    }
}