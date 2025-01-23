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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar">
    <?php include '.././components/admin-nav.php'; ?>
    </nav>

    <h1>Notifications</h1>

    <ul>
        <?php foreach ($users as $user): ?>
            <li>
                <?php if (isset($user['osca_id'])): ?>
                    <a href="view_user.php?id=<?php echo htmlspecialchars($user['osca_id']); ?>">
                        <strong>New User Registration Request</strong> - <?php echo timeAgo($user['created_at']); ?>
                    </a>
                <?php else: ?>
                    <strong>New User Registration Request</strong> - <?php echo timeAgo($user['created_at']); ?>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
