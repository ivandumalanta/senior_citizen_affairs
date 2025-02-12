<?php
session_start();
if (isset($_SESSION['osca_id'])) {
    header("Location: chat.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="./asssets/css/login.css"> <!-- Link to external CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<section id="login">
        <div class="container-fluid login-container">

            <div class="row loginrow">
                <div class="col-sm-6 logo-container ">
                    <img src="https://www.oscaportal.com/logo/logo.png" alt="logo" class="logoimg">
                    <p><b>Office of Senior Citizen Affairs <br> Malasiqui</b></p>
                </div>
                <div class="col-sm-6 login-form text-center">

                    <form id="loginForm" class="loginbox">

                        <input type="text" id="username" name="username" class="userdesign" placeholder="Username" required><br><br>
                        <input type="password" id="password" name="password" class="passworddesign" placeholder="Password"><br><br>
                      
                        <button type="submit" class="spacingtop login-btn ">Login</button><br><br>
                        <a href="forgot_password.php" class="font16">Forgot Password?</a> 
                        
                    </form>
                    <p id="message" style="color: red;"></p> <!-- Error message container -->
                </div>
            </div>
        </div>

    </section>
    <script>
        $(document).ready(function(){
            $("#loginForm").submit(function(event){
                event.preventDefault(); // Prevent page reload
                
                var formData = {
                    username: $("#username").val(),
                    password: $("#password").val()
                };

                $.ajax({
                    type: "POST",
                    url: "login_submit.php",
                    data: formData,
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            window.location.href = "index.php"; // Redirect on success
                        } else {
                            $("#message").text(response.message); // Show error message
                        }
                    }
                });
            });
        });
    </script>

</body>
</html>
