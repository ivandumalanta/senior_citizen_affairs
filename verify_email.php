<?php
session_start();
include './database/db_connection.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verify token in the database
    $sql = "SELECT user_id, expires_at FROM email_verifications WHERE token = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $verification = $result->fetch_assoc();
        $user_id = $verification['user_id'];
        $expires_at = strtotime($verification['expires_at']);

        if (time() > $expires_at) {
            echo "Verification link has expired.";
            exit();
        } else {
            // Generate a secure session token
            $_SESSION['verified_user'] = bin2hex(random_bytes(32));
            $_SESSION['user_id'] = $user_id;

            // Delete token after use
            $deleteToken = "DELETE FROM email_verifications WHERE token = ?";
            $stmt = $conn->prepare($deleteToken);
            $stmt->bind_param("s", $token);
            $stmt->execute();

            // Redirect securely
            header("Location: info.php");
            exit();
        }
    } else {
        echo "Invalid verification link.";
        exit();
    }
} else {
    echo "No token provided.";
    exit();
}
?>
