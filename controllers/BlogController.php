<?php
require_once __DIR__ . '/../models/Blog.php';

class BlogController
{
    public function index()
    {
        $blogModel = new Blog();
        // Fetch all confirmed blogs (both user and vet staff blogs)
        $blogs = $blogModel->findAll(['confirmed' => true]);
        include __DIR__ . '/../views/blogs/blogs.view.php';
    }

    public function add()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_ID'])) {
            die("You must be logged in to add a blog.");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imagePath = null;

            // Handle image upload
            if (!empty($_FILES['image']['name'])) {
                $targetDir = __DIR__ . '/../../public/uploads/';
                $imageName = time() . '_' . basename($_FILES['image']['name']);
                $targetFile = $targetDir . $imageName;

                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    $imagePath = '/PetSpot_clinic/public/uploads/' . $imageName;
                }
            }

            $data = [
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'created_at' => date('Y-m-d H:i:s'),
                'user_ID' => $_SESSION['user_ID'], // or however you store user id
                'confirmed' => false,
                'is_staff' => false,
                'image' => $imagePath,
            ];

            $blogModel = new Blog();
            $blogModel->insert($data);
            header("Location: /PetSpot_clinic/public/blogs");
            exit;
        }

        include __DIR__ . '/../views/blogs/add_blog.view.php';
    }
}