<?php
include '.././database/db_connection.php';
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'year';

$query = "";
if ($filter == 'year') {
    // If the filter is year, we summarize data by year.
    $query = "SELECT YEAR(created_at) AS period, 
                     SUM(CASE WHEN sex = 'Female' THEN 1 ELSE 0 END) AS female_count,
                     SUM(CASE WHEN sex = 'Male' THEN 1 ELSE 0 END) AS male_count
              FROM users 
              GROUP BY period 
              ORDER BY period DESC";  // Order by year descending
} elseif ($filter == 'month') {
    $query = "SELECT DATE(created_at) AS period, 
                     SUM(CASE WHEN sex = 'Female' THEN 1 ELSE 0 END) AS female_count,
                     SUM(CASE WHEN sex = 'Male' THEN 1 ELSE 0 END) AS male_count
              FROM users 
              WHERE YEAR(created_at) = YEAR(CURDATE()) AND MONTH(created_at) = MONTH(CURDATE())
              GROUP BY period 
              ORDER BY period";
} elseif ($filter == 'today') {
    $query = "SELECT DATE_FORMAT(created_at, '%H:%i') AS period, 
                     SUM(CASE WHEN sex = 'Female' THEN 1 ELSE 0 END) AS female_count,
                     SUM(CASE WHEN sex = 'Male' THEN 1 ELSE 0 END) AS male_count
              FROM users 
              WHERE DATE(created_at) = CURDATE()
              GROUP BY period 
              ORDER BY period";
}

$result = $conn->query($query);

$labels = [];
$femaleRatings = [];
$maleRatings = [];

while ($row = $result->fetch_assoc()) {
    $labels[] = $row['period'];
    $femaleRatings[] = $row['female_count'];
    $maleRatings[] = $row['male_count'];
}

header('Content-Type: application/json');
echo json_encode(['labels' => $labels, 'femaleRatings' => $femaleRatings, 'maleRatings' => $maleRatings]);
?>
