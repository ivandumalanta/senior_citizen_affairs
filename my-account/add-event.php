<?php
include '../database/db_connection.php';

if (isset($_POST['title']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['request_type'])) {
    $title = $_POST['title'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $request_type = $_POST['request_type'];

    $sql = "INSERT INTO events (title, start, end, request_type, status) VALUES ('$title', '$start', '$end', '$request_type', 'pending')";
    
    if ($conn->query($sql)) {
        echo "Success";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
