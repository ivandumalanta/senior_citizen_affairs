<?php
session_start();
include '../database/db_connection.php';

if (!isset($_SESSION['osca_id'])) {
    header("Location: login.php");
    exit();
}

$stmt = $pdo->query("SELECT osca_id, username FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="./assets/chat.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <nav class="sidebar">
        <?php include '.././components/admin-nav.php'; ?>
    </nav>
    <div class="main-content">
        <div class="container">
            <div class="row rowchat">
                <div class="col-sm-12 chatflex">
               
                    <div class="user-list userside">
                        <h3>Users</h3>
                        <?php foreach ($users as $user): ?>
                            <div class="user" data-id="<?= $user['osca_id']; ?>">
                                <?= htmlspecialchars($user['username']); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="chat-box">
                        <h3>Chat with <span id="chatUser"></span></h3>
                        <div class="messages"></div>

                        <div class="row-textbtn">
                        <textarea id="message" class="form-control " placeholder="Type a message..."></textarea>
                        <button class="btnbutton" id="sendMessage">Send</button>
                        </div>
                      
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        let currentUserId = null;
        let loggedInUserId = <?= $_SESSION['osca_id']; ?>;

        $(".user").click(function() {
            currentUserId = $(this).data("id");
            $("#chatUser").text($(this).text());
            $(".chat-box").show();S
        });

        $("#sendMessage").click(function() {
            let message = $("#message").val();
            if (message.trim() === "" || !currentUserId) return;

            $.post("send_message.php", {
                sender_id: loggedInUserId,
                receiver_id: currentUserId,
                message: message
            }, function() {
                $("#message").val("");
                fetchMessages();
            });
        });

        function fetchMessages() {
            if (!currentUserId) return;

            $.get("fetch_message.php", {
                receiver_id: currentUserId
            }, function(data) {
                $(".messages").html(data);
            });
        }

        setInterval(fetchMessages, 3000); // Fetch new messages every 3 seconds
    </script>

</body>

</html>