<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vaccinations | PetSpot Clinic</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/PetSpot_clinic/public/assets/css/header.css">
    <style>
        body {
            background: linear-gradient(135deg,rgb(179, 206, 227) 0%, #e0e7ff 100%);
            min-height: 100vh;
        }
        .vaccination-card {
            border-radius: 1rem;
            background: #fff;
            border-left: 6px solid #4f8cff;
            transition: box-shadow 0.2s, border-color 0.2s;
            margin-bottom: 1.5rem;
        }
        .vaccination-card:hover {
            box-shadow: 0 8px 32px rgba(80, 112, 255, 0.16);
            border-left: 6px solid #2563eb;
        }
        .vaccination-title {
            color: #2563eb;
            font-weight: 700;
        }
        .vaccination-label {
            font-weight: 500;
            color: #64748b;
        }
        .vaccination-value {
            font-weight: 600;
            color: #334155;
        }
        /* Fix for header overlap */
        .notice-section {
            margin-top: 100px; /* Adjust if your header is taller/shorter */
            margin-bottom: 30px;
            width: 100vw;
            left: 50%;
            right: 50%;
            position: relative;
            transform: translateX(-50%);
            display: block;
            max-width: 100vw;
            overflow: hidden;
        }
        .notice-img {
            width: 100vw;
            height: 350px;
            object-fit: cover;
            border-radius: 0;
            display: block;
            max-width: 100vw;
        }
        .notice-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90vw;
            max-width: 900px;
            color: #fff;
            text-align: center;
            font-size: 1.2rem;
            font-weight: 500;
            text-shadow: 0 2px 8px rgba(0,0,0,0.45), 0 1px 2px rgba(0,0,0,0.25);
            padding: 0 10px;
            line-height: 1.5;
            z-index: 2;
            letter-spacing: 0.01em;
        }
        .notice-section::after {
            /* Optional: soft gradient at bottom for extra readability */
            content: "";
            position: absolute;
            left: 0; right: 0; bottom: 0;
            height: 40%;
            background: linear-gradient(to top, rgba(0,0,0,0.25), rgba(0,0,0,0));
            z-index: 1;
            pointer-events: none;
        }
        @media (max-width: 768px) {
            .notice-section { margin-top: 70px; }
            .notice-img { height: 180px; }
            .notice-text { font-size: 1rem; }
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/partials/header.php'; ?>

    <!-- Notice Section -->
    <div class="notice-section">
        <img src="/PetSpot_clinic/public/assets/images/pet15.jpg" alt="Vaccination Reminder" class="notice-img">
        <div class="notice-text">
            <strong style="font-size:2.0rem;">VACCINATION </strong><br>
            <b>Keeping your pet’s vaccinations up to date ensures their health, happiness, and protection from harmful diseases.<br>
            Please make sure to visit PetSpot Clinic before the next due date.</b><br>
            ✔ Timely vaccinations keep your pet safe and active.<br>
            ✔ Always bring your pet's vaccination record when visiting.<br>
            ✔ Contact us if you notice any unusual behavior after vaccination.
        </div>
    </div>

    <div class="container py-5">
        <h2 class="mb-5 text-center vaccination-title">Vaccination Records</h2>
        <div class="row g-4 justify-content-center">
            <?php if (!empty($vaccinations)): ?>
                <?php foreach ($vaccinations as $v): ?>
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="vaccination-card p-4 h-100 shadow-sm">
                            <h5 class="mb-3 vaccination-title" style="font-size:1.25rem; color:#2563eb;">
                                <?= htmlspecialchars($v->vaccination_name) ?>
                            </h5>
                            <div class="mb-2">
                                <span class="vaccination-label">Pet ID:</span>
                                <span class="vaccination-value"><?= htmlspecialchars($v->pet_ID) ?></span>
                            </div>
                            <div class="mb-2">
                                <span class="vaccination-label">Type:</span>
                                <span class="vaccination-value"><?= htmlspecialchars($v->vaccination_type) ?></span>
                            </div>
                            <div class="mb-2">
                                <span class="vaccination-label">Date of Last Vaccine:</span>
                                <span class="vaccination-value"><?= htmlspecialchars($v->date_of_last_vaccine) ?></span>
                            </div>
                            <div class="mb-2">
                                <span class="vaccination-label">Next Due Date:</span>
                                <span class="vaccination-value"><?= htmlspecialchars($v->next_due_date) ?></span>
                            </div>
                            <?php if (!empty($_SESSION['staff_id'])): ?>
                            <div>
                                <span class="vaccination-label">User ID:</span>
                                <span class="vaccination-value"><?= htmlspecialchars($v->user_ID) ?></span>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <div class="alert alert-info">No vaccination records found.</div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<footer class="text-center">
    
   <?php include __DIR__ . '/partials/footer.view.php'; ?>
</footer>