<?php
$email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Confirmation Sent</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row min-vh-100 justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body text-center p-5">
                        <i class="bi bi-envelope-check text-success display-1 mb-4"></i>
                        <h1 class="card-title mb-3">Check Your Email</h1>
                        <p class="card-text mb-4">
                            We've sent a confirmation email to: <strong><?php echo $email; ?></strong><br>
                            Please click the link in the email to verify your account.
                        </p>
                        <button class="btn btn-primary btn-lg w-100 mb-3">Resend Email</button>
                        <p class="text-muted small">
                            Didn't receive the email? Check your spam folder or try resending.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS (optional, only needed if you require Bootstrap's JavaScript features) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>