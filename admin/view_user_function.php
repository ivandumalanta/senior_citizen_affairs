<?php
include '.././database/db_connection.php';

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

    // Check if "Approve" button was clicked
    if (isset($_POST['approve'])) {
        // Update the user's status to "approved"
        $updateSql = "UPDATE users SET status = 'approved' WHERE osca_id = :id";
        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->bindValue(':id', $id, PDO::PARAM_STR);
        $updateStmt->execute();

        // Redirect to the same page to reflect the change
        header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $id);
        exit;
    }
    
    // Handle update user data
    if (isset($_POST['update'])) {
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $middleName = $_POST['middle_name'];
        $suffix = $_POST['suffix'];
        $gender = $_POST['gender'];
        $birthDate = $_POST['birth_date'];
        $address = $_POST['address'];
        $phoneNumber = $_POST['phone_number'];

        // Update the user details
        $updateUserSql = "UPDATE users SET first_name = :first_name, last_name = :last_name, middle_name = :middle_name, suffix = :suffix, sex = :gender, birth_day = :birth_date, address = :address, phone_number = :phone_number WHERE osca_id = :id";
        $updateStmt = $pdo->prepare($updateUserSql);
        $updateStmt->bindValue(':first_name', $firstName, PDO::PARAM_STR);
        $updateStmt->bindValue(':last_name', $lastName, PDO::PARAM_STR);
        $updateStmt->bindValue(':middle_name', $middleName, PDO::PARAM_STR);
        $updateStmt->bindValue(':suffix', $suffix, PDO::PARAM_STR);
        $updateStmt->bindValue(':gender', $gender, PDO::PARAM_STR);
        $updateStmt->bindValue(':birth_date', $birthDate, PDO::PARAM_STR);
        $updateStmt->bindValue(':address', $address, PDO::PARAM_STR);
        $updateStmt->bindValue(':phone_number', $phoneNumber, PDO::PARAM_STR);
        $updateStmt->bindValue(':id', $id, PDO::PARAM_STR);
        $updateStmt->execute();

        // Reload the page to reflect changes
        header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $id);
        exit;
    }
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>