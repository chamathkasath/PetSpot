<!-- filepath: c:\xampp\htdocs\PetSpot_clinic\app\views\blogs\add_blog.view.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Blog | PetSpot Clinic</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #f8fafc 0%, #e0e7ef 100%);
            min-height: 100vh;
        }
        .blog-form-card {
            max-width: 540px;
            margin: 3rem auto;
            border-radius: 1.5rem;
            box-shadow: 0 4px 24px 0 rgba(44, 62, 80, 0.09);
            background: #fff;
            padding: 2.5rem 2rem;
        }
        .form-title {
            font-family: 'Caveat', cursive;
            font-size: 2.2rem;
            color: #2563eb;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .form-label {
            font-weight: 500;
        }
        .btn-submit {
            background: #22c55e;
            border: none;
        }
        .btn-submit:hover {
            background: #16a34a;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="blog-form-card">
        <div class="form-title">Add New Blog</div>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" required placeholder="Enter blog title">
            </div>
            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content" rows="7" class="form-control" required placeholder="Write your blog content here..."></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Image (optional)</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-submit btn-lg">Submit Blog</button>
            </div>
        </form>
        <div class="mt-3 text-center">
            <a href="/PetSpot_clinic/public/blogs" class="btn btn-link">Back to Blogs</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<footer class="text-center">
    
  <?php include __DIR__ . '/../partials/footer.view.php'; ?>
</footer>