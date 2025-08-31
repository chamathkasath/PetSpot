<?php include __DIR__ . '/../partials/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Found Pets</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
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
        .adopt-title {
            font-family: 'Pacifico', cursive;
            font-size: 2.5rem;
            color: #ffe066;
            margin-bottom: 1rem;
            font-weight: bold;
            letter-spacing: 2px;
            text-shadow: 0 2px 12px #222, 0 1px 0 #333;
        }
        
        /* Simple Clean Styles */
        .section-title {
            color: #333;
            font-weight: 600;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #ddd;
        }
        .pet-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #fff;
            margin-bottom: 1.5rem;
        }
        .pet-card:hover {
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<!-- Full-width Found Pets Banner -->
<div class="notice-section">
    <img src="/PetSpot_clinic/public/assets/images/n2.jpg" alt="Found Pets" class="notice-img">
    <div class="notice-text">
        <h1 class="adopt-title">Adoption Opportunity!</h1>
        Help us reunite lost pets with their loving families. Some pets have been waiting for a loving home for over 2 weeks.<br>
        <strong>You can adopt them and give them a forever family!</strong>
    </div>
</div>

<div class="container mt-5">
    <h2>Found Pets</h2>
    <a href="/PetSpot_clinic/public/found-pet/add" class="btn btn-primary mb-3">Report Found Pet</a>

    <!-- Contact Notice -->
    <div class="alert alert-info mb-4">
        <strong>Need Help or Have Questions?</strong><br>
        If you have any questions about found pets, the adoption process, or need assistance with any pet-related matter, our clinic team is ready to help.<br><br>
        <strong>Phone Contact:</strong> Reach us at +94 11 259 9799 or +94 11 259 9800 (Available 8:30AM-9PM daily)<br>
        <strong>Emergency Support:</strong> For urgent situations, call +94 777 738 838 (Available 24 hours)<br>
        <strong>Email Support:</strong> Send your inquiries to petspotclinic@gmail.com<br>
        <strong>Live Chat:</strong> Use our website chat feature for immediate assistance<br><br>
        Our dedicated team is committed to helping reunite pets with their families and ensuring the best care for all animals!
    </div>

    <?php if (isset($_GET['deleted']) && $_GET['deleted'] == "true"): ?>
        <div class="alert alert-success">Pet deleted successfully.</div>
    <?php elseif (isset($_GET['deleted']) && $_GET['deleted'] == "false"): ?>
        <div class="alert alert-danger">Failed to delete pet.</div>
    <?php endif; ?>

    <?php
    $userId = $_SESSION['user_ID'] ?? null;
    $adoptablePets = [];
    $userPets = [];
    $otherPets = [];

    foreach ($foundPets as $pet) {
        $foundDate = new DateTime($pet->found_date);
        $now = new DateTime();
        $interval = $foundDate->diff($now);
        $canAdopt = $interval->days >= 14 && ($pet->status ?? 'Unclaimed') === 'Unclaimed';

        // Strict comparison, both as int
        if ($userId !== null && (int)$pet->user_ID === $userId) {
            $userPets[] = $pet;
        } elseif ($canAdopt) {
            $adoptablePets[] = $pet;
        } else {
            $otherPets[] = $pet;
        }
    }
    ?>

    <!-- Section 1: Pets Available for Adoption -->
    <?php if (!empty($adoptablePets)): ?>
        <h3 class="section-title">Available for Adoption</h3>
        <div class="row">
            <?php foreach ($adoptablePets as $pet): ?>
                <div class="col-md-4 mb-4">
                    <div class="card pet-card h-100">
                        <?php if (!empty($pet->image_url)): ?>
                            <img src="<?= htmlspecialchars($pet->image_url) ?>" class="card-img-top" alt="Found Pet Image" style="height: 250px; object-fit: cover;">
                        <?php else: ?>
                            <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 250px;">
                                <span class="text-white">No Image</span>
                            </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <p class="card-text mb-1"><strong>Type:</strong> <?= htmlspecialchars($pet->type ?? 'N/A') ?></p>
                            <p class="card-text mb-1"><strong>Breed:</strong> <?= htmlspecialchars($pet->breed ?? 'N/A') ?></p>
                            <p class="card-text mb-1"><strong>Gender:</strong> <?= htmlspecialchars($pet->gender ?? 'N/A') ?></p>
                            <p class="card-text mb-1"><strong>Color:</strong> <?= htmlspecialchars($pet->color) ?></p>
                            <p class="card-text mb-1"><strong>Special Markings:</strong> <?= htmlspecialchars($pet->special_markings) ?></p>
                            <p class="card-text mb-1"><strong>Found Date:</strong> <?= htmlspecialchars($pet->found_date) ?></p>
                            <p class="card-text mb-1"><strong>Location:</strong> <?= htmlspecialchars($pet->found_location ?? 'N/A') ?></p>
                            <p class="card-text mb-1"><strong>Status:</strong> <?= htmlspecialchars($pet->status ?? 'Unclaimed') ?></p>
                            <?php if (in_array($pet->found_ID, $requestedPetIds)): ?>
                                <button class="btn btn-secondary w-100 mt-2" disabled>Request Pending</button>
                            <?php else: ?>
                                <a href="/PetSpot_clinic/public/found-pet/adopt?found_ID=<?= $pet->found_ID ?>" class="btn btn-primary w-100 mt-2">Adopt Me</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Section 2: Your Reported Pets -->
    <?php if (!empty($userPets)): ?>
        <h3 class="section-title">Your Reported Pets</h3>
        <div class="row">
            <?php foreach ($userPets as $pet): ?>
                <div class="col-md-4 mb-4">
                    <div class="card pet-card h-100">
                        <?php if (!empty($pet->image_url)): ?>
                            <img src="<?= htmlspecialchars($pet->image_url) ?>" class="card-img-top" alt="Found Pet Image" style="height: 250px; object-fit: cover;">
                        <?php else: ?>
                            <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 250px;">
                                <span class="text-white">No Image</span>
                            </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <p class="card-text mb-1"><strong>Type:</strong> <?= htmlspecialchars($pet->type ?? 'N/A') ?></p>
                            <p class="card-text mb-1"><strong>Breed:</strong> <?= htmlspecialchars($pet->breed ?? 'N/A') ?></p>
                            <p class="card-text mb-1"><strong>Gender:</strong> <?= htmlspecialchars($pet->gender ?? 'N/A') ?></p>
                            <p class="card-text mb-1"><strong>Color:</strong> <?= htmlspecialchars($pet->color) ?></p>
                            <p class="card-text mb-1"><strong>Special Markings:</strong> <?= htmlspecialchars($pet->special_markings) ?></p>
                            <p class="card-text mb-1"><strong>Found Date:</strong> <?= htmlspecialchars($pet->found_date) ?></p>
                            <p class="card-text mb-1"><strong>Location:</strong> <?= htmlspecialchars($pet->found_location ?? 'N/A') ?></p>
                            <p class="card-text mb-1"><strong>Status:</strong> <?= htmlspecialchars($pet->status ?? 'Unclaimed') ?></p>
                            <?php if ($pet->user_ID == $_SESSION['user_ID']): ?>
                                <div class="d-flex gap-2 mt-2">
                                    <a href="/PetSpot_clinic/public/found-pet/edit?found_ID=<?= $pet->found_ID ?>" class="btn btn-warning btn-sm flex-fill">Edit</a>
                                    <a href="/PetSpot_clinic/public/found-pet/delete?found_ID=<?= $pet->found_ID ?>" class="btn btn-danger btn-sm flex-fill" onclick="return confirm('Are you sure you want to delete this found pet?');">Delete</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Section 3: Pets Reported by Others -->
    <?php if (!empty($otherPets)): ?>
        <h3 class="section-title">Other Found Pets</h3>
        <div class="row">
            <?php foreach ($otherPets as $pet): ?>
                <div class="col-md-4 mb-4">
                    <div class="card pet-card h-100">
                        <?php if (!empty($pet->image_url)): ?>
                            <img src="<?= htmlspecialchars($pet->image_url) ?>" class="card-img-top" alt="Found Pet Image" style="height: 250px; object-fit: cover;">
                        <?php else: ?>
                            <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 250px;">
                                <span class="text-white">No Image</span>
                            </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <p class="card-text mb-1"><strong>Type:</strong> <?= htmlspecialchars($pet->type ?? 'N/A') ?></p>
                            <p class="card-text mb-1"><strong>Breed:</strong> <?= htmlspecialchars($pet->breed ?? 'N/A') ?></p>
                            <p class="card-text mb-1"><strong>Gender:</strong> <?= htmlspecialchars($pet->gender ?? 'N/A') ?></p>
                            <p class="card-text mb-1"><strong>Color:</strong> <?= htmlspecialchars($pet->color) ?></p>
                            <p class="card-text mb-1"><strong>Special Markings:</strong> <?= htmlspecialchars($pet->special_markings) ?></p>
                            <p class="card-text mb-1"><strong>Found Date:</strong> <?= htmlspecialchars($pet->found_date) ?></p>
                            <p class="card-text mb-1"><strong>Location:</strong> <?= htmlspecialchars($pet->found_location ?? 'N/A') ?></p>
                            <p class="card-text mb-1"><strong>Reported By:</strong> <?= htmlspecialchars($pet->reporter_email ?? 'N/A') ?></p>
                            <p class="card-text mb-1"><strong>Status:</strong> <?= htmlspecialchars($pet->status ?? 'Unclaimed') ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
<footer class="text-center">
    
  <?php include __DIR__ . '/../partials/footer.view.php'; ?>
</footer>