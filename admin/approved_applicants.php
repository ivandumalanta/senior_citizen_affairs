<?php
include '.././database/db_connection.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Get the search query if exists
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Define how many records per page
$recordsPerPage = 10;

// Get the current page number, default is 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$startLimit = ($page - 1) * $recordsPerPage;

try {
    // Search and Pagination Query
    $sql = "SELECT osca_id, last_name, first_name, middle_name, suffix, sex
            FROM users
            WHERE status = 'approved' AND (last_name LIKE :search OR first_name LIKE :search)
            ORDER BY created_at DESC
            LIMIT :startLimit, :recordsPerPage";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':search', '%' . $searchQuery . '%', PDO::PARAM_STR);
    $stmt->bindValue(':startLimit', $startLimit, PDO::PARAM_INT);
    $stmt->bindValue(':recordsPerPage', $recordsPerPage, PDO::PARAM_INT);
    $stmt->execute();

    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Get total records for pagination
    $totalRecordsSql = "SELECT COUNT(*) FROM users WHERE status = 'approved' AND (last_name LIKE :search OR first_name LIKE :search)";
    $totalRecordsStmt = $pdo->prepare($totalRecordsSql);
    $totalRecordsStmt->bindValue(':search', '%' . $searchQuery . '%', PDO::PARAM_STR);
    $totalRecordsStmt->execute();
    $totalRecords = $totalRecordsStmt->fetchColumn();

    // Calculate total pages
    $totalPages = ceil($totalRecords / $recordsPerPage);
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
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="./assets/applicants.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <nav class="sidebar">
        <?php include '.././components/admin-nav.php'; ?>
    </nav>
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 formapplicants">
                    <h1><b>Applicants</b></h1>
                    <form method="GET" action="">
                        <div class="row searchflex">
                            <div class="col-sm-4">
                            <input type="text" name="search" class="form-control" value="<?php echo htmlspecialchars($searchQuery); ?>" placeholder="Search by name">
                            </div>
                            <div class="col-sm-8">
                   
                            <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>

                    </form>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
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
                                                <a href="view_user.php?id=<?php echo htmlspecialchars($user['osca_id']); ?>" class="btn btn-info btn-sm">View</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center">No approved applicants found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <nav>
                        <ul class="pagination">
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                    <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo htmlspecialchars($searchQuery); ?>">
                                        <?php echo $i; ?>
                                    </a>
                                </li>
                            <?php endfor; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>

</html>