<?php
include '../database/db_connection.php';
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM events WHERE id=$id";
    
    if ($conn->query($sql)) {
        echo "Deleted";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
