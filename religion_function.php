<?php
header('Content-Type: application/json');

// Include database connection file
include './database/db_connection.php';

// Query data grouped by sex
$query = "SELECT religion, COUNT(*) AS count FROM users GROUP BY religion";
$result = $conn->query($query);

$labels = [];
$data = [];
$totalCount = 0;

// Fetch and process data
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $labels[] = $row['religion'];
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
            "backgroundColor" => ["#ff9800", "rgb(0,255,255)", "rgb(194,128,255)","#03a9f4", "rgb(128,128,255)", "rgb(149,242,4)", "rgb(255,255,0)"], // Colors for Male and Female
            "hoverOffset" => 4
        ]
    ]
];

echo json_encode($response);

$conn->close();
?>
