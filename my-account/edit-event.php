<?php
include '../database/db_connection.php';

if (isset($_POST['id']) && isset($_POST['title']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['request_type'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $request_type = $_POST['request_type'];

    $sql = "UPDATE events SET title='$title', start='$start', end='$end', request_type='$request_type' WHERE id=$id";
    
    if ($conn->query($sql)) {
        echo "Updated";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
