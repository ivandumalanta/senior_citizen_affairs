<?php
session_start();
date_default_timezone_set('Asia/Manila');
include '../database/db_connection.php'; // Ensure correct path

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

$response = ["status" => "error", "message" => ""];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);

    // Check if email exists
    $stmt = $pdo->prepare("SELECT osca_id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        $response["message"] = "Email not found!";
        echo json_encode($response);
        exit;
    }

    // Generate a secure reset token
    $token = bin2hex(random_bytes(32));
    $expires_at = date("Y-m-d H:i:s", strtotime("+1 hour")); // Token valid for 1 hour

    // Insert token into database
    $stmt = $pdo->prepare("INSERT INTO reset_tokens (user_id, token, expires_at) VALUES (?, ?, ?)");
    $stmt->execute([$user['osca_id'], $token, $expires_at]);

    // Send reset email
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'malasiquiosca@gmail.com';
        $mail->Password = 'sddnilldbtwrrtll'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender and recipient settings
        $mail->setFrom('malasiquiosca@gmail.com', 'OSCA Malasiqui');
        $mail->addAddress($email);

        $resetLink = "http://127.0.0.1/senior9/senior_citizen_affairs/my-account/reset_password.php?token=$token";

        // Email content
        $mail->isHTML(true);
        $mail->Subject = "Password Reset Request";
        $mail->Body = "Click <a href='$resetLink'>here</a> to reset your password. This link will expire in 1 hour.";

        if ($mail->send()) {
            $_SESSION["reset"] = true;
            $response["status"] = "success";
            $response["message"] = "A reset link has been sent to your email.";
        } else {
            $response["message"] = "Error sending email.";
        }
    } catch (Exception $e) {
        $response["message"] = "Email sending failed: {$mail->ErrorInfo}";
    }
    echo json_encode($response);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="./asssets/css/login.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<section id="login">
    <div class="container-fluid login-container">
        <div class="row loginrow">
            <div class="col-sm-6 logo-container">
                <img src="https://www.oscaportal.com/logo/logo.png" alt="logo" class="logoimg">
                <p><b>Office of Senior Citizen Affairs <br> Malasiqui</b></p>
            </div>
            <div class="col-sm-6 login-form text-center">
                <form id="forgotPasswordForm" class="loginbox">
                    <h2>Forgot Password</h2>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required><br><br>

                    <!-- Response div -->
                    <div id="responseMessage" class="alert" style="display: none;"></div>

                    <button type="submit" id="sendButton" class="spacingtop login-btn">Send</button>
                </form>
                <br>
                <a href="login.php" class="font16">Back to Login</a>
            </div>
        </div>
    </div>
</section>

<script>
$(document).ready(function () {
    $("#forgotPasswordForm").submit(function (event) {
        event.preventDefault(); // Prevent page reload

        var $button = $("#sendButton");
        var originalText = $button.text();

        // Show loading effect
        $button.text("Processing...").addClass("loading").prop("disabled", true);
        $("#responseMessage").hide().removeClass("alert-success alert-danger");

        $.ajax({
            url: "",
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {
                $("#responseMessage")
                    .text(response.message)
                    .addClass(response.status === "success" ? "alert-success" : "alert-danger")
                    .show();
            },
            error: function () {
                $("#responseMessage").text("An unexpected error occurred.")
                    .addClass("alert-danger")
                    .show();
            },
            complete: function () {
                // Restore button state
                $button.text(originalText).removeClass("loading").prop("disabled", false);
            }
        });
    });
});
</script>

</body>
</html>
