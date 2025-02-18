<?php
include '.././database/db_connection.php'; // Ensure correct path

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && isset($_POST['status'])) {
    $id = intval($_POST['id']);
    $status = $_POST['status'];

    if (!in_array($status, ['accepted', 'declined'])) {
        echo json_encode(["success" => false, "message" => "Invalid status value."]);
        exit();
    }

    $sql = "UPDATE events SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to update status."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request."]);
}
?>
