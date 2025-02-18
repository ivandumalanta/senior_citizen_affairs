<?php
session_start();

// Prevent unauthorized access
if (!isset($_SESSION['verified_user']) || !isset($_SESSION['user_id'])) {
    echo "Unauthorized access!";
    exit();
}

$user_id = $_SESSION['user_id'];

// Database connection
include './database/db_connection.php';

// Fetch user details securely, including status
$sql = "SELECT last_name, first_name, middle_name, suffix, sex, birth_day, address, osca_id, created_at, status FROM users WHERE osca_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found!";
    exit();
}
// Fetch user details securely, including status
$sql = "SELECT last_name, first_name, middle_name, suffix, sex, birth_day, address, osca_id, created_at, status FROM users WHERE osca_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found!";
    exit();
}


// Determine panel heading and colors based on status
$status = strtolower($user['status'] ?? "unknown");
if ($status == "pending") {
    $panel_heading = "APPLICATION IN PROCESS";
    $panel_color = "#ff9800"; // Orange
} elseif ($status == "declined") {
    $panel_heading = "APPLICATION DECLINED";
    $panel_color = "#d32f2f"; // Red
} elseif ($status == "approved") {
    $panel_heading = "   VERIFIED";
    $panel_color = "#2e7d32"; // Green
} else {
    $panel_heading = "STATUS UNKNOWN";
    $panel_color = "#616161"; // Gray
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Verification</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #e3f2fd;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .panel {
            width: 450px;
            border: 2px solid #42a5f5;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        .panel-heading {
            background-color: #2e7d32 !important;
            color: white !important;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
        .panel-body {
            position: relative;
            padding: 20px;
            text-align: center;
        }
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.1;
            width: 220px;
        }
        .info p {
            font-size: 16px;
            line-height: 1.6;
            text-transform: uppercase;
        }
        .info strong {
            color: #1565c0;
        }
        .panel-footer {
            text-align: center;
            font-size: 14px;
            color: #777;
            background-color: #f7f7f7;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
        }
    </style>
</head>
<body>
    <div class="panel panel-primary">
    <div class="panel-heading"><?php echo $panel_heading; ?></div>
        <div class="panel-body">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRb75IXSVCkPBpWtib18HMGQ7asXjB6MJEIAw&s" class="watermark" alt="Watermark">
            
            <?php if (strtolower($user['status']) == "pending"): ?>
                <p style="color: orange; font-weight: bold;">YOUR APPLICATION IS STILL IN PROCESS.</p>
            <?php elseif (strtolower($user['status']) == "declined"): ?>
                <p style="color: red; font-weight: bold;">YOUR APPLICATION WAS DECLINED DUE TO SUBMITTED DOCUMENTS. IF YOU HAVE CONCERNS, YOU CAN VISIT US AT OUR OFFICE.</p>
            <?php elseif (strtolower($user['status']) == "approved"): ?>
                <div class="info">
                    <p><strong>LAST NAME:</strong> <?php echo strtoupper(htmlspecialchars($user['last_name'] ?? "N/A")); ?></p>
                    <p><strong>FIRST NAME:</strong> <?php echo strtoupper(htmlspecialchars($user['first_name'] ?? "N/A")); ?></p>
                    <p><strong>MIDDLE NAME:</strong> <?php echo strtoupper(htmlspecialchars($user['middle_name'] ?? "N/A")); ?></p>
                    <p><strong>SUFFIX:</strong> <?php echo strtoupper(htmlspecialchars($user['suffix'] ?? "N/A")); ?></p>
                    <p><strong>SEX:</strong> <?php echo strtoupper(htmlspecialchars($user['sex'] ?? "N/A")); ?></p>
                    <p><strong>DATE OF BIRTH:</strong> <?php echo strtoupper(!empty($user['birth_day']) ? date("F j, Y", strtotime($user['birth_day'])) : "N/A"); ?></p>
                    <p><strong>ADDRESS:</strong> <?php echo strtoupper(htmlspecialchars($user['address'] ?? "N/A")); ?></p>
                    <p><strong>OSCA ID:</strong> <?php echo strtoupper(htmlspecialchars($user['osca_id'] ?? "N/A")); ?></p>
                    <p><strong>DATE OF ISSUE:</strong> <?php echo strtoupper(!empty($user['created_at']) ? date("F j, Y", strtotime($user['created_at'])) : "N/A"); ?></p>
                </div>
            <?php else: ?>
                <p style="color: gray; font-weight: bold;">STATUS UNKNOWN. PLEASE CONTACT THE OFFICE.</p>
            <?php endif; ?>
            
        </div>
        <div class="panel-footer">Official Verification Document</div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
