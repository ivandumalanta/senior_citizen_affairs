<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $email = $_POST['email'] ?? '';
    $osca_id = $_POST['osca_id'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $first_name = $_POST['first_name'] ?? '';
    $middle_name = isset($_POST['no_middlename']) ? NULL : ($_POST['middle_name'] ?? NULL);
    $suffix = $_POST['suffix'] ?? NULL;
    $sex = $_POST['sex'] ?? '';
    $classification = $_POST['classification'] ?? '';
    $civil_status = $_POST['civil'] ?? '';
    $blood_type = $_POST['blood_type'] ?? '';
    $religion = $_POST['religion'] ?? '';
    $educational = $_POST['educational_attainment'] ?? '';
    $employment = $_POST['employment_status'] ?? '';
    // Combine the birth month, day, and year into a single date string
    $birth_month = $_POST['birth_month'] ?? '';
    $birth_day = $_POST['birth_day'] ?? '';
    $birth_year = $_POST['birth_year'] ?? '';
 
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
    }

    $address = $_POST['address'] ?? '';
    $phone_number = $_POST['phone_number'] ?? '';


    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Define allowed file types
        $allowed_types = ['image/jpeg', 'image/png'];
    
        // Get file info
        $file_name = $_FILES['image']['name'];
        $file_tmp_name = $_FILES['image']['tmp_name'];
        $file_size = $_FILES['image']['size'];
        $file_type = $_FILES['image']['type'];
    
        // Check if the uploaded file is a valid image
        if (in_array($file_type, $allowed_types)) {
            if ($file_size <= 500000000) {
                // Specify the base upload directory
                $base_upload_dir = 'private/OneByOne_ID/';
    
                // Create a folder with the name of the osca_id
                $oscar_folder = $base_upload_dir . $osca_id . '/';
    
                if (!is_dir($oscar_folder)) {
                    mkdir($oscar_folder, 0777, true); 
                }
                // Generate a unique file name to avoid overwriting
                $unique_file_name = uniqid('img_') . '.' . pathinfo($file_name, PATHINFO_EXTENSION);
                $full_file_path = $oscar_folder . $unique_file_name;
                if (!move_uploaded_file($file_tmp_name, $oscar_folder . $unique_file_name)) {
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
    
    if (isset($_FILES['image-signature']) && $_FILES['image-signature']['error'] == 0) {
        $allowed_types_sig = ['image/jpeg', 'image/png', 'image/gif'];
    
        $file_name_sig = $_FILES['image-signature']['name'];
        $file_tmp_name_sig = $_FILES['image-signature']['tmp_name'];
        $file_size_sig = $_FILES['image-signature']['size'];
        $file_type_sig = $_FILES['image-signature']['type'];
    
        if (in_array($file_type_sig, $allowed_types_sig)) {
            if ($file_size_sig <= 500000000) {
                // Specify the base upload directory
                $base_upload_dir_sig = 'private/signature/';
    
                $oscar_folder_sig = $base_upload_dir_sig . $osca_id . '/';
    
                // Ensure the folder exists or create it
                if (!is_dir($oscar_folder_sig)) {
                    mkdir($oscar_folder_sig, 0777, true);  // Create folder with 0777 permissions
                }
    
                $unique_file_name_sig = uniqid('sig_') . '.' . pathinfo($file_name_sig, PATHINFO_EXTENSION);
                $full_file_path_sig = $oscar_folder_sig . $unique_file_name_sig;
                // Move the uploaded file to the specific osca_id folder
                if (!move_uploaded_file($file_tmp_name_sig, $oscar_folder_sig . $unique_file_name_sig)) {
                    echo "There was an error uploading the signature.";
                } 
            } else {
                echo "Signature file is too large. Please upload a file smaller than 5MB.";
            }
        } else {
            echo "Invalid file type for signature. Only JPG, PNG, and GIF files are allowed.";
        }
    } else {
        echo "No signature file uploaded or there was an upload error.";
    }
    if (isset($_FILES['image-documents']) && count($_FILES['image-documents']['name']) > 0) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf'];
    
        $file_count = count($_FILES['image-documents']['name']);
        $uploaded_files = [];
    
        // Specify the base upload directory
        $base_upload_dir = 'private/documents/';
        $osca_id = $_POST['osca_id'];
    
        // Create a folder for the osca_id
        $osca_folder = $base_upload_dir . $osca_id . '/';
        if (!is_dir($osca_folder)) {
            mkdir($osca_folder, 0777, true); // Create folder with 0777 permissions
        }
    
        for ($i = 0; $i < $file_count; $i++) {
            // Get individual file details
            $file_name = $_FILES['image-documents']['name'][$i];
            $file_tmp_name = $_FILES['image-documents']['tmp_name'][$i];
            $file_size = $_FILES['image-documents']['size'][$i];
            $file_type = $_FILES['image-documents']['type'][$i];
    
            // Validate file type and size
            if (in_array($file_type, $allowed_types) && $file_size <= 500000000) {
                $unique_file_name = uniqid('doc_') . '.' . pathinfo($file_name, PATHINFO_EXTENSION);
                $full_file_path_doc = $osca_folder . $unique_file_name;
    
                // Move the file to the osca_id folder
                if (move_uploaded_file($file_tmp_name, $full_file_path_doc)) {
                    $uploaded_files[] = $full_file_path_doc; // Save the file path for database storage
                } else {
                    echo "Error uploading file: " . $file_name;
                }
            } else {
                echo "Invalid file type or size for file: " . $file_name;
            }
        }
        // Check if any files were successfully uploaded
        if (!empty($uploaded_files)) {
            // Convert file paths to JSON
            $documents_path_json = json_encode($uploaded_files);
    
        } else {
            echo "No valid files uploaded.";
        }
    } else {
        echo "No files selected for upload.";
    }
    
    
    try {
        $sql = "INSERT INTO users (osca_id, username, password, email, last_name, first_name, middle_name, suffix, sex, birth_day, address, phone_number, oneByOne_id_path, classification, civil_status, blood_type, education, employment, religion, member_status) 
        VALUES (:osca_id, :username, :password, :email, :last_name, :first_name, :middle_name, :suffix, :sex, :birth_date, :address, :phone_number, :full_path, :classification, :civil_status, :blood_type, :educational, :employment, :religion, :member_status)";

        $sqlDocs = "INSERT INTO user_documents (id, signature_id, documents_path) VALUES (:osca_id, :full_path_sig, :documents_path)";
        $stmt = $pdo->prepare($sql);
        $stmt_second = $pdo->prepare( $sqlDocs);

        $stmt->execute([
            ':osca_id' => $osca_id,
            ':username' => $username,
            ':password' => $password,
            ':email' => $email,
            ':last_name' => $last_name,
            ':first_name' => $first_name,
            ':middle_name' => $middle_name,
            ':suffix' => $suffix,
            ':sex' => $sex,
            ':birth_date' => $birth_date, // Matches :birth_date
            ':address' => $address . ', Malasiqui, Pangasinan',
            ':phone_number' => $phone_number,
            ':full_path' => $full_file_path, // Matches :full_path
            ':classification' => $classification,
            ':civil_status' => $civil_status,
            ':blood_type' => $blood_type,
            ':educational' => $educational,
            ':employment' => $employment, // Matches :employment
            ':religion' => $religion,
            ':member_status' => null
        ]);
        
        $stmt_second->execute([
            ':osca_id' => $osca_id,
            ':full_path_sig' => $full_file_path_sig,
            ':documents_path' => $documents_path_json
        ]);
    
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';

            echo "<script>
                setTimeout(function() {
                    Swal.fire({
                        title: 'Success!',
                        text: 'You successfully submitted your registration.',
                        icon: 'success'
                    }).then(() => {
                        window.location.href = 'index.php'; // Change this to your desired page
                    });
                }, 100);
            </script>";

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        echo "<pre>";
        echo "SQL Query: $sql\n";
        print_r([
            ':osca_id' => $osca_id,
            ':username' => $username,
            ':password' => $password,
            ':email' => $email,
            ':last_name' => $last_name,
            ':first_name' => $first_name,
            ':middle_name' => $middle_name,
            ':suffix' => $suffix,
            ':sex' => $sex,
            ':birth_date' => $birth_date,
            ':address' => $address,
            ':phone_number' => $phone_number,
            ':full_path' => $full_file_path,
            ':classification' => $classification,
            ':civil_status' => $civil_status,
            ':blood_type' => $blood_type,
            ':educational' => $educational,
            ':employment' => $employment,
            ':religion' => $religion,
        ]);
        echo "</pre>";
    }
}
?>