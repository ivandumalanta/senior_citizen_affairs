<?php
include '.././database/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $date = $_POST['date'];

    if ($id) {
        $sql = "UPDATE activities SET title = :title, date = :date WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id, 'title' => $title, 'date' => $date]);
    } else {
        $sql = "INSERT INTO activities (title, date) VALUES (:title, :date)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['title' => $title, 'date' => $date]);
    }

    echo 'success';
}
?>
