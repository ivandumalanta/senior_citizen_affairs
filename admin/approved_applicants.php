<?php
include '.././database/db_connection.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

try {
    $sql = "SELECT osca_id, last_name, first_name, middle_name, suffix, sex FROM users WHERE status = 'approved' ORDER BY created_at DESC";
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
    <title>Applicants</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar">
    <?php include '.././components/admin-nav.php'; ?>
    </nav>

    <h1>    Applicants</h1>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>OSCA ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Suffix</th>
                <th>Gender</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['osca_id']); ?></td>
                        <td><?php echo htmlspecialchars($user['last_name']); ?></td>
                        <td><?php echo htmlspecialchars($user['first_name']); ?></td>
                        <td><?php echo htmlspecialchars($user['middle_name'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($user['suffix']); ?></td>
                        <td><?php echo htmlspecialchars($user['sex']); ?></td>
                        <td>
                            <a href="view_user.php?id=<?php echo htmlspecialchars($user['osca_id']); ?>">View</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No pending applicants found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>