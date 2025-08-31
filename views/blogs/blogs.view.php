<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blogs - PetSpot Clinic</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/PetSpot_clinic/public/assets/css/header.css">
    <link rel="stylesheet" href="/PetSpot_clinic/public/assets/css/blog.css">
    
    <!-- Optionally include a Google Font for the featured title -->
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include __DIR__ . '/../partials/header.php'; ?>
   

<div class="container mt-5">
    <h2 class="text-center mb-5" style="font-family:'Caveat',cursive; color:#2563eb; font-size:2.5rem;">Featured Blogs</h2>
    <div class="row justify-content-center align-items-stretch">
        <div class="col-md-4 d-flex flex-column align-items-center mb-4">
            <img src="/PetSpot_clinic/public/assets/images/bl2.jpg" alt="Blog 1" class="blog-img" style="width:100%;max-width:350px;border-radius:18px;box-shadow:0 4px 18px rgba(44,83,100,0.13);">
            <div class="blog-title mt-3" style="font-weight:700;font-size:1.2rem;color:#222;">How to Keep Your Pet Happy</div>
            <div class="blog-desc" style="color:#444;">Tips and tricks for a joyful pet life, from daily routines to playtime ideas.</div>
        </div>
        <div class="col-md-4 d-flex flex-column align-items-center mb-4">
            <img src="/PetSpot_clinic/public/assets/images/ho2.jpg" alt="Blog 2" class="blog-img" style="width:100%;max-width:350px;border-radius:18px;box-shadow:0 4px 18px rgba(44,83,100,0.13);">
            <div class="blog-title mt-3" style="font-weight:700;font-size:1.2rem;color:#222;">Nutrition Matters</div>
            <div class="blog-desc" style="color:#444;">Discover the best diets for your pets and how nutrition impacts their health.</div>
        </div>
        <div class="col-md-4 d-flex flex-column align-items-center mb-4">
            <img src="/PetSpot_clinic/public/assets/images/bl3.jpg" alt="Blog 3" class="blog-img" style="width:100%;max-width:350px;border-radius:18px;box-shadow:0 4px 18px rgba(44,83,100,0.13);">
            <div class="blog-title mt-3" style="font-weight:700;font-size:1.2rem;color:#222;">PetSpot Clinic Stories</div>
            <div class="blog-desc" style="color:#444;">Read inspiring stories from our clinic and see how we help pets every day.</div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <?php if (!empty($blogs)): ?>
        <?php $featured = $blogs[0]; ?>
        <!-- Featured Blog -->
        <div class="featured-blog mb-5 p-4 rounded shadow-sm" style="background:#f8fafc;">
            <div class="row align-items-center">
                <div class="col-lg-7 mb-4 mb-lg-0">
                    <div class="featured-title" style="font-size:2rem;font-family:'Caveat',cursive;color:#2563eb;">
                        <?= htmlspecialchars($featured->title) ?>
                    </div>
                    <div class="blog-meta mb-2" style="color:#7c3aed;font-weight:500;">
                        <?= date('F j, Y', strtotime($featured->created_at)) ?>
                        <?php if (isset($featured->is_staff) && $featured->is_staff): ?>
                            <span class="badge bg-success ms-2">PetSpot Clinic</span>
                        <?php endif; ?>
                    </div>
                    <p style="font-size:1.1rem;"><?= nl2br(htmlspecialchars($featured->content)) ?></p>
                    <?php if (isset($featured->image) && !empty($featured->image)): ?>
                        <img src="<?= htmlspecialchars($featured->image) ?>" alt="Blog Image" class="img-fluid rounded shadow-sm mb-3" style="max-width:300px;">
                    <?php endif; ?>
                   <?php if (isset($currentUserId) && $currentUserId == $featured->user_ID): ?>
                        <a href="/PetSpot_clinic/public/blogs/edit/<?= $featured->id ?>" class="btn btn-warning btn-sm mt-2">Edit</a>
                        <a href="/PetSpot_clinic/public/blogs/delete/<?= $featured->id ?>" class="btn btn-danger btn-sm mt-2" onclick="return confirm('Are you sure you want to delete this blog?');">Delete</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Blog Grid -->
        <div class="row blog-grid">
            <?php foreach (array_slice($blogs, 1) as $blog): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <?php if (isset($blog->is_staff) && $blog->is_staff): ?>
                            <div class="card-header bg-success text-white text-center py-2" style="font-weight:600;">PetSpot Clinic</div>
                        <?php endif; ?>
                        <?php if (!empty($blog->image)): ?>
                            <img src="<?= htmlspecialchars($blog->image) ?>" alt="Blog Image" class="card-img-top" style="max-height:200px;object-fit:cover;">
                        <?php endif; ?>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title" style="font-family:'Caveat',cursive;"><?= htmlspecialchars($blog->title) ?></h5>
                            <div class="blog-meta mb-2" style="color:#7c3aed;font-weight:500;">
                                <?= date('F j, Y', strtotime($blog->created_at)) ?>
                            </div>
                            <p class="card-text" style="flex:1;"><?= nl2br(htmlspecialchars($blog->content)) ?></p>
                            <?php if (isset($currentUserId) && $currentUserId == $blog->user_ID): ?>
                                <a href="/PetSpot_clinic/public/blogs/edit/<?= $blog->id ?>" class="btn btn-warning btn-sm mt-2">Edit</a>
                                <a href="/PetSpot_clinic/public/blogs/delete/<?= $blog->id ?>" class="btn btn-danger btn-sm mt-2" onclick="return confirm('Are you sure you want to delete this blog?');">Delete</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info">No blog posts found.</div>
    <?php endif; ?>
    <a class="btn btn-primary mt-4" href="/PetSpot_clinic/public/blogs/add">Add New Blog</a>
</div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<footer class="text-center">
    
   <?php include __DIR__ . '/../partials/footer.view.php'; ?> 
</footer>