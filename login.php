<?php
session_start();

if (isset($_SESSION['loggedin']) &&  $_SESSION['loggedin'] == true) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h2>Login</h2>
    <form id="loginForm">
        <!-- Email field -->
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <!-- Password field -->
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <!-- Submit button -->
        <button type="submit">Login</button>
    </form>

    <script>
        // jQuery to intercept form submission
        $('#loginForm').submit(function(event) {
            event.preventDefault(); // Prevent the default form submission

            var username = $('#username').val();
            var password = $('#password').val();

            // Perform an AJAX request to submit the form data
            $.ajax({
                url: 'login-submit.php',  // The URL to submit the form to
                type: 'POST',
                data: {
                    username: username,
                    password: password
                },
                success: function(response) {
  
                    console.log(response);
                    window.location.href = 'dashboard.php'; 
                    alert(response);
                },
                error: function() {
                    // Handle errors
                    alert('An error occurred while submitting the form.');
                }
            });
        });
    </script>
</body>
</html>
