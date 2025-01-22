<?php
$host = '127.0.0.1';
$port = '3306';
$username = 'root';
$password = ''; 
$dbname = 'senior_citizen_affairs'; 

// Update MySQLi connection
$conn = new mysqli($host, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

try {
    // Update PDO connection
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle connection error
    die("Connection failed: " . $e->getMessage());
}

$conn->close();
?>
