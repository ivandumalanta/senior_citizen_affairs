<?php
header('Content-Type: application/json');

// Include database connection file
include './database/db_connection.php';

// Query data grouped by sex
$query = "SELECT classification, COUNT(*) AS count FROM users GROUP BY classification";
$result = $conn->query($query);

$labels = [];
$data = [];
$totalCount = 0;

// Fetch and process data
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $labels[] = $row['classification'];
        $data[] = $row['count'];
        $totalCount += $row['count'];
    }
}

// Calculate percentages
$dataPercentages = array_map(function ($value) use ($totalCount) {
    return round(($value / $totalCount) * 100, 1);
}, $data);

// Combine counts and percentages for display labels
$displayLabels = [];
foreach ($labels as $index => $label) {
    $displayLabels[] = $label . " (" . $data[$index] . ", " . $dataPercentages[$index] . "%)";
}

// Prepare JSON response
$response = [
    "labels" => $displayLabels, // Labels with counts and percentages
    "datasets" => [
        [
            "data" => $data, // Original count values for chart
            "backgroundColor" => ["#4caf50", "#03a9f4", "#ff9800"], // Colors for classificcations
            "hoverOffset" => 4
        ]
    ]
];

echo json_encode($response);

$conn->close();
?>
