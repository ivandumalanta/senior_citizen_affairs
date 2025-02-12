<?php
session_start();

include '.././database/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM admin_credentials WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user['username']; 
        $_SESSION['osca_id'] = $user['id'];
        $_SESSION['admin'] = true;
        echo "Login successful!";
    } else {
        echo "Invalid credentials.";
    }
}

?>
