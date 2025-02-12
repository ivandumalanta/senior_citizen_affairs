<?php
session_start();

// Prevent unauthorized access
if (!isset($_SESSION['verified_user']) || !isset($_SESSION['user_id'])) {
    echo "Unauthorized access!";
    exit();
}

$user_id = $_SESSION['user_id'];

// Database connection
include './database/db_connection.php';

// Fetch user details securely
$sql = "SELECT * FROM users WHERE osca_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo "Welcome, " . htmlspecialchars($user['first_name']);
} else {
    echo "User not found!";
}

unset($_SESSION['verified_user']);
unset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    



</body>
</html>