<?php
include '.././database/db_connection.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Set the correct timezone
date_default_timezone_set('Asia/Manila'); // Change to your timezone

function timeAgo($dateTime) {
    $currentDate = new DateTime();
    $createdAt = new DateTime($dateTime);
    $interval = $currentDate->diff($createdAt);

    if ($interval->y > 0) {
        return $interval->y . ' year' . ($interval->y > 1 ? 's' : '') . ' ago';
    }
    if ($interval->m > 0) {
        return $interval->m . ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
    }
    if ($interval->d > 0) {
        return $interval->d . ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
    }
    if ($interval->h > 0) {
        return $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
    }
    if ($interval->i > 0) {
        return $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') . ' ago';
    }
    return 'NOW';
}

try {
    $sql = "SELECT created_at, osca_id FROM users ORDER BY created_at DESC";
    $stmt = $pdo->query($sql);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New User Registration Requests</title>
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<nav class="navbar">
    <?php include '.././components/admin-nav.php'; ?>
    </nav>
<div class="main-content">
<div class="container">
        <h1 class="text-center">Notifications</h1>
        <div class="list-group">
            <?php foreach ($users as $user): ?>
                <a href="view_user.php?id=<?php echo htmlspecialchars($user['osca_id'] ?? ''); ?>" class="list-group-item">
                    <h4 class="list-group-item-heading">
                        <strong>New User Registration Request</strong>
                        <i class="bi bi-three-dots pull-right"></i> <!-- Icon aligned to the right -->
                    </h4>
                    <p class="list-group-item-text text-muted">
                        <?php echo timeAgo($user['created_at']); ?>
                    </p>
                </a>
            <?php endforeach; ?>
            <?php if (empty($users)): ?>
                <div class="alert alert-info text-center" role="alert">
                    <i class="bi bi-info-circle"></i> No new notifications at the moment.
                </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- end main -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
