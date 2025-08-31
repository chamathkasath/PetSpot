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
    <title>Vet Staff Blogs</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/PetSpot_clinic/public/assets/css/blog.css">
</head>
<body>
<div class="container py-4">
    <h2 class="mb-4 text-center">Manage Blogs</h2>
    <a href="/PetSpot_clinic/public/vetstaff/blogs/add" class="btn btn-primary mb-4">Add New Blog</a>
    <div class="row">
        <?php foreach ($blogs as $blog): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <?php if (isset($blog->is_staff) && $blog->is_staff): ?>
                        <div class="card-header bg-success text-white text-center py-2" style="font-weight:600;">PetSpot Clinic</div>
                    <?php endif; ?>
                    <?php if (!empty($blog->image)): ?>
                        <img src="<?= htmlspecialchars($blog->image) ?>" alt="Blog Image" class="card-img-top">
                    <?php endif; ?>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= htmlspecialchars($blog->title) ?></h5>
                        <div class="blog-meta mb-2" style="color:#7c3aed;font-weight:500;">
                            <?= date('F j, Y', strtotime($blog->created_at)) ?>
                        </div>
                        <p class="card-text" style="flex:1;"><?= nl2br(htmlspecialchars($blog->content)) ?></p>
                        <div class="mt-2">
                            <a href="/PetSpot_clinic/public/vetstaff/blogs/confirm?blog_ID=<?= $blog->id ?>" 
                               class="btn btn-<?= $blog->confirmed ? 'secondary' : 'success' ?> btn-sm">
                                <?= $blog->confirmed ? 'Unconfirm' : 'Confirm' ?>
                            </a>
                            <a href="/PetSpot_clinic/public/vetstaff/blogs/edit?blog_ID=<?= $blog->id ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="/PetSpot_clinic/public/vetstaff/blogs/delete?blog_ID=<?= $blog->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this blog?');">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>