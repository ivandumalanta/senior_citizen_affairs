<?php
session_start(); // Start the session to track user login status

include './database/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve submitted username (email) and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM admin_credentials WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Store user information in session upon successful login
        $_SESSION['loggedin'] = true;
        $_SESSION['user_id'] = $user['id']; // Store the user ID in session
        $_SESSION['username'] = $user['username']; // Store the username in session

        echo "Login successful!";
    } else {
        echo "Invalid credentials.";
    }
}

?>
