<?php
session_start();
include '../database/db_connection.php';

if (!isset($_SESSION['osca_id'])) {
    header("Location: login.php");
    exit();
}

$loggedInUserId = $_SESSION['osca_id'];


$adminId =  2; // Default to 1 if no admin found
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Chat</title>
    <link rel="stylesheet" href="./asssets/css/sidenav.css">
    <link rel="stylesheet" href="./asssets/css/chat.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
</head>

<body>

    <nav class="sidebar">
        <?php include '.././components/user-nav.php'; ?>
    </nav>
    <div class="main-content">
   
        <div class="container">
            <div class="row ">

                <div class="chat-container">
                <h2><b>Chat Overview</b></h2>
                    <h3>Chat with Admin</h3>
                    <div class="messages"></div>
                    <div class="row-textbtn">
                    <textarea id="message"  class="form-control " placeholder="Type a message..."></textarea>
                    <button id="sendMessage"  class="btnbutton">Send</button>
                    </div>

                </div>
            </div>
        </div>


    </div>


    <script>
        let loggedInUserId = <?= $loggedInUserId; ?>;
        let adminId = <?= $adminId; ?>;

        $("#sendMessage").click(function() {
            let message = $("#message").val().trim();
            if (message === "") return;

            $.post("send_message.php", {
                sender_id: loggedInUserId,
                receiver_id: adminId,
                message: message
            }, function() {
                $("#message").val("");
                fetchMessages();
            });
        });

        function fetchMessages() {
            $.get("fetch_message.php", function(data) {
                $(".messages").html(data);
            });
        }

        setInterval(fetchMessages, 3000); // Fetch messages every 3 seconds
    </script>

</body>

</html>