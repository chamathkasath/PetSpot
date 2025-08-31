<!DOCTYPE html>
<html>
<head>
    <title>Possible Match Found for Your Lost Pet</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f7f7;
            color: #222;
            margin: 0;
            padding: 0;
        }
        .container {
            background: #fff;
            max-width: 600px;
            margin: 30px auto;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        h3 {
            color: #2a7ae2;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            padding: 6px 0;
            border-bottom: 1px solid #f0f0f0;
            color: #222 !important;
        }
        .pet-image {
            margin: 15px 0;
            text-align: center;
        }
        .pet-image img {
            max-width: 250px;
            max-height: 250px;
            border-radius: 8px;
            border: 1px solid #ddd;
            box-shadow: 0 1px 4px rgba(0,0,0,0.07);
        }
        .contact {
            background: #eaf6ff;
            padding: 12px 18px;
            border-radius: 6px;
            margin: 18px 0;
            font-size: 1.08em;
        }
        .footer {
            margin-top: 30px;
            color: #888;
            font-size: 0.98em;
        }
    </style>
</head>
<body>
    <div class="container">
        <p>Dear <?= htmlspecialchars($ownerName ?? '') ?>,</p>
        <p>
            We have found a pet that closely matches the details of your lost pet. Please review the information below to see if this could be your pet.
        </p>
        <h3>Your Lost Pet's Details</h3>
        <ul>
            <li><strong>Type:</strong> <?= htmlspecialchars($lostPet->type ?? '') ?></li>
            <li><strong>Color:</strong> <?= htmlspecialchars($lostPet->color ?? '') ?></li>
            <li><strong>Breed:</strong> <?= htmlspecialchars($lostPet->breed ?? '') ?></li>
            <li><strong>Gender:</strong> <?= htmlspecialchars($lostPet->gender ?? '') ?></li>
            <li><strong>Special Markings:</strong> <?= htmlspecialchars($lostPet->special_markings ?? '') ?></li>
            <li><strong>Last Seen Location:</strong> <?= htmlspecialchars($lostPet->last_seen_location ?? '') ?></li>
            <li><strong>Last Seen Date:</strong> <?= htmlspecialchars($lostPet->last_seen_date ?? '') ?></li>
        </ul>
        <h3>Found Pet's Details</h3>
        <ul>
            <li><strong>Type:</strong> <?= htmlspecialchars($foundPet['type'] ?? '') ?></li>
            <li><strong>Color:</strong> <?= htmlspecialchars($foundPet['color'] ?? '') ?></li>
            <li><strong>Breed:</strong> <?= htmlspecialchars($foundPet['breed'] ?? '') ?></li>
            <li><strong>Gender:</strong> <?= htmlspecialchars($foundPet['gender'] ?? '') ?></li>
            <li><strong>Special Markings:</strong> <?= htmlspecialchars($foundPet['special_markings'] ?? '') ?></li>
            <li><strong>Found Location:</strong> <?= htmlspecialchars($foundPet['found_location'] ?? '') ?></li>
            <li><strong>Found Date:</strong> <?= htmlspecialchars($foundPet['found_date'] ?? '') ?></li>
        </ul>
        <?php if (!empty($foundPet['image_url'])): ?>
            <div class="pet-image">
                <?php
                    $baseUrl = 'http://localhost'; // Use your actual domain in production
                    $imageUrl = $foundPet['image_url'];
                    if (strpos($imageUrl, 'http') !== 0) {
                        $imageUrl = $baseUrl . $imageUrl;
                    }
                ?>
                <a href="<?= htmlspecialchars($imageUrl) ?>" target="_blank">
                    <img src="<?= htmlspecialchars($imageUrl) ?>" alt="Found Pet Photo">
                </a>
            </div>
        <?php endif; ?>
        <div class="contact">
            If you think this might be your pet, you can contact the person who found the pet at:<br>
            <strong><?= htmlspecialchars($foundPet['reporter_email'] ?? '') ?></strong>
        </div>
        <p>
            If you need any assistance or have questions, please contact <strong>PetSpot Clinic</strong>. We are here to help you!
        </p>
        <div class="footer">
            Best regards,<br>
            PetSpot Clinic Team
        </div>
    </div>
</body>
</html>