<?php
include '.././database/db_connection.php';
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

    // Fetch user details
    $sql = "SELECT * FROM users WHERE osca_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_STR);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        die("User not found.");
    }

    // Fetch user documents
    $sqlDocs = "SELECT * FROM user_documents WHERE id = :id";
    $stmtDocs = $pdo->prepare($sqlDocs);
    $stmtDocs->bindValue(':id', $id, PDO::PARAM_STR);
    $stmtDocs->execute();

    $documents = $stmtDocs->fetchAll(PDO::FETCH_ASSOC);

    // Check if "Approve" button was clicked
    if (isset($_POST['approve'])) {
        // Update the user's status to "approved"
        $updateSql = "UPDATE users SET status = 'approved' WHERE osca_id = :id";
        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->bindValue(':id', $id, PDO::PARAM_STR);
        $updateStmt->execute();

        // Redirect to the same page to reflect the change
        header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $id);
        exit;
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar">
    <?php include '.././components/admin-nav.php'; ?>
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
        <th>1x1 ID</th>
        <td>
            <img src=".././<?php echo htmlspecialchars($user['oneByOne_id_path']); ?>" alt="ID Image" width="200" height="200">
        </td>
    </tr>
    <tr>
        <th>Status</th>
        <td><?php echo htmlspecialchars($user['status']); ?></td>
    </tr>
    </table>

    <h2>User Documents</h2>
    <?php if ($documents): ?>
        <?php foreach ($documents as $doc): ?>
            <img src=".././<?php echo htmlspecialchars($doc['signature_id']); ?>" alt="ID Image" width="200" height="200">
 
            <?php
            // Decode the JSON data for documents_path
            $documentPaths = json_decode($doc['documents_path'], true);
            if (is_array($documentPaths)):
            ?>
                <div>
                    <?php foreach ($documentPaths as $path): ?>
                        <img src=".././<?php echo htmlspecialchars($path); ?>" alt="Document Image" width="200" height="200">
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No documents found for this user.</p>
    <?php endif; ?>

    <!-- Approve Button Form -->
    <?php if ($user['status'] != 'approved'): ?>
        <form method="POST" action="">
            <button type="submit" name="approve">Approve</button>
        </form>
    <?php else: ?>
        <p>User is already approved.</p>
    <?php endif; ?>

    <a href="applicants.php">Back to List</a>
</body>
</html>
