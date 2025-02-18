<?php
session_start();
include '../database/db_connection.php';

if (!isset($_SESSION['osca_id'])) {
    header("Location: login.php");
    exit();
}

$loggedInUserId = $_SESSION['osca_id'];

// Get admin ID

$sql = "SELECT * FROM users WHERE osca_id = $loggedInUserId";
$stmt = $pdo->query($sql);
$info = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check registration status
$isRegistered = false;
$isDeclined = false;
if (!empty($info)) {
    if ($info[0]['status'] === 'approved') {
        $isRegistered = true;
    } elseif ($info[0]['status'] === 'declined') {
        $isDeclined = true;
    }
}

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
<style>
    body {
        margin-top: 0;
    
    }
    .bento-container {
            display: flex;
            gap: 15px;
            padding: 15px;
        }
        .bento-item {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .large-item {
            flex: 2;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .large-item-content {
            text-align: center;
        }
        .small-items {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .small-item {
            flex: 1;
        }
        .status-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }
        .profile-picture {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
        }
        .text-orange {
            color:rgb(8, 0, 255);
        }
        .text-green {
            color: #28a745;
        }   
</style>
<body>

    <nav class="sidebar">
        <?php include '.././components/user-nav.php'; ?>
    </nav>
    <div class="main-content">
        <h1 class="text-center">My Application</h1>
        <div class="bento-container">
            <div id="statusBento" class="bento-item large-item">
                <div class="large-item-content">
                    <span id="statusIcon" class="status-icon glyphicon" aria-hidden="true"></span>
                    <h2 id="statusTitle"></h2>
                    <p id="statusMessage"></p>
                </div>
            </div>
            <div class="small-items">
                <div class="bento-item small-item">
                    <h3>ID Status</h3>
                    <p>Pending verification</p>
                </div>
                <div class="bento-item small-item">
                    <h3>Basic Information</h3>
                     <?php foreach ($info as $data): ?>
                        <div class="text-center">
                        <img src=".././<?php echo htmlspecialchars($data['oneByOne_id_path']); ?>" alt="Profile Picture" class="profile-picture" style="border: 1px gray solid">
                        
                        </div>
                       <p><strong>Full Name: </strong><?php echo htmlspecialchars($data['first_name']) . ' ' . htmlspecialchars($data['last_name']); ?></p>
                        <p><strong>Address:</strong> <?php echo htmlspecialchars($data['address']); ?></p>
                        <p><strong>Contact:</strong> <?php echo htmlspecialchars($data['phone_number']); ?></p>
                        <p><strong>Email: </strong><?php echo htmlspecialchars($data['email']); ?></p>
                        <p><strong>Birthday:</strong> <?php echo htmlspecialchars($data['birth_day']); ?></p>
                        
                        <p><strong>Classification:</strong> <?php echo htmlspecialchars($data['classification']); ?></p>
                        <p><strong>Civil Status:</strong> <?php echo htmlspecialchars($data['civil_status']); ?></p>
                        <p><strong>Blood Type:</strong> <?php echo htmlspecialchars($data['blood_type']); ?></p>
                        <p><strong>Education:</strong> <?php echo htmlspecialchars($data['education']); ?></p>
                        <p><strong>Employment:</strong> <?php echo htmlspecialchars($data['employment']); ?></p>
                        <p><strong>Religion:</strong> <?php echo htmlspecialchars($data['religion']); ?></p>
                    <?php endforeach; ?>



                </div>
            </div>
        </div>
    </div>


    </div>


    <script>
        const isRegistered = <?php echo json_encode($isRegistered); ?>;
        const isDeclined = <?php echo json_encode($isDeclined); ?>;

        function updateRegistrationStatus(isRegistered, isDeclined) {
            const statusIcon = document.getElementById('statusIcon');
            const statusTitle = document.getElementById('statusTitle');
            const statusMessage = document.getElementById('statusMessage');

            if (isRegistered) {
                statusIcon.className = 'status-icon glyphicon glyphicon-ok-circle text-green';
                statusTitle.textContent = 'Verified Account';
                statusTitle.className = 'text-green';
                statusMessage.textContent = 'Your account has been successfully verified.';
            } else if (isDeclined) {
                statusIcon.className = 'status-icon glyphicon glyphicon-remove-circle text-red';
                statusTitle.textContent = 'Application Declined';
                statusTitle.className = 'text-red';
                statusMessage.textContent = 'Unfortunately, your application has been declined. Please contact support for further assistance.';
            } else {
                statusIcon.className = 'status-icon glyphicon glyphicon-time text-orange';
                statusTitle.textContent = 'Registration in Progress';
                statusTitle.className = 'text-orange';
                statusMessage.textContent = 'Your registration is still being processed. Please check back later for updates.';
            }
        }
        updateRegistrationStatus(isRegistered, isDeclined);
    </script>


</body>

</html>