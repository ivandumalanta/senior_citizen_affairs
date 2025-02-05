<?php
// Include the database connection file
include './database/db_connection.php';

// Set header for JSON response
header('Content-Type: application/json');

try {
    // Example data fetching logic (modify as per your database schema)
    $query = "SELECT sex, COUNT(*) as count FROM users GROUP BY sex";
    $result = $conn->query($query);

    $labels = [];
    $data = [];

    while ($row = $result->fetch_assoc()) {
        $labels[] = $row['sex']; // Add the sex labels
        $data[] = $row['count']; // Add the counts
    }

    // Prepare response
    echo json_encode([
        'labels' => $labels,
        'datasets' => [
            [
                'label' => 'Sex Distribution',
                'data' => $data,
                'backgroundColor' => ['rgb(245,154,35)', 'rgb(2,167,240)', ],
            ],
        ],
    ]);
} catch (Exception $e) {
    // Handle errors gracefully
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
