<?php
require_once __DIR__ . '/../../models/Blog.php';

class VetStaffBlogController
{
    public function index()
    {
        // Only staff can access this page
        if (empty($_SESSION['staff_id'])) {
            die("Access denied. Only staff can view blogs.");
        }

        $blogModel = new Blog();
        $blogs = $blogModel->findAll(); // Fetch all blogs
        include __DIR__ . '/../../views/vetstaff/vblogs.view.php';
    }

    public function add()
    {
        // Only staff can access this page
        if (empty($_SESSION['staff_id'])) {
            die("Access denied. Only staff can add blogs.");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imagePath = null;

            // Handle image upload
            if (!empty($_FILES['image']['name'])) {
                $targetDir = __DIR__ . '/../../public/uploads/';
                $imageName = time() . '_' . basename($_FILES['image']['name']);
                $targetFile = $targetDir . $imageName;

                // Ensure the uploads directory exists
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                // Move the uploaded file
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    $imagePath = '/PetSpot_clinic/public/uploads/' . $imageName;
                } else {
                    $imagePath = null; // Handle upload failure
                }
            }

            $data = [
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'created_at' => date('Y-m-d H:i:s'),
                'is_staff' => true, // Mark as staff blog
                'confirmed' => true, // Staff blogs are automatically confirmed
                'user_ID' => NULL, // Set user_ID to NULL for vet staff blogs
                'image' => $imagePath, // Save the image path
            ];

            $blogModel = new Blog();
            $blogModel->insert($data); // Save the blog
            header("Location: /PetSpot_clinic/public/vetstaff/blogs");
            exit;
        }

        include __DIR__ . '/../../views/vetstaff/add_blog.view.php'; // Show add form
    }

    public function edit()
    {
        // Only staff can access this page
        if (empty($_SESSION['staff_id'])) {
            die("Access denied. Only staff can edit blogs.");
        }

        $blogModel = new Blog();
        $blog_ID = $_GET['blog_ID'] ?? null;
        if (!$blog_ID) {
            die("No blog ID provided.");
        }

        $blog = $blogModel->first(['id' => $blog_ID]);
        if (!$blog) {
            die("Blog not found.");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imagePath = $blog->image;

            // Handle image upload
            if (!empty($_FILES['image']['name'])) {
                $targetDir = __DIR__ . '/../../public/uploads/';
                $imageName = time() . '_' . basename($_FILES['image']['name']);
                $targetFile = $targetDir . $imageName;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    $imagePath = '/PetSpot_clinic/public/uploads/' . $imageName;
                }
            }

            $data = [
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'image' => $imagePath,
                'updated_at' => date('Y-m-d H:i:s'), // Set the updated timestamp
            ];

            $blogModel->update($blog_ID, $data);
            header("Location: /PetSpot_clinic/public/vetstaff/blogs");
            exit;
        }

        include __DIR__ . '/../../views/vetstaff/edit_blog.view.php'; // Show edit form
    }

    public function delete()
    {
        // Only staff can access this page
        if (empty($_SESSION['staff_id'])) {
            die("Access denied. Only staff can delete blogs.");
        }

        $blogModel = new Blog();
        $blog_ID = $_GET['blog_ID'] ?? null;
        if (!$blog_ID) {
            die("No blog ID provided.");
        }

        $blogModel->delete($blog_ID); // Delete the blog
        header("Location: /PetSpot_clinic/public/vetstaff/blogs");
        exit;
    }

    public function confirm()
    {
        if (empty($_SESSION['staff_id'])) {
            die("Access denied. Only staff can confirm blogs.");
        }

        $blogModel = new Blog();
        $blog_ID = $_GET['blog_ID'] ?? null;
        if (!$blog_ID) {
            die("No blog ID provided.");
        }

        $blog = $blogModel->first(['id' => $blog_ID]);
        if (!$blog) {
            die("Blog not found.");
        }

        // Toggle confirmed status
        $newStatus = $blog->confirmed ? 0 : 1;
        $blogModel->update($blog_ID, ['confirmed' => $newStatus]);
        header("Location: /PetSpot_clinic/public/vetstaff/blogs");
        exit;
    }
}