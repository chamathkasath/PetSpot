<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lost Pets | PetSpot Clinic</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/PetSpot_clinic/public/assets/css/header.css">
    <link rel="stylesheet" href="/PetSpot_clinic/public/assets/css/found.css">
    <style>
        .notice-section {
            margin-top: 100px;
            margin-bottom: 30px;
            width: 100vw;
            left: 50%;
            right: 50%;
            position: relative;
            transform: translateX(-50%);
            display: block;
            max-width: 100vw;
            overflow: hidden;
            animation: popPoster 1s cubic-bezier(.68,-0.55,.27,1.55);
        }
        .notice-img {
            width: 100vw;
            height: 400px;
            object-fit: cover;
            border-radius: 0;
            display: block;
            max-width: 100vw;
            filter: brightness(0.7) blur(0px);
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
            text-shadow: 0 4px 18px rgba(0,0,0,0.7), 0 1px 0 #333;
            padding: 0 10px;
            line-height: 1.5;
            z-index: 2;
            letter-spacing: 0.01em;
            animation: fadeInUp 1.2s;
        }
        @keyframes popPoster {
            0% { transform: translateX(-50%) scale(0.8); opacity: 0; }
            80% { transform: translateX(-50%) scale(1.05); opacity: 1; }
            100% { transform: translateX(-50%) scale(1); }
        }
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translate(-50%, -30%); }
            100% { opacity: 1; transform: translate(-50%, -50%); }
        }
        .lost-title {
            font-family: 'Pacifico', cursive;
            font-size: 2.5rem;
            color: #ffe066;
            margin-bottom: 1rem;
            font-weight: bold;
            letter-spacing: 2px;
            text-shadow: 0 2px 12px #222, 0 1px 0 #333;
        }
    </style>
</head>
<body>
    <?php include __DIR__ . '/../partials/header.php'; ?>
    
    <!-- Full-width Lost Pets Banner -->
    <div class="notice-section">
        <img src="/PetSpot_clinic/public/assets/images/n1.jpg" alt="Lost Pets" class="notice-img">
        <div class="notice-text">
            <h1 class="lost-title">Lost Pets</h1>
            Our hearts go out to families searching for their beloved pets. If you recognize any of these precious animals, 
            please contact us immediately. Every moment counts in bringing these pets back to their loving homes.
        </div>
    </div>
    
    <div class="container mt-5">
        <h2 class="text-center mb-4">Lost Pets</h2>
        
        <!-- Contact Notice -->
        <div class="alert alert-info mb-4">
            <strong>Found One of These Pets?</strong><br>
            If you have found any of these pets or have information about their whereabouts, please contact us immediately. Your quick action could bring a beloved companion home.<br><br>
            <strong>Phone Contact:</strong> Reach us at +94 11 259 9799 or +94 11 259 9800 (Available 8:30AM-9PM daily)<br>
            <strong>Emergency Support:</strong> For urgent situations, call +94 777 738 838 (Available 24 hours)<br>
            <strong>Email Support:</strong> Send your information to petspotclinic@gmail.com<br>
            <strong>Live Chat:</strong> Use our website chat feature for immediate assistance<br>
            <strong>Report Online:</strong> Submit through our <a href="/PetSpot_clinic/public/found-pet" class="alert-link">Found Pet Section</a><br><br>
            Every moment matters in reuniting these precious pets with their families!
        </div>
        
        <div class="row">
            <?php if (!empty($lostPets) && is_array($lostPets)): ?>
                <?php foreach ($lostPets as $pet): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow">
                        <?php if (!empty($pet->image_url)): ?>
                            <img src="<?= htmlspecialchars($pet->image_url) ?>" class="card-img-top" alt="Pet Image" style="height: 250px; object-fit: cover;">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($pet->name) ?></h5>
                            <p class="card-text"><strong>Type:</strong> <?= htmlspecialchars($pet->type) ?></p>
                            <p class="card-text"><strong>Gender:</strong> <?= htmlspecialchars($pet->gender ?? '') ?></p>
                            <p class="card-text"><strong>Color:</strong> <?= htmlspecialchars($pet->color) ?></p>
                            <p class="card-text"><strong>Breed:</strong> <?= htmlspecialchars($pet->breed) ?></p>
                            <p class="card-text"><strong>Special Markings:</strong> <?= htmlspecialchars($pet->special_markings ?? '') ?></p>
                            <p class="card-text"><strong>Last Seen Location:</strong> <?= htmlspecialchars($pet->last_seen_location ?? '') ?></p>
                            <p class="card-text"><strong>Last Seen Date:</strong> <?= htmlspecialchars($pet->last_seen_date ?? '') ?></p>
                            <p class="card-text"><strong>Special Note:</strong> <?= htmlspecialchars($pet->special_note ?? '') ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-muted text-center">No lost pets reported at this time.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <footer class="text-center">
    
  <?php include __DIR__ . '/../partials/footer.view.php'; ?>
</footer>
</body>
</html>
