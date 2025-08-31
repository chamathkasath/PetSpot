
<div class="col-md-4 mb-4">
    <div class="card h-100">
        <?php if (!empty($pet->image)): ?>
            <img src="<?= htmlspecialchars($pet->image) ?>" class="card-img-top" alt="Pet Image">
        <?php else: ?>
            <img src="/PetSpot_clinic/public/assets/images/default_pet.png" class="card-img-top" alt="Pet Image">
        <?php endif; ?>
        <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($pet->name ?? 'Unknown') ?></h5>
            <p class="card-text">
                <strong>Found Date:</strong> <?= htmlspecialchars($pet->found_date) ?><br>
                <strong>Status:</strong> <?= htmlspecialchars($pet->status ?? 'Unclaimed') ?><br>
                <?php if (!empty($pet->description)): ?>
                    <strong>Description:</strong> <?= htmlspecialchars($pet->description) ?><br>
                <?php endif; ?>
            </p>
            <?php if (isset($_SESSION['user_ID']) && $pet->user_ID == $_SESSION['user_ID']): ?>
                <a href="/PetSpot_clinic/public/found-pet/edit/<?= $pet->id ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="/PetSpot_clinic/public/found-pet/delete/<?= $pet->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
            <?php endif; ?>
        </div>
    </div>
</div>
<footer class="text-center">
    
  <?php include __DIR__ . '/../partials/footer.view.php'; ?>
</footer>