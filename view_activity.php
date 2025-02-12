<?php
// Include database connection
include './database/db_connection.php';

// Check if 'id' parameter is set and is a valid number
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid activity ID.");
}

$activity_id = $_GET['id'];

try {
    // Prepare and execute query to fetch activity details
    $sql = "SELECT * FROM activities WHERE id = :id LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $activity_id, PDO::PARAM_INT);
    $stmt->execute();
    $activity = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if activity exists
    if (!$activity) {
        die("Activity not found.");
    }
} catch (PDOException $e) {
    die("Error fetching activity: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($activity['title']); ?></title>
    <link rel="stylesheet" href="assets/css/activities.css">
    <link rel="stylesheet" href="assets/css/styleHome.css">
    <link rel="stylesheet" href="assets/css/banner.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<style>
    #image {
        height: 50vh;
        width: 60vw;
    }

</style>
<body>
<nav class="navbar">
    <?php include './components/nav.php'; ?>
</nav>

<main class="heromain">
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="activity-details">
                        <h2><b><?php echo htmlspecialchars($activity['title']); ?></b></h2>
                        <p><strong>Posted By:</strong> Admin</p>
                        <p><strong></strong> <?php echo date('F j, Y', strtotime($activity['activity_date'])); ?></p>
                        </div>
                        <img id="image" src="./<?php echo substr($activity['image_path'], 1); ?>" alt="" >

                        <p><strong></strong> <?php echo $activity['content']; ?></p>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include './components/footer.php'; ?>
</body>
</html>
