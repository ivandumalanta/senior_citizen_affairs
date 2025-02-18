<?php
include '.././database/db_connection.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid user ID.");
}

try {
    $id = $_GET['id'];

    // Fetch user details
    $sql = "SELECT * FROM users WHERE osca_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_STR);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        die("User not found.");
    }

    // Fetch user documents
    $sqlDocs = "SELECT * FROM user_documents WHERE id = :id";
    $stmtDocs = $pdo->prepare($sqlDocs);
    $stmtDocs->bindValue(':id', $id, PDO::PARAM_STR);
    $stmtDocs->execute();

    $documents = $stmtDocs->fetchAll(PDO::FETCH_ASSOC);

 // Handle approve action
 if (isset($_POST['approve'])) {
    $updateSql = "UPDATE users SET status = 'approved' WHERE osca_id = :id";
    $updateStmt = $pdo->prepare($updateSql);
    $updateStmt->bindValue(':id', $id, PDO::PARAM_STR);
    
    echo $updateStmt->execute() ? "success" : "error";
    exit;
}

// Handle decline action
if (isset($_POST['decline'])) {
    $updateSql = "UPDATE users SET status = 'declined' WHERE osca_id = :id";
    $updateStmt = $pdo->prepare($updateSql);
    $updateStmt->bindValue(':id', $id, PDO::PARAM_STR);
    
    echo $updateStmt->execute() ? "success" : "error";
    exit;
}

    
    // Handle update user data
   
