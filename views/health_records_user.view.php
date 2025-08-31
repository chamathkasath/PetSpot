<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Pet Health Records - PetSpot Clinic</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="/PetSpot_clinic/public/assets/css/header.css">
    <style>
        .page-header {
            background: linear-gradient(135deg, #2980b9, #3498db);
            color: white;
            padding: 40px 0;
            margin-bottom: 30px;
        }
        .pet-section {
            margin-bottom: 40px;
        }
        .health-table thead {
            background: #3498db;
            color: white;
        }
        .health-table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .health-status {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        .status-excellent { background: #d4edda; color: #155724; }
        .status-good { background: #d1ecf1; color: #0c5460; }
        .status-fair { background: #fff3cd; color: #856404; }
        .status-poor { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <?php include __DIR__ . '/partials/header.php'; ?>

    <div class="container mb-5">
        <?php if (empty($records)): ?>
            <div class="text-center py-5">
                <i class="fas fa-clipboard-list fa-5x text-muted mb-4"></i>
                <h3 class="text-muted">No Health Records Found</h3>
                <p class="text-muted">Your pet health records will appear here once created by our veterinary team.</p>
                <a href="/PetSpot_clinic/public/appointment" class="btn btn-primary btn-lg">
                    <i class="fas fa-calendar-plus me-2"></i>Book an Appointment
                </a>
            </div>
        <?php else: ?>
            
            <?php
            // Group records by pet
            $petRecords = [];
            foreach ($records as $record) {
                $petRecords[$record->pet_ID][] = $record;
            }
            ?>

            <?php foreach ($petRecords as $petId => $petHealthRecords): ?>
                <?php 
                // Get pet name from first record
                $firstRecord = $petHealthRecords[0];
                $petName = !empty($firstRecord->pet_name) ? $firstRecord->pet_name : "Unknown Pet";
                $petType = !empty($firstRecord->pet_type) ? $firstRecord->pet_type : "Unknown";
                ?>
                
                <div class="pet-section">
                    <div class="row align-items-center mb-3">
                        <div class="col">
                            <h4 class="mb-0 text-primary">
                                <?= htmlspecialchars($petName) ?>
                            </h4>
                            <p class="text-muted mb-0"><?= htmlspecialchars($petType) ?></p>
                        </div>
                    </div>

                    <!-- Health Records Table -->
                    <div class="table-responsive">
                        <table class="table table-striped health-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Weight</th>
                                    <th>Height</th>
                                    <th>Status</th>
                                    <th>Vaccine Reactions</th>
                                    <th>Allergies</th>
                                    <th>Previous Illness</th>
                                    <th>Notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($petHealthRecords as $record): ?>
                                    <tr>
                                        <td><?= date('M d, Y', strtotime($record->Health_check_date)) ?></td>
                                        <td><?= htmlspecialchars($record->weight ?: 'N/A') ?></td>
                                        <td><?= htmlspecialchars($record->height ?: 'N/A') ?></td>
                                        <td>
                                            <span class="health-status status-<?= strtolower(str_replace(' ', '-', $record->current_health_status)) ?>">
                                                <?= htmlspecialchars($record->current_health_status) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if ($record->reactions_to_vaccines_before === 'Yes'): ?>
                                                <span class="badge bg-warning">Yes</span>
                                            <?php else: ?>
                                                <span class="badge bg-success">No</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if (!empty($record->Allergies)): ?>
                                                <span class="badge bg-danger"><?= htmlspecialchars($record->Allergies) ?></span>
                                            <?php else: ?>
                                                <span class="text-muted">None</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if (!empty($record->Previous_illness)): ?>
                                                <div style="max-width: 200px;"><?= nl2br(htmlspecialchars($record->Previous_illness)) ?></div>
                                            <?php else: ?>
                                                <span class="text-muted">None</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if (!empty($record->Note)): ?>
                                                <div style="max-width: 200px;"><?= nl2br(htmlspecialchars($record->Note)) ?></div>
                                            <?php else: ?>
                                                <span class="text-muted">No notes</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php include __DIR__ . '/partials/footer.view.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>