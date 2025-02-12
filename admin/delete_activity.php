<?php
include '../database/db_connection.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ensure ID is an integer
    
    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM activities WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Activity deleted successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to delete activity."]);
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
?>