if (isset($_POST['update'])) {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $middleName = $_POST['middle_name'];
    $suffix = $_POST['suffix'];
    $sex = $_POST['sex'];
    $birthDate = $_POST['birth_date'];
    $address = $_POST['address'];
    $phoneNumber = $_POST['phone_number'];
    $memberStatus = $_POST['member_status'];

    // Update the user details
    $updateUserSql = "UPDATE users SET first_name = :first_name, last_name = :last_name, middle_name = :middle_name, suffix = :suffix, sex = :sex, birth_day = :birth_date, address = :address, phone_number = :phone_number, member_status = :member_status WHERE osca_id = :id";
    $updateStmt = $pdo->prepare($updateUserSql);
    $updateStmt->bindValue(':first_name', $firstName, PDO::PARAM_STR);
    $updateStmt->bindValue(':last_name', $lastName, PDO::PARAM_STR);
    $updateStmt->bindValue(':middle_name', $middleName, PDO::PARAM_STR);
    $updateStmt->bindValue(':suffix', $suffix, PDO::PARAM_STR);
    $updateStmt->bindValue(':sex', $sex, PDO::PARAM_STR);
    $updateStmt->bindValue(':birth_date', $birthDate, PDO::PARAM_STR);
    $updateStmt->bindValue(':address', $address, PDO::PARAM_STR);
    $updateStmt->bindValue(':phone_number', $phoneNumber, PDO::PARAM_STR);
    $updateStmt->bindValue(':member_status', $memberStatus, PDO::PARAM_STR);
    $updateStmt->bindValue(':id', $id, PDO::PARAM_STR);

    if ($updateStmt->execute()) {
        echo "<script>alert('User data updated successfully!');</script>";
    } else {
        echo "<script>alert('Failed to update user data.');</script>";
    }

    // Reload the page to reflect changes
    header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $id);
    exit;
}
} catch (PDOException $e) {
    echo "<script>alert('Database connection failed: " . $e->getMessage() . "');</script>";
    die("Database connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User</title>
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>
    <nav class="navbar">
        <?php include '.././components/admin-nav.php'; ?>
    </nav>

    <div class="main-content">

        <a href="applicants.php" class="btn btn-danger">Back to List</a>
        <h1><b>View User Details</b></h1>
        <?php if ($user['status'] == 'pending'): ?>
        <form id="actionForm" method="POST">
            <button type="button" id="approveBtn" class="btn btn-primary">Approve</button>
            <button type="button" id="declineBtn" class="btn btn-danger">Decline</button>
            <input type="hidden" name="action" id="actionInput" value="">
        </form>
    <?php else: ?>
        <p class="text-info">User status: <?php echo htmlspecialchars($user['status']); ?></p>
    <?php endif; ?>
                        <br>
                        <br>
         
        <div class="container-fluid">
      

<div class="container-fluid">
    <div class="row formuser">
        
    </div>
</div>
</div>

<!-- Modal for Editing User Details -->
<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn btn-primary" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit User Details</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="first_name">First Name:</label>
                        <input type="text" class="form-control" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name:</label>
                        <input type="text" class="form-control" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="middle_name">Middle Name:</label>
                        <input type="text" class="form-control" name="middle_name" value="<?php echo htmlspecialchars($user['middle_name']); ?>">
                    </div>
                    <div class="form-group">
                    <label for="last_name">Suffix:</label>
        <select class="form-control" name="suffix">
            <option value="" <?php echo ($user['suffix'] == '') ? 'selected' : ''; ?>>None</option>
            <option value="Jr." <?php echo ($user['suffix'] == 'Jr.') ? 'selected' : ''; ?>>Jr.</option>
            <option value="Sr." <?php echo ($user['suffix'] == 'Sr.') ? 'selected' : ''; ?>>Sr.</option>
            <option value="II" <?php echo ($user['suffix'] == 'II') ? 'selected' : ''; ?>>II</option>
            <option value="III" <?php echo ($user['suffix'] == 'III') ? 'selected' : ''; ?>>III</option>
            <option value="IV" <?php echo ($user['suffix'] == 'IV') ? 'selected' : ''; ?>>IV</option>
        </select>
    
</div>

                    <div class="form-group">
                        <label for="sex">Gender</label>
                        <select class="form-control" name="sex" required>
                            <option value="Male" <?php echo ($user['sex'] === 'Male') ? 'selected' : ''; ?>>Male</option>
                            <option value="Female" <?php echo ($user['sex'] === 'Female') ? 'selected' : ''; ?>>Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="birth_date">Birth Date:</label>
                        <input type="date" class="form-control" name="birth_date" value="<?php echo htmlspecialchars($user['birth_day']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" name="address" value="<?php echo htmlspecialchars($user['address']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone Number:</label>
                        <input type="text" class="form-control" name="phone_number" value="<?php echo htmlspecialchars($user['phone_number']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="member_status">Member Status:</label>
                        <select class="form-control" name="member_status" required>
                            <option value="active" <?php echo ($user['member_status'] == 'active') ? 'selected' : ''; ?>>Active</option>
                            <option value="inactive" <?php echo ($user['member_status'] == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                            <option value="passed away" <?php echo ($user['member_status'] == 'passed away') ? 'selected' : ''; ?>>Passed Away</option>
                        </select>
                    </div>
                    <button type="submit" name="update" class="btn btn-success">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

            <div class="row formuser">
                <div class="col-sm-8 formapplicants" style="font-size: 20px;">


                    <form class="form spacingtop20 ">
                        <!-- OSCA ID -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">OSCA ID:</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?php echo htmlspecialchars($user['osca_id']); ?></p>
                            </div>
                        </div>
                        <!-- Last Name -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Last Name:</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?php echo htmlspecialchars($user['last_name']); ?></p>
                            </div>
                        </div>
                        <!-- First Name -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">First Name:</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?php echo htmlspecialchars($user['first_name']); ?></p>
                            </div>
                        </div>
                        <!-- Middle Name -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Middle Name:</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?php echo htmlspecialchars($user['middle_name'] ?? 'N/A'); ?></p>
                            </div>
                        </div>
                        <!-- Suffix -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Suffix:</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?php echo htmlspecialchars($user['suffix']); ?></p>
                            </div>
                        </div>
                        <!-- Gender -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Gender:</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?php echo htmlspecialchars($user['sex']); ?></p>
                            </div>
                        </div>
                        <!-- Birth Date -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Birth Date:</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?php echo htmlspecialchars($user['birth_day']); ?></p>
                            </div>
                        </div>
                        <!-- Address -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Address:</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?php echo htmlspecialchars($user['address']); ?></p>
                            </div>
                        </div>
                        <!-- Phone Number -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Phone Number:</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?php echo htmlspecialchars($user['phone_number']); ?></p>
                            </div>
                        </div>
                        <!-- 1x1 ID -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">1x1 ID:</label>
                            <div class="col-sm-9">
                                <img src=".././<?php echo htmlspecialchars($user['oneByOne_id_path']); ?>" alt="ID Image" class="img-thumbnail" width="200" height="200">
                            </div>
                        </div>
                        <!-- Status -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Status: </label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><?php echo htmlspecialchars($user['status']); ?></p>
                            </div>
                        </div>
                        
                    </form>


                </div>
                <div class="col-sm-4 text-center">
                    <div class="formapplicants ">
                        <h2>User Documents</h2>
                        <div class="documents spacingtop20">
                            <?php if ($documents): ?>
                                <?php foreach ($documents as $doc): ?>
                                    <div class="image-container">
                                        <img src=".././<?php echo htmlspecialchars($doc['signature_id']); ?>" alt="Signature" class="img-thumbnail" width="200" height="200">
                                        <br>
                                        <a href=".././<?php echo htmlspecialchars($doc['signature_id']); ?>" target="_blank" class="btn btn-danger btn-sm mt-2">View Image</a>
                              
                                    </div>
                                            <?php
                                    // Decode the JSON data for documents_path
                                    $documentPaths = json_decode($doc['documents_path'], true);
                                    if (is_array($documentPaths)):
                                    ?>
                                        <div class="document-images spacingtop20">
                                            <?php foreach ($documentPaths as $path): ?>
                                                <div class="image-container">
                                                    <img src=".././<?php echo htmlspecialchars($path); ?>" alt="Document Image" class="img-thumbnail" width="200" height="200">
                                                    <br>
                                                    <a href=".././<?php echo htmlspecialchars($path); ?>" target="_blank" class="btn btn-danger btn-sm mt-2">View Image</a>
                                                    
                                                </div>
                                                <br>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-warning">No documents found for this user.</p>
                            <?php endif; ?>

                        </div>
                        <br>

                        <!-- Approve Button Form -->
                        
                    </div>
                </div>



            </div>


        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById("approveBtn").addEventListener("click", function() {
            confirmAction("approve", "Approve", "Are you sure you want to approve this user?");
        });

        document.getElementById("declineBtn").addEventListener("click", function() {
            confirmAction("decline", "Decline", "Are you sure you want to decline this user?");
        });

        function confirmAction(action, title, message) {
            Swal.fire({
                title: title,
                text: message,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, " + action + " it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("actionInput").name = action;
                    fetch("", {
                        method: "POST",
                        body: new FormData(document.getElementById("actionForm"))
                    })
                    .then(response => response.text())
                    .then(data => {
                        if (data.trim() === "success") {
                            Swal.fire("Success!", "User has been " + action + "d.", "success").then(() => {
                                window.location.href = "applicants.php";
                            });
                        } else {
                            Swal.fire("Error!", "Something went wrong. Please try again.", "error");
                        }
                    });
                }
            });
        }
    </script>
</body>

</html>