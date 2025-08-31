<?php include __DIR__ . '/../partials/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Pets | PetSpot Clinic</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/PetSpot_clinic/public/assets/css/header.css">
</head>
<body>
<div class="container mt-5">
    <h2>My Pets</h2>
    <a href="/PetSpot_clinic/public/pets/add" class="btn btn-primary mb-3">Add Pet</a>
    <div class="row">
        <?php foreach ($pets as $pet): ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow">
                <?php if (!empty($pet->image_url)): ?>
                    <img src="<?= htmlspecialchars($pet->image_url) ?>" class="card-img-top" alt="Pet Image" style="height: 250px; object-fit: cover;">
                <?php else: ?>
                    <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 250px;">
                        <span class="text-white">No Image</span>
                    </div>
                <?php endif; ?>
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($pet->name) ?></h5>
                    <p class="card-text mb-1"><strong>Type:</strong> <?= htmlspecialchars($pet->type) ?></p>
                    <p class="card-text mb-1"><strong>Color:</strong> <?= htmlspecialchars($pet->color) ?></p>
                    <p class="card-text mb-1"><strong>Breed:</strong> <?= htmlspecialchars($pet->breed) ?></p>
                    <p class="card-text mb-1"><strong>Gender:</strong> <?= htmlspecialchars($pet->gender) ?></p>
                    <p class="card-text mb-1"><strong>Special Markings:</strong> <?= htmlspecialchars($pet->special_markings) ?></p>
                    <?php if ($pet->status === 'lost'): ?>
                        <p class="card-text mb-1"><strong>Last Seen Location:</strong> <?= htmlspecialchars($pet->last_seen_location ?? '') ?></p>
                        <p class="card-text mb-1"><strong>Last Seen Date:</strong> <?= htmlspecialchars($pet->last_seen_date ?? '') ?></p>
                        <p class="card-text mb-1"><strong>Special Note:</strong> <?= htmlspecialchars($pet->special_note ?? '') ?></p>
                    <?php endif; ?>
                    <span class="badge <?= $pet->status === 'lost' ? 'bg-danger' : 'bg-success' ?>">
                        <?= ucfirst(htmlspecialchars($pet->status)) ?>
                    </span>
                </div>
                <div class="card-footer bg-white border-0 d-flex justify-content-between">
                    <?php if ($pet->status === 'lost'): ?>
                        <a href="/PetSpot_clinic/public/pets/mark-found?pet_ID=<?= $pet->pet_ID ?>" class="btn btn-success btn-sm">Mark as Found</a>
                    <?php else: ?>
                        <!-- Button to open modal -->
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#reportLostModal<?= $pet->pet_ID ?>">
                            Report Lost
                        </button>
                    <?php endif; ?>
                    <!-- Update and Delete buttons -->
                    <div>
                        <a href="/PetSpot_clinic/public/pets/edit?pet_ID=<?= $pet->pet_ID ?>" class="btn btn-info btn-sm me-1">Update</a>
                        <a href="/PetSpot_clinic/public/pets/delete?pet_ID=<?= $pet->pet_ID ?>" class="btn btn-danger btn-sm"
                           onclick="return confirm('Are you sure you want to delete this pet?');">Delete</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add this modal code after the card-footer div, inside the foreach loop -->
        <div class="modal fade" id="reportLostModal<?= $pet->pet_ID ?>" tabindex="-1" aria-labelledby="reportLostModalLabel<?= $pet->pet_ID ?>" aria-hidden="true">
          <div class="modal-dialog">
            <form method="post" action="/PetSpot_clinic/public/pets/report-lost?pet_ID=<?= $pet->pet_ID ?>">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="reportLostModalLabel<?= $pet->pet_ID ?>">Report Lost Pet</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="mb-3">
                    <label for="last_seen_location<?= $pet->pet_ID ?>" class="form-label">Last Seen Location</label>
                    <input type="text" class="form-control" id="last_seen_location<?= $pet->pet_ID ?>" name="last_seen_location" required>
                  </div>
                  <div class="mb-3">
                    <label for="last_seen_date<?= $pet->pet_ID ?>" class="form-label">Last Seen Date</label>
                    <input type="date" class="form-control" id="last_seen_date<?= $pet->pet_ID ?>" name="last_seen_date" required>
                  </div>
                  <div class="mb-3">
                    <label for="special_note<?= $pet->pet_ID ?>" class="form-label">Special Note</label>
                    <input type="text" class="form-control" id="special_note<?= $pet->pet_ID ?>" name="special_note">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-warning">Report Lost</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    
   <footer class="text-center">
    
  <?php include __DIR__ . '/../partials/footer.view.php'; ?>
</footer>

</body>
</html>