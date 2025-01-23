<?php
// Start the session
session_start();

$_SESSION = [];

session_destroy();

header("Location: login.php");
exit;
?>
