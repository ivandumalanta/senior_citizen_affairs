<?php
session_start();

if (isset($_SESSION['loggedin']) &&  $_SESSION['loggedin'] == true) {
    header("Location: index.php");
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
    <link rel="stylesheet" href="./assets/login.css"> <!-- Link to external CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <section id="login">
        <div class="container-fluid login-container">

            <div class="row loginrow">
                <div class="col-sm-6 logo-container ">
                    <img src="./assets/logo2.png" alt="logo" class="logoimg">
                    <p><b>Office of Senior Citizen Affairs <br> Malasiqui</b></p>
                </div>
                <div class="col-sm-6 login-form text-center">

                    <form id="loginForm" class="loginbox">

                        <input type="text" id="username" name="username" class="userdesign" placeholder="Username" required><br><br>
                        <input type="password" id="password" name="password" class="passworddesign" placeholder="Password"><br><br>
<<<<<<< HEAD
                     
                        <button type="submit" class="spacingtop login-btn ">Login</button><br><br>
<<<<<<< HEAD
                       
=======
                        <a href="forgotpass.php" class="font16">Forgot Password?</a> 
=======
                        <a href="forgotpass.php" class="font16">Forgot Password?</a> <br><br>
                        <button type="submit" class="spacingtop login-btn ">Login</button>
>>>>>>> 8eccebdcf9e512e252379c259a47eaee57446794
>>>>>>> 053161d09d82855834f492af80b5d12eb10e59f6
                        
                    </form>
                </div>
            </div>
        </div>

    </section>


    <script>
        // jQuery to intercept form submission
        $('#loginForm').submit(function(event) {
            event.preventDefault();
            var username = $('#username').val();
            var password = $('#password').val();

            $.ajax({
                url: 'login-submit.php', // The URL to submit the form to
                type: 'POST',
                data: {
                    username: username,
                    password: password
                },
                success: function(response) {

                    console.log(response);
                    window.location.href = './index.php';
                    alert(response);
                },
                error: function() {
                    alert('An error occurred while submitting the form.');
                }
            });
        });
    </script>
</body>

</html>