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

        <a href="applicants.php" class="btn btn-danger">Back to List</a>
        <h1><b>View User Details</b></h1>
        <div class="container-fluid">
            <div class="row"> 
                <div class="col-sm-12 formapplicants" style="font-size: 20px;">


                    <form class="form spacingtop20 ">
                        <!-- OSCA ID -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">OSCA ID:</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?php echo htmlspecialchars($user['osca_id']); ?></p>
                            </div>
                        </div>
                        <!-- Last Name -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Last Name:</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?php echo htmlspecialchars($user['last_name']); ?></p>
                            </div>
                        </div>
                        <!-- First Name -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">First Name:</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?php echo htmlspecialchars($user['first_name']); ?></p>
                            </div>
                        </div>
                        <!-- Middle Name -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Middle Name:</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?php echo htmlspecialchars($user['middle_name'] ?? 'N/A'); ?></p>
                            </div>
                        </div>
                        <!-- Suffix -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Suffix:</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?php echo htmlspecialchars($user['suffix']); ?></p>
                            </div>
                        </div>
                        <!-- Gender -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Gender:</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?php echo htmlspecialchars($user['sex']); ?></p>
                            </div>
                        </div>
                        <!-- Birth Date -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Birth Date:</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?php echo htmlspecialchars($user['birth_day']); ?></p>
                            </div>
                        </div>
                        <!-- Address -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Address:</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?php echo htmlspecialchars($user['address']); ?></p>
                            </div>
                        </div>
                        <!-- Phone Number -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Phone Number:</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?php echo htmlspecialchars($user['phone_number']); ?></p>
                            </div>
                        </div>
                        <!-- 1x1 ID -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">1x1 ID:</label>
                            <div class="col-sm-9">
                                <img src=".././<?php echo htmlspecialchars($user['oneByOne_id_path']); ?>" alt="ID Image" class="img-thumbnail" width="200" height="200">
                            </div>
                        </div>
                        <!-- Status -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Status: </label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?php echo htmlspecialchars($user['status']); ?></p>
                            </div>
                        </div>
                    </form>


            </div>


        </div>
        <div class="row">
            <h2>User Documents</h2>
            <div class="col-sm-12 formapplicants ">
                <div class="documents spacingtop20">
                    <?php if ($documents): ?>
                        <?php foreach ($documents as $doc): ?>
                            <img src=".././<?php echo htmlspecialchars($doc['signature_id']); ?>" alt="Signature" class="img-thumbnail" width="200" height="200">

                            <?php
                            // Decode the JSON data for documents_path
                            $documentPaths = json_decode($doc['documents_path'], true);
                            if (is_array($documentPaths)):
                            ?>
                                <div class="document-images">
                                    <?php foreach ($documentPaths as $path): ?>
                                        <img src=".././<?php echo htmlspecialchars($path); ?>" alt="Document Image" class="img-thumbnail" width="200" height="200">
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-warning">No documents found for this user.</p>
                    <?php endif; ?>
                </div>
                <br>

                <!-- Approve Button Form -->
                <?php if ($user['status'] != 'approved'): ?>
                    <form method="POST" action="" class="form-inline">
                        <button type="submit" name="approve" class="btn btn-success">Approve</button>
                    </form>
                <?php else: ?>
                    <p class="text-success">User is already approved.</p>
                <?php endif; ?>
                <br>
            </div>
        </div>

    </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>

</html> 