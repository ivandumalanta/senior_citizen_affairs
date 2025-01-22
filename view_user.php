<?php
include './database/db_connection.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid user ID.");
}

try {
    $id = $_GET['id'];

    $sql = "SELECT * FROM users WHERE osca_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_STR);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        die("User not found.");
    }
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User</title>
</head>
<body>
    <nav class="navbar">
        <?php include './components/admin-nav.php'; ?>
    </nav>

    <h1>View User Details</h1>
    <table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>OSCA ID</th>
        <td><?php echo htmlspecialchars($user['osca_id']); ?></td>
    </tr>
    <tr>
        <th>Last Name</th>
        <td><?php echo htmlspecialchars($user['last_name']); ?></td>
    </tr>
    <tr>
        <th>First Name</th>
        <td><?php echo htmlspecialchars($user['first_name']); ?></td>
    </tr>
    <tr>
        <th>Middle Name</th>
        <td><?php echo htmlspecialchars($user['middle_name'] ?? 'N/A'); ?></td>
    </tr>
    <tr>
        <th>Suffix</th>
        <td><?php echo htmlspecialchars($user['suffix']); ?></td>
    </tr>
    <tr>
        <th>Gender</th>
        <td><?php echo htmlspecialchars($user['sex']); ?></td>
    </tr>
    <tr>
        <th>Birth Date</th>
        <td><?php echo htmlspecialchars($user['birth_day']); ?></td>
    </tr>
    <tr>
        <th>Address</th>
        <td><?php echo htmlspecialchars($user['address']); ?></td>
    </tr>
    <tr>
        <th>Phone Number</th>
        <td><?php echo htmlspecialchars($user['phone_number']); ?></td>
    </tr>
    <tr>
        <th>ID Image</th>
        <td>
            <img src="<?php echo htmlspecialchars( $user['oneByOne_id_path']); ?>" alt="ID Image" width="200" height="200">
        </td>
    </tr>
    <tr>
        <th>Status</th>
        <td><?php echo htmlspecialchars($user['status']); ?></td>
    </tr>
</table>


    <a href="applicants.php">Back to List</a>
</body>
</html>
