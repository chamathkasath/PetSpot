
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Medicine Inventory | PetSpot Clinic Pharmacist</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background: #f4f7fa;
            min-height: 100vh;
        }
        .table th {
            background: #343a40 !important;
            color: white !important;
            font-weight: 600;
            border: none !important;
            padding: 1rem 0.75rem;
        }
        .table td {
            vertical-align: middle;
            padding: 1rem 0.75rem;
            border-color: #e9ecef;
        }
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
    </style>
</head>

<body>
    <!-- Navbar Header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/PetSpot_clinic/public/pharmacist/dashboard">Pharmacist Dashboard</a>
            <div class="collapse navbar-collapse" id="pharmacistNavbar">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/PetSpot_clinic/public/pharmacist/dashboard">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PetSpot_clinic/public/pharmacist/prescriptions">Prescriptions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/PetSpot_clinic/public/pharmacist/inventory">Inventory</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/PetSpot_clinic/public/logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <!-- Header -->
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">
                <i class="bi bi-boxes me-2"></i>
                Medicine Inventory
            </h1>
        </div>

        <!-- Medicine Inventory Table -->
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">
                    <i class="bi bi-table me-2"></i>
                    Available Medicines
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Medicine Name</th>
                                <th>Category</th>
                                <th>Price (LKR)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Amoxicillin 250mg</strong></td>
                                <td><span class="badge bg-primary">Antibiotic</span></td>
                                <td>LKR 850.00</td>
                            </tr>
                            <tr>
                                <td><strong>Metacam 0.5mg/ml</strong></td>
                                <td><span class="badge bg-success">Anti-inflammatory</span></td>
                                <td>LKR 2,450.00</td>
                            </tr>
                            <tr>
                                <td><strong>Frontline Plus Flea Treatment</strong></td>
                                <td><span class="badge bg-warning text-dark">Flea Treatment</span></td>
                                <td>LKR 1,200.00</td>
                            </tr>
                            <tr>
                                <td><strong>Doxycycline 100mg</strong></td>
                                <td><span class="badge bg-primary">Antibiotic</span></td>
                                <td>LKR 950.00</td>
                            </tr>
                            <tr>
                                <td><strong>Prednisolone 5mg</strong></td>
                                <td><span class="badge bg-success">Anti-inflammatory</span></td>
                                <td>LKR 750.00</td>
                            </tr>
                            <tr>
                                <td><strong>Hill's Prescription Diet</strong></td>
                                <td><span class="badge bg-info">Therapeutic Food</span></td>
                                <td>LKR 3,200.00</td>
                            </tr>
                            <tr>
                                <td><strong>Cephalexin 500mg</strong></td>
                                <td><span class="badge bg-primary">Antibiotic</span></td>
                                <td>LKR 1,100.00</td>
                            </tr>
                            <tr>
                                <td><strong>Heartgard Plus</strong></td>
                                <td><span class="badge bg-danger">Heartworm Prevention</span></td>
                                <td>LKR 1,850.00</td>
                            </tr>
                            <tr>
                                <td><strong>Tramadol 50mg</strong></td>
                                <td><span class="badge bg-secondary">Pain Relief</span></td>
                                <td>LKR 1,650.00</td>
                            </tr>
                            <tr>
                                <td><strong>Gabapentin 100mg</strong></td>
                                <td><span class="badge bg-secondary">Pain Relief</span></td>
                                <td>LKR 1,400.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
