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
            WHERE status = 'pending' AND (last_name LIKE :search OR first_name LIKE :search)
            ORDER BY created_at ASC
            LIMIT :startLimit, :recordsPerPage";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':search', '%' . $searchQuery . '%', PDO::PARAM_STR);
    $stmt->bindValue(':startLimit', $startLimit, PDO::PARAM_INT);
    $stmt->bindValue(':recordsPerPage', $recordsPerPage, PDO::PARAM_INT);
    $stmt->execute();

    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Get total records for pagination
    $totalRecordsSql = "SELECT COUNT(*) FROM users WHERE status = 'pending' AND (last_name LIKE :search OR first_name LIKE :search)";
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
    <title>Pending Applicants</title>
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="./assets/applicants.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <nav class="sidebar">
        <?php include '.././components/admin-nav.php'; ?>
    </nav>

    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <h1><b>Pending Applicants</b></h1>
                <div class="col-sm-12 formapplicants">
                    <div class="flex">
                    <span><a href="approved_applicants.php" class="btn btn-primary   btn-sm spacingtop20">Approved Applicants</a></span>
                    <span><a href="declined_applicants.php" class="btn btn-danger btn-sm spacingtop20">Declined Applicants</a></span>
                        <!-- Search Form -->
                        <form action="" method="get" class="spacingtop20 ">
                            <div class="row searchflex">
                                <div class="col-sm-4">
                                <input type="text" name="search" value="<?php echo htmlspecialchars($searchQuery); ?>" class="form-control" placeholder="Search by Name...">
                                </div>
                                <div class="col-sm-8">
                                <button type="submit" class="btn btn-primary mt-2">Search</button>
                                </div>
                            </div>
                           

                        </form>
                    </div>
                  

                    <div class="table-responsive spacingtop20">
                        <table class="table  table-hover">
                            <thead>
                                <tr class="rowtable">
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
                                        <td colspan="7" class="text-center">No pending applicants found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination">
                        <!-- First Page Link -->
                        <?php if ($page > 1): ?>
                            <a href="?page=1&search=<?php echo htmlspecialchars($searchQuery); ?>" class="btn btn-primary">First</a>
                        <?php endif; ?>

                        <!-- Previous Page Link -->
                        <?php if ($page > 1): ?>
                            <a href="?page=<?php echo $page - 1; ?>&search=<?php echo htmlspecialchars($searchQuery); ?>" class="btn btn-primary">Previous</a>
                        <?php endif; ?>

                        <!-- Numeric Page Links -->
                        <?php
                        $range = 2; // Number of pages to show before and after the current page
                        $start = max(1, $page - $range);
                        $end = min($totalPages, $page + $range);

                        for ($i = $start; $i <= $end; $i++):
                        ?>
                            <a href="?page=<?php echo $i; ?>&search=<?php echo htmlspecialchars($searchQuery); ?>" class="btn btn-secondary <?php echo ($i == $page) ? 'active' : ''; ?>">
                                <?php echo $i; ?>
                            </a>
                        <?php endfor; ?>

                        <!-- Next Page Link -->
                        <?php if ($page < $totalPages): ?>
                            <a href="?page=<?php echo $page + 1; ?>&search=<?php echo htmlspecialchars($searchQuery); ?>" class="btn btn-primary">Next</a>
                        <?php endif; ?>

                        <!-- Last Page Link -->
                        <?php if ($page < $totalPages): ?>
                            <a href="?page=<?php echo $totalPages; ?>&search=<?php echo htmlspecialchars($searchQuery); ?>" class="btn btn-primary">Last</a>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </div> <!-- end main -->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>
</html>
