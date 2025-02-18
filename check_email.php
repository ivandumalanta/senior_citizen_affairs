<?php
include './database/db_connection.php';

if (isset($_POST['email'])) {
    $email = trim($_POST['email']); // Trim whitespace
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        echo ($stmt->num_rows > 0) ? "taken" : "available";

        $stmt->close();
    } else {
        echo "error"; // Handle SQL errors
    }
}

$conn->close();
?>
