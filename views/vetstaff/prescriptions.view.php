<?php 
if (isset($_SESSION['staff_role']) && $_SESSION['staff_role'] === 'Veterinarian') {
    include __DIR__ . '/../partials/vet_header.php';
} else {
    include __DIR__ . '/../partials/vetstaff_header.php';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Prescriptions</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f4f7fa; }
        .card-prescription {
            border-radius: 16px;
            box-shadow: 0 2px 8px #0001;
            margin-bottom: 1.5rem;
            transition: box-shadow 0.15s, transform 0.15s;
        }
        .card-prescription:hover {
            box-shadow: 0 6px 24px #0002;
            transform: translateY(-2px) scale(1.01);
        }
        .icon-pill {
            font-size: 2rem;
            color: #0d6efd;
            margin-right: 0.5rem;
        }
        .prescription-header {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .prescription-meta {
            font-size: 0.95rem;
            color: #888;
        }
        .medicines-list {
            font-family: monospace;
            font-size: 1rem;
            color: #333;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h2 class="mb-4 text-center"><i class="bi bi-file-earmark-text"></i> Prescriptions</h2>
    <?php if (!empty($prescriptions)): ?>
        <div class="row">
            <?php foreach ($prescriptions as $prescription): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card card-prescription p-3">
                        <div class="prescription-header mb-2">
                            <i class="bi bi-capsule icon-pill"></i>
                            <strong>Prescription #<?= htmlspecialchars($prescription->prescription_ID ?? '') ?></strong>
                        </div>
                        <div class="prescription-meta mb-1">
                            <span><i class="bi bi-person"></i> User ID: <?= htmlspecialchars($prescription->user_ID ?? '') ?></span><br>
                            <span><i class="bi bi-github"></i> Pet ID: <?= htmlspecialchars($prescription->pet_ID ?? '') ?></span><br>
                            <span><i class="bi bi-calendar"></i> <?= htmlspecialchars($prescription->created_at ?? '') ?></span>
                        </div>
                        <div class="mb-2">
                            <span class="fw-bold">Medicines:</span>
                            <div class="medicines-list">
                                <?php
                                $medicines = [];
                                if (!empty($prescription->medicines)) {
                                    $medicines = json_decode($prescription->medicines, true);
                                }
                                if (!empty($medicines) && is_array($medicines)) {
                                    foreach ($medicines as $med) {
                                        // If $med is associative (single medicine), wrap it in an array
                                        if (isset($med['medicine'])) {
                                            $med = [$med];
                                        }
                                        foreach ($med as $item) {
                                            echo '<div>Medicine: <b>' . htmlspecialchars($item['medicine'] ?? '') . '</b>';
                                            if (isset($item['drink_time'])) {
                                                echo ', Drink Time: <b>' . htmlspecialchars($item['drink_time']) . '</b>';
                                            }
                                            echo '</div>';
                                        }
                                    }
                                } else {
                                    echo '<span class="text-muted">No medicines listed.</span>';
                                }
                                ?>
                            </div>
                        </div>
                        <?php if (!empty($prescription->note)): ?>
                        <div class="mb-2">
                            <span class="fw-bold">Note:</span>
                            <div><?= nl2br(htmlspecialchars($prescription->note)) ?></div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center">No prescriptions found.</div>
    <?php endif; ?>
</div>
</body>
</html>