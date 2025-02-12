<?php

include './database/db_connection.php';

// Query to fetch activities that are scheduled in the future (or current)
$sql = "SELECT * FROM activities ORDER BY activity_date ASC";
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
    <link rel="stylesheet" href="assets/css/activities.css"> 
    <link rel="stylesheet" href="assets/css/styleHome.css">
    <link rel="stylesheet" href="assets/css/banner.css">  <!-- Link to external CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
</head>

<body>
<nav class="navbar">
    <?php include './components/nav.php'; ?>
</nav>


<main>
<section>
<<<<<<< HEAD
    <div class="masthead" data-aos="fade-up">
 
  </div>
    </div>
        <div class="container" data-aos="fade-left">
=======
    <div class="masthead" >
 
  </div>
    </div>
        <div class="container ">
>>>>>>> 8eccebdcf9e512e252379c259a47eaee57446794
            <div class="row">
            <p class="acitivitybox">Latest Activities</p>
                <div class="col-sm-12">
            <div class="activitycontainer " style="margin-bottom: 80px;">
            <?php
        // Check if there are any activities in the result
        if (count($activities) > 0) {
            // Loop through the result set and display each activity
            echo "<ul class='activity-item'>";
            foreach ($activities as $row) {
                $activity_title = htmlspecialchars($row['title']); 
                $activity_date = strtotime($row['activity_date']);  // Convert to timestamp
        
                // Check if activity date is valid
                $formatted_date = ($activity_date) ? date('F j, Y', $activity_date) : 'Invalid Date';
                // Display the activity item
                echo "<br>";
                echo "<li style='color: black;'>$formatted_date - <a href='view_activity.php?id=" . htmlspecialchars($row['id'] ?? '') . "'>$activity_title</a></li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No upcoming activities found.</p>";
        }
        
        ?>
            </div>
                
                </div>
            </div>
        </div>











    

    
    </section>
</main>
<<<<<<< HEAD
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
=======
>>>>>>> 8eccebdcf9e512e252379c259a47eaee57446794
<?php include './components/footer.php'; ?>  
</body>
</html>
