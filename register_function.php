<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $osca_id = $_POST['osca_id'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $first_name = $_POST['first_name'] ?? '';
    $middle_name = isset($_POST['no_middlename']) ? NULL : ($_POST['middle_name'] ?? NULL);
    $suffix = $_POST['suffix'] ?? NULL;
    $sex = $_POST['sex'] ?? '';

    // Combine the birth month, day, and year into a single date string
    $birth_month = $_POST['birth_month'] ?? '';
    $birth_day = $_POST['birth_day'] ?? '';
    $birth_year = $_POST['birth_year'] ?? '';

    // Convert month to numerical format (January => 01, February => 02, etc.)
    $month_map = [
        "January" => "01",
        "February" => "02",
        "March" => "03",
        "April" => "04",
        "May" => "05",
        "June" => "06",
        "July" => "07",
        "August" => "08",
        "September" => "09",
        "October" => "10",
        "November" => "11",
        "December" => "12"
    ];

    // Format the birthdate into YYYY-MM-DD
    if (!empty($birth_month) && !empty($birth_day) && !empty($birth_year)) {
        $birth_month = $month_map[$birth_month] ?? '01'; // Default to January if month is invalid
        $birth_date = $birth_year . '-' . $birth_month . '-' . str_pad($birth_day, 2, '0', STR_PAD_LEFT);
    } else {
        $birth_date = NULL; // If any part of the birth date is missing
    }

    $address = $_POST['address'] ?? '';
    $phone_number = $_POST['phone_number'] ?? '';



    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Define allowed file types
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];

        // Get file info
        $file_name = $_FILES['image']['name'];
        $file_tmp_name = $_FILES['image']['tmp_name'];
        $file_size = $_FILES['image']['size'];
        $file_type = $_FILES['image']['type'];

        // Check if the uploaded file is a valid image
        if (in_array($file_type, $allowed_types)) {
            // Check if the file size is less than 5MB (5000000 bytes)
            if ($file_size <= 5000000) {
                // Specify the base upload directory
                $base_upload_dir = 'private/OneByOne_ID/';

                // Create a folder with the name of the o$osca_id
                $oscar_folder = $base_upload_dir . $osca_id . '/';

                // Ensure the folder exists or create it
                if (!is_dir($oscar_folder)) {
                    mkdir($oscar_folder, 0777, true);  // Create folder with 0777 permissions
                }

                // Generate a unique file name to avoid overwriting
                $unique_file_name = uniqid('img_') . '.' . pathinfo($file_name, PATHINFO_EXTENSION);
                $full_file_path = $oscar_folder . $unique_file_name;
                // Move the uploaded file to the specific o$osca_id folder
                if (move_uploaded_file($file_tmp_name, $oscar_folder . $unique_file_name)) {
                    echo "File uploaded successfully!<br>";
                    echo "File name: " . $unique_file_name;
                } else {
                    echo "There was an error uploading the file.";
                }
            } else {
                echo "File is too large. Please upload a file smaller than 5MB.";
            }
        } else {
            echo "Invalid file type. Only JPG, PNG, and GIF files are allowed.";
        }
    } else {
        echo "No file uploaded or there was an upload error.";
    }
    try {
        // Prepare SQL statement for insertion
        $sql = "INSERT INTO users (osca_id, last_name, first_name, middle_name, suffix, sex, birth_day, address, phone_number, oneByOne_id_path) 
                VALUES (:osca_id, :last_name, :first_name, :middle_name, :suffix, :sex, :birth_date, :address, :phone_number, :full_path)";

        $stmt = $pdo->prepare($sql);

        // Bind the parameters and execute the statement
        $stmt->execute([
            ':osca_id' => $osca_id,
            ':last_name' => $last_name,
            ':first_name' => $first_name,
            ':middle_name' => $middle_name,
            ':suffix' => $suffix,
            ':sex' => $sex,
            ':birth_date' => $birth_date,
            ':address' => $address . ', Malasiqui, Pangasinan',
            ':phone_number' => $phone_number,
            ':full_path' => $full_file_path,
        ]);

        // If the insert is successful, show a success message
        echo "Data inserted successfully!";
    } catch (PDOException $e) {
        // Handle any insertion errors
        echo "Error: " . $e->getMessage();

        // Debug: print SQL query and parameters
        echo "<pre>";
        echo "SQL Query: $sql\n";
        print_r([
            ':osca_id' => $osca_id,
            ':last_name' => $last_name,
            ':first_name' => $first_name,
            ':middle_name' => $middle_name,
            ':suffix' => $suffix,
            ':sex' => $sex,
            ':birth_date' => $birth_date,
            ':address' => $address,
            ':phone_number' => $phone_number
        ]);
        echo "</pre>";
    }
}
?>