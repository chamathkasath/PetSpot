
<!-- filepath: c:\xampp\htdocs\PetSpot_clinic\app\views\vetstaff\edit_blog.view.php -->
<?php include __DIR__ . '/../partials/vetstaff_header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Blog</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .form-container {
            max-width: 700px;
            margin: 0 auto;
            background: #f8fafc;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .form-title {
            font-family: 'Caveat', cursive;
            color: #2563eb;
            text-align: center;
            margin-bottom: 20px;
            font-size: 2rem;
        }
        .btn-primary {
            background-color: #2563eb;
            border-color: #2563eb;
        }
        .btn-secondary {
            background-color: #7c3aed;
            border-color: #7c3aed;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="form-container">
        <h2 class="form-title">Edit Blog</h2>
        <form action="/PetSpot_clinic/public/vetstaff/blogs/edit?blog_ID=<?= $blog->id ?>" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Blog Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($blog->title) ?>" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Blog Content</label>
                <textarea class="form-control" id="content" name="content" rows="6" required><?= htmlspecialchars($blog->content) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Upload Blog Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                <?php if (!empty($blog->image)): ?>
                    <img src="<?= htmlspecialchars($blog->image) ?>" alt="Blog Image" class="img-fluid mt-3 rounded shadow-sm" style="max-width: 100px;">
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Update Blog</button>
            <a href="/PetSpot_clinic/public/vetstaff/blogs" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>