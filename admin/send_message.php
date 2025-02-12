<?php
include '../database/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $sender_id = (int) $_POST['sender_id'];  // Convert to integer
    $receiver_id = (int) $_POST['receiver_id'];  // Convert to integer
    $message = trim($_POST['message']);  // Remove extra spaces

    if ($sender_id > 0 && $receiver_id > 0 && !empty($message)) {
        $stmt = $pdo->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
        $stmt->execute([$sender_id, $receiver_id, $message]);
    }
}

?>
