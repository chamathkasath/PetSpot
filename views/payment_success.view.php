
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Payment Success | PetSpot Clinic</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #f8fafc 0%, #e0e7ef 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .success-card {
            max-width: 420px;
            margin: auto;
            border-radius: 1.5rem;
            box-shadow: 0 4px 24px 0 rgba(44, 62, 80, 0.09);
            background: #fff;
            padding: 2.7rem 2rem;
            text-align: center;
        }
        .success-icon {
            font-size: 4rem;
            color: #22c55e;
            margin-bottom: 1rem;
        }
        .btn-back {
            margin-top: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="success-card">
        <div class="success-icon">
            <i class="bi bi-check-circle-fill"></i>
        </div>
        <h2 class="mb-3">Thank You!</h2>
        <p class="mb-4">
            Your payment was successful.<br>
            We appreciate your trust in PetSpot Clinic.<br>
            <strong>Your prescription will be processed soon.</strong>
        </p>
        <a href="/PetSpot_clinic/public/" class="btn btn-success btn-back">
            <i class="bi bi-house-door"></i> Back to Home
        </a>
    </div>
</body>
</html>