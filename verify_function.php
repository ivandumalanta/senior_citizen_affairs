<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';
include './database/db_connection.php';

// Set header to JSON so the AJAX call can parse the response
header('Content-Type: application/json');

function sanitize_input($data) {
    return htmlspecialchars(trim($data));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $last_name  = sanitize_input($_POST['last_name']);
    $first_name = sanitize_input($_POST['first_name']);
    // Set to NULL if "no middlename" is checked
    $middle_name = isset($_POST['no_middlename']) ? NULL : sanitize_input($_POST['middle_name'] ?? '');

    $month  = sanitize_input($_POST['month']);
    $date   = sanitize_input($_POST['date']);
    $year   = sanitize_input($_POST['year']);
    $suffix = isset($_POST['suffix']) ? sanitize_input($_POST['suffix']) : '';

    // Format birthday as YYYY-MM-DD (with proper zero-padding)
    $birthday = sprintf('%04d-%02d-%02d', $year, $month, $date);

    if (is_null($middle_name)) {
        $sql = "SELECT * FROM users 
                WHERE last_name = ? 
                  AND first_name = ? 
                  AND middle_name IS NULL 
                  AND birth_day = ? 
                  AND suffix = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            echo json_encode(["status" => "error", "message" => "Prepare failed: " . $conn->error]);
            exit();
        }
        $stmt->bind_param("ssss", $last_name, $first_name, $birthday, $suffix);
    } else {
        $sql = "SELECT * FROM users 
                WHERE last_name = ? 
                  AND first_name = ? 
                  AND middle_name = ? 
                  AND birth_day = ? 
                  AND suffix = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            echo json_encode(["status" => "error", "message" => "Prepare failed: " . $conn->error]);
            exit();
        }
        $stmt->bind_param("sssss", $last_name, $first_name, $middle_name, $birthday, $suffix);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $email = $user['email'];
        $user_id = $user['osca_id'];

        // Generate a unique verification token and set expiry time
        $token = bin2hex(random_bytes(32));
        $expiry = date("Y-m-d H:i:s", strtotime("+1 hour"));

        // Store the token in the database (using ON DUPLICATE KEY UPDATE)
        $insertToken = "INSERT INTO email_verifications (user_id, token, expires_at) VALUES (?, ?, ?)
                        ON DUPLICATE KEY UPDATE token = ?, expires_at = ?";
        $stmt = $conn->prepare($insertToken);
        if (!$stmt) {
            echo json_encode(["status" => "error", "message" => "Prepare failed: " . $conn->error]);
            exit();
        }
        $stmt->bind_param("issss", $user_id, $token, $expiry, $token, $expiry);
        $stmt->execute();

        // Send email with PHPMailer
        $mail = new PHPMailer(true);
        try {
            // SMTP configuration
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
                              <a href='$verification_link'>$verification_link</a> <br><br>
                              This link expires in 1 hour.";

            $mail->send();

            // Instead of redirecting from PHP, send back a JSON response with the URL for redirection.
            echo json_encode([
                "status" => "success",
                "email"  => $email
            ]);
            exit();
        } catch (Exception $e) {
            echo json_encode([
                "status"  => "error", 
                "message" => "Email could not be sent. Mailer Error: {$mail->ErrorInfo}"
            ]);
            exit();
        }
    } else {
        echo json_encode(["status" => "error", "message" => "No matching record found."]);
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
