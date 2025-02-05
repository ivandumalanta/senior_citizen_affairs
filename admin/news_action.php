<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

include '../database/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Get form data
        $id = isset($_POST['id']) ? $_POST['id'] : '';
        $title = trim($_POST['title']);
        $date = trim($_POST['date']);
        $content = trim($_POST['content']);
        $author = trim($_POST['author']); // New author field
        $imagePath = ''; // Default empty
        $headline = isset($_POST['headline']) ? $_POST['headline'] : 0; // Default to 0 (not headline)

        // Check if a new image is uploaded
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $allowed_types = ['image/jpeg', 'image/png'];
            $file_name = $_FILES['image']['name'];
            $file_tmp_name = $_FILES['image']['tmp_name'];
            $file_size = $_FILES['image']['size'];
            $file_type = $_FILES['image']['type'];

            // Validate image type
            if (in_array($file_type, $allowed_types)) {
                if ($file_size <= 5000000) { // 5MB limit
                    $base_upload_dir = '../private/news-img/';
                    if (!is_dir($base_upload_dir)) {
                        mkdir($base_upload_dir, 0777, true);
                    }

                    $unique_file_name = uniqid('news_') . '.' . pathinfo($file_name, PATHINFO_EXTENSION);
                    $imagePath = $base_upload_dir . $unique_file_name;

                    if (!move_uploaded_file($file_tmp_name, $imagePath)) {
                        echo json_encode(['success' => false, 'message' => 'File upload failed']);
                        exit;
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => 'File size exceeds 5MB']);
                    exit;
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid file type']);
                exit;
            }
        } else {
            // No new image uploaded, get existing image path
            if ($id) {
                $stmt = $pdo->prepare("SELECT image_path FROM news WHERE id = :id");
                $stmt->execute([':id' => $id]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $imagePath = $result ? $result['image_path'] : ''; // Use existing image
            }
        }

        if ($headline == 1) {
            // If this news is marked as the headline, uncheck all other headlines
            $sql = "UPDATE news SET headline = 0 WHERE headline = 1";
            $pdo->prepare($sql)->execute();
        }

        if ($id) {
            // Update existing news entry
            $sql = "UPDATE news 
                    SET title = :title, news_date = :news_date, content = :content, image_path = :image_path, headline = :headline, author = :author
                    WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':title' => $title,
                ':news_date' => $date,
                ':content' => $content,
                ':image_path' => $imagePath,
                ':headline' => $headline,
                ':author' => $author,
                ':id' => $id
            ]);
        } else {
            // Insert new news entry
            $sql = "INSERT INTO news (title, news_date, content, image_path, headline, author) 
                    VALUES (:title, :news_date, :content, :image_path, :headline, :author)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':title' => $title,
                ':news_date' => $date,
                ':content' => $content,
                ':image_path' => $imagePath,
                ':headline' => $headline,
                ':author' => $author
            ]);
        }

        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
}
?>
