<?php
// delete_news.php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    http_response_code(403);
    exit('Access denied');
}

include '.././database/db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM news WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    if ($stmt->execute()) {
        echo "Deleted";
    } else {
        http_response_code(500);
        echo "Error deleting news.";
    }
} else {
    http_response_code(400);
    echo "No ID provided.";
}
?>
