<?php

include '../database/db_connection.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['token'];
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($new_password !== $confirm_password) {
        $message = "Passwords do not match!";
    } else {
        // Verify token
        $stmt = $pdo->prepare("SELECT user_id FROM reset_tokens WHERE token = ? AND expires_at > NOW()");
        $stmt->execute([$token]);
        $reset = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$reset) {
            $message = "Invalid or expired token!";
        } else {
       
            $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE osca_id= ?");
            if ($stmt->execute([$new_password, $reset['user_id']])) {
                // Delete used token
                $stmt = $pdo->prepare("DELETE FROM reset_tokens WHERE token = ?");
                $stmt->execute([$token]);

                $message = "Password updated successfully. Redirecting to login...";
                echo "<script>setTimeout(function(){ window.location.href = 'login.php'; }, 2000);</script>";
            } else {
                $message = "Failed to update password.";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .error-message {
            color: red;
            font-size: 14px;
        }
        .container {
            max-width: 400px;
            margin-top: 50px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center">Reset Password</h2>
    
    <?php if (!empty($message)) : ?>
        <div class="alert alert-info"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="POST" id="resetPasswordForm">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">

        <div class="form-group">
            <label>New Password:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Confirm Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
            <div id="passwordError" class="error-message"></div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Update Password</button>
    </form>
</div>

<script>
    $(document).ready(function () {
        $('#confirm_password').on('keyup', function () {
            let password = $('#password').val();
            let confirmPassword = $('#confirm_password').val();

            if (password !== confirmPassword) {
                $('#passwordError').text("Passwords do not match!");
            } else {
                $('#passwordError').text("");
            }
        });
    });
</script>

</body>
</html>
