<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';
include './database/db_connection.php';

function sanitize_input($data) {
    return htmlspecialchars(trim($data));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $last_name = sanitize_input($_POST['last_name']);
    $first_name = sanitize_input($_POST['first_name']);
    $middle_name = isset($_POST['no_middlename']) ? NULL : sanitize_input($_POST['middle_name'] ?? '');

    $month = sanitize_input($_POST['month']);
    $date = sanitize_input($_POST['date']);
    $year = sanitize_input($_POST['year']);
    $suffix = isset($_POST['suffix']) ? sanitize_input($_POST['suffix']) : '';

    $birthday = "$year-$month-$date";

    $sql = "SELECT * FROM users WHERE last_name = ? AND first_name = ? AND middle_name = ? AND birth_day = ? AND suffix = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $last_name, $first_name, $middle_name, $birthday, $suffix);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $email = $user['email']; 
        $user_id = $user['osca_id'];

        // Generate a unique verification token
        $token = bin2hex(random_bytes(32));
        $expiry = date("Y-m-d H:i:s", strtotime("+1 hour"));

        // Store the token in the database
        $insertToken = "INSERT INTO email_verifications (user_id, token, expires_at) VALUES (?, ?, ?) 
                        ON DUPLICATE KEY UPDATE token = ?, expires_at = ?";
        $stmt = $conn->prepare($insertToken);
        $stmt->bind_param("issss", $user_id, $token, $expiry, $token, $expiry);
        $stmt->execute();

        // Send email
        $mail = new PHPMailer(true);
        try {
          // SMTP Configuration
          $mail->isSMTP();
          $mail->Host = 'smtp.gmail.com';
          $mail->SMTPAuth = true;
          $mail->Username = 'malasiquiosca@gmail.com';
          $mail->Password = 'rnlrjjxlejjxlkwe'; 
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
          $mail->Port = 587;
            

            // Sender and recipient settings
            $mail->setFrom('malasiquiosca@gmail.com', 'OSCA Malasiqui');
            $mail->addAddress($email);

            // Email content
            $verification_link = "http://127.0.0.1/senior6/senior_citizen_affairs/verify_email.php?token=$token";
            $mail->isHTML(true);
            $mail->Subject = "Email Verification";
            $mail->Body    = "Hello, <br><br> Please click the link below to verify your email:<br>
                              <a href='$verification_link'>$verification_link</a> <br><br>
                              This link expires in 1 hour.";

            $mail->send();

            // Redirect user
            header("Location: email_confirmation.php?email=" . urlencode($email));
            exit();
        } catch (Exception $e) {
            echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "No matching record found.";
    }

    $stmt->close();
    $conn->close();
}
?>
