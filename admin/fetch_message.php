<?php
session_start();
include '../database/db_connection.php';

$loggedInUserId = $_SESSION['osca_id']; // Logged-in user
$receiver_id = $_GET['receiver_id']; // Chat partner

// Prepare the SQL query
$stmt = $pdo->prepare("
    SELECT * FROM messages 
    WHERE (sender_id = :loggedInUserId AND receiver_id = :receiverId) 
       OR (sender_id = :receiverId AND receiver_id = :loggedInUserId) 
    ORDER BY timestamp ASC
");

$stmt->execute([
    'loggedInUserId' => $loggedInUserId,
    'receiverId' => $receiver_id
]);

$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Display messages
foreach ($messages as $message) {
    $class = ($message['sender_id'] == $loggedInUserId) ? "sent" : "received";
    echo "<div class='message $class'>" . htmlspecialchars($message['message']) . "</div>";
}
?>
