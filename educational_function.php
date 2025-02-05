<?php
header('Content-Type: application/json');

// Database connection
include './database/db_connection.php';

// Correct the query to count member statuses
$query = "SELECT education, COUNT(*) as count FROM users GROUP BY education";
$result = $conn->query($query);

$labels = [];
$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $labels[] = $row['education']; // Use `member_status` column
        $data[] = (int)$row['count'];
    }
}

// Prepare JSON response
$response = [
    "labels" => $labels,
    "datasets" => [
        [
            "label" => "Ratings",
            "data" => $data,
            "borderColor" => "blue",
            "borderWidth" => 2,
            "fill" => false,
            "tension" => 0.1
        ]
    ]
];

echo json_encode($response);
$conn->close();
?>
