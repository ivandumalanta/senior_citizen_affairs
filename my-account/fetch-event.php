<?php
include '../database/db_connection.php';

$sql = "SELECT * FROM events";
$result = $conn->query($sql);

$events = [];

while ($row = $result->fetch_assoc()) {
    $events[] = [
        'id' => $row['id'],
        'title' => $row['title'],
        'start' => $row['start'],
        'end' => $row['end'],
        'request_type' => $row['request_type'],
        'status' =>$row['status'],
    ];
}

echo json_encode($events);
?>
