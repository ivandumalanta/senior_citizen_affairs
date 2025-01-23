<?php

// Include database connection
include './database/db_connection.php';

// Query to fetch activities that are scheduled in the future (or current)
$sql = "SELECT * FROM activities WHERE activity_date >= CURDATE() ORDER BY activity_date ASC";
try {
    $stmt = $pdo->query($sql); // Execute the query
    $activities = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all the results
} catch (PDOException $e) {
    die("Error executing query: " . $e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activities</title>
    <link rel="stylesheet" href="assets/css/style.css"> <!-- Link to external CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar">
    <?php include './components/nav.php'; ?>
</nav>

<main>
    <h2>Latest Activities</h2>
    <section>
        <?php
        // Check if there are any activities in the result
        if (count($activities) > 0) {
            // Loop through the result set and display each activity
            foreach ($activities as $row) {
                $activity_title = htmlspecialchars($row['title']);  // Sanitize the title
                $activity_date = strtotime($row['activity_date']);  // Convert to timestamp
               // Sanitize the description

                // Check if activity date is valid
                $formatted_date = ($activity_date) ? date('F j, Y', $activity_date) : 'Invalid Date';

                // Display the activity item
                echo "<div class='activity-item'>";
                echo "<p>$formatted_date <span>$activity_title</span></p>";
                echo "</div>";
            }
        } else {
            echo "<p>No upcoming activities found.</p>";
        }
        ?>
    </section>
</main>

</body>
</html>
