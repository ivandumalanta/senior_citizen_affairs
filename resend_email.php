<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';
include './database/db_connection.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';

    if (empty($email)) {
        echo json_encode([
            "status"  => "error",
            "message" => "Email is required."
        ]);
        exit();
    }

    // Query the user based on the email
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo json_encode([
            "status"  => "error",
            "message" => "Database error: " . $conn->error
        ]);
        exit();
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $user_id = $user['osca_id'];

        // Generate a new unique verification token and set expiry time (1 hour)
        $token = bin2hex(random_bytes(32));
        $expiry = date("Y-m-d H:i:s", strtotime("+1 hour"));

        // Store the token in the database (insert or update if it already exists)
        $insertToken = "INSERT INTO email_verifications (user_id, token, expires_at) VALUES (?, ?, ?)
                        ON DUPLICATE KEY UPDATE token = ?, expires_at = ?";
        $stmt = $conn->prepare($insertToken);
        if (!$stmt) {
            echo json_encode([
                "status"  => "error",
                "message" => "Database error: " . $conn->error
            ]);
            exit();
        }
        $stmt->bind_param("issss", $user_id, $token, $expiry, $token, $expiry);
        $stmt->execute();

        // Send the verification email using PHPMailer
        $mail = new PHPMailer(true);
        try {
            // SMTP Configuration
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'malasiquiosca@gmail.com';
            $mail->Password   = 'xtyolwosysfihqqa';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Sender and recipient settings
            $mail->setFrom('malasiquiosca@gmail.com', 'OSCA Malasiqui');
            $mail->addAddress($email);

            // Email content
            $verification_link = "http://127.0.0.1/senior11/senior_citizen_affairs/verify_email.php?token=$token";
            $mail->isHTML(true);
            $mail->Subject = "Email Verification";
            $mail->Body    = "Hello, <br><br> Please click the link below to verify your email:<br>
                              <a href='$verification_link'>$verification_link</a><br><br>
                              This link expires in 1 hour.";

            $mail->send();

            echo json_encode([
                "status"  => "success",
                "message" => "A new verification email has been sent."
            ]);
            exit();
        } catch (Exception $e) {
            echo json_encode([
                "status"  => "error",
                "message" => "Email could not be sent: " . $mail->ErrorInfo
            ]);
            exit();
        }
    } else {
        echo json_encode([
            "status"  => "error",
            "message" => "No user found with that email."
        ]);
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
