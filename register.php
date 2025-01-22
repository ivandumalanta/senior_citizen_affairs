<?php
// Include the database connection file
include './database/db_connection.php';

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
        "January" => "01", "February" => "02", "March" => "03", "April" => "04",
        "May" => "05", "June" => "06", "July" => "07", "August" => "08",
        "September" => "09", "October" => "10", "November" => "11", "December" => "12"
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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
<nav>
    <?php include './components/nav.php'; ?>
</nav>

<main>
    <section id="section">
        <div class="header">
            <div class="department">
                Office of Senior Citizen Affairs
            </div>
            <span>Malasiqui</span>
            <div class="title">Registration Form</div>
            
            <form action="register.php" method="post" enctype="multipart/form-data">
            <div class="upload-pic">
            <input type="file" id="image" name="image">
            <span>
                    1x1 ID Picture
                </span>
            </div>
                    <label for="osca_id">OSCA ID number:</label>
                    <input type="text" id="osca_id" name="osca_id"><br><br>

                    <label for="last_name">Last name:</label>
                    <input type="text" id="last_name" name="last_name"><br><br>

                    <label for="first_name">First name:</label>
                    <input type="text" id="first_name" name="first_name"><br><br>

                    <label for="middle_name">Middle name:</label>
                    <input type="checkbox" id="no_middlename" name="no_middlename" />
                    <input type="text" id="middle_name" name="middle_name" /><br><br>
                    <br><br>

                    <label>Suffix:</label>
                    <label><input type="radio" name="suffix" value="">WALA</label>
                    <label><input type="radio" name="suffix" value="JR">JR</label>
                    <label><input type="radio" name="suffix" value="SR">SR</label>
                    <label><input type="radio" name="suffix" value="I">I</label>
                    <label><input type="radio" name="suffix" value="II">II</label>
                    <label><input type="radio" name="suffix" value="III">III</label>
                    <label><input type="radio" name="suffix" value="IV">IV</label>
                    <label><input type="radio" name="suffix" value="V">V</label><br><br>

                    <label>Sex:</label>
                    <label><input type="radio" name="sex" value="MALE">MALE</label>
                    <label><input type="radio" name="sex" value="FEMALE">FEMALE</label><br><br>

                    <label>Birthday:</label>
                    <select name="birth_month">
                        <option>Select Month</option>
                        <option>January</option>
                        <option>February</option>
                        <option>March</option>
                        <option>April</option>
                        <option>May</option>
                        <option>June</option>
                        <option>July</option>
                        <option>August</option>
                        <option>September</option>
                        <option>October</option>
                        <option>November</option>
                        <option>December</option>
                    </select>
                    <select name="birth_day">
                        <option>Select Date</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                        <option>13</option>
                        <option>14</option>
                        <option>15</option>
                        <option>16</option>
                        <option>17</option>
                        <option>18</option>
                        <option>19</option>
                        <option>20</option>
                        <option>21</option>
                        <option>22</option>
                        <option>23</option>
                        <option>24</option>
                        <option>25</option>
                        <option>26</option>
                        <option>27</option>
                        <option>28</option>
                        <option>29</option>
                        <option>30</option>
                        <option>31</option>
                    </select>
                    <input type="text" name="birth_year" placeholder="Enter Year"><br><br>

                    <label>Address:</label>
                    <input type="text" name="address">
                    <span>Malasiqui, Pangasinan</span>
                    <br><br>

                    <label>Phone Number:</label>
                    <input type="text" name="phone_number"><br><br>

                    <div class="documents">
                        <div class="requirements">
                            <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24"><g fill="#045fb9" fill-rule="evenodd" clip-rule="evenodd"><path d="M13 10a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2H14a1 1 0 0 1-1-1"/><path d="M2 6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12c0 .556-.227 1.06-.593 1.422A1 1 0 0 1 20.5 20H4a2 2 0 0 1-2-2zm6.892 12l3.833-5.356l-3.99-4.322a1 1 0 0 0-1.549.097L4 12.879V6h16v9.95l-3.257-3.619a1 1 0 0 0-1.557.088L11.2 18z"/></g></svg>
                            <span>Upload here the Brgy. Certificate of Residency, Birth Certificate or 2 Valid Id's</span>
                        </div>
                        <div class="finger-print">
                            <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24"><g fill="#045fb9" fill-rule="evenodd" clip-rule="evenodd"><path d="M13 10a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2H14a1 1 0 0 1-1-1"/><path d="M2 6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12c0 .556-.227 1.06-.593 1.422A1 1 0 0 1 20.5 20H4a2 2 0 0 1-2-2zm6.892 12l3.833-5.356l-3.99-4.322a1 1 0 0 0-1.549.097L4 12.879V6h16v9.95l-3.257-3.619a1 1 0 0 0-1.557.088L11.2 18z"/></g></svg>
                            <span>Upload here the Signature or Thumbmark of the Senior Citizen</span>
                        </div>
                    </div>

                    <input type="submit" value="Submit">
            </form>


        </div>
     </section>
</main>
</body>
</html>

<script>
  const noMiddlenameCheckbox = document.getElementById('no_middlename');
  const middlenameInput = document.getElementById('middle_name');

  noMiddlenameCheckbox.addEventListener('change', () => {
    if (noMiddlenameCheckbox.checked) {
        middlenameInput.value = ''; 
      middlenameInput.disabled = true;
     
    } else {
      middlenameInput.disabled = false;
    }
  });
</script>   
