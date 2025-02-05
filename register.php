<?php
// Include the database connection file
include './database/db_connection.php';
include './register_function.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/styleHome.css"> <!-- Link to external CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <nav>
        <?php include './components/nav.php'; ?>
    </nav>

    <main class="heromain">
        <section id="section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <div class="department spacingtop">
                            <p class="font32 "><b>Office of Senior Citizen Affairs</b> <br> <span class="font24">Malasiqui</span></p>
                        </div>


                    </div>

                </div>
            </div>



            <form action="register.php" method="post" enctype="multipart/form-data">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 text-center">
                            <div class="title">
                                <p class="font24"><b>Registration Form</b></p>
                            </div>
                        </div>
                        <div class="col-sm-4 font23">
                            <label for="image" class="upload-icon">
                                <img id="preview-image" src="https://files.axshare.com/gsc/JK2WS3/7d/72/d7/7d72d709bc3b4c8cb808bfd8757274b5/images/register/u47.svg?pageId=c824c539-f06d-4c4c-aef8-7773a5e7e7fe" alt="Upload Icon">
                                <span>1x1 ID Picture</span>
                            </label>
                            <input type="file" id="image" name="image" accept="image/*" style="display: none;" class="form-control"  required>
                        </div>
                    </div>
                    <div class=flexform>


                        <div class="row spacingtop">
                            <div class="col-sm-6 font23">
                                <label for="osca_id">OSCA ID number:</label>
                                <input type="number" id="osca_id" name="osca_id" class="form-control">

                                <label for="last_name" class="spacingtop">Last name:</label>
                                <input type="text" id="last_name" name="last_name" class="form-control">

                                <label for="first_name" class="spacingtop">First name:</label>
                                <input type="text" id="first_name" name="first_name" class="form-control">

                                <label for="middle_name" class="spacingtop">Middle name:</label>
                                <input type="checkbox" id="no_middlename" name="no_middlename" /> No Middlename
                                <input type="text" id="middle_name" name="middle_name" class="form-control">

                                <label class="spacingtop">Suffix:</label><br>
                                <label><input type="radio" name="suffix" value=""> None</label>
                                <label><input type="radio" name="suffix" value="JR"> JR</label>
                                <label><input type="radio" name="suffix" value="SR"> SR</label>
                                <label><input type="radio" name="suffix" value="I"> I</label>
                                <label><input type="radio" name="suffix" value="II"> II</label>
                                <label><input type="radio" name="suffix" value="III"> III</label>
                            </div>

                            <div class="col-sm-6 font23">
                                <!-- <label >Member Status:</label>
                                <select name="member_status" class="form-control">
                                    <option>Active</option>
                                    <option>At Risk</option>
                                    <option>High Risk</option>
                                    <option>Inactive</option>
                                    <option>Passed Away</option>
                                </select> -->

                                <label>Classifications:</label>
                                <select name="classification" class="form-control">
                                    <option>Indigent</option>
                                    <option>Pensioner</option>
                                    <option>Supported</option>
                                </select>

                                <label class="spacingtop">Sex:</label><br>
                                <label><input type="radio" name="sex" value="Male"> Male</label>
                                <label><input type="radio" name="sex" value="Female"> Female</label>
                                <br>
                                <label class="spacingtop">Civil Status:</label>
                                <select name="civil" class="form-control">
                                    <option>Divorced</option>
                                    <option>Married</option>
                                    <option>Separated</option>
                                    <option>Single</option>
                                    <option>Widowed</option>
                                </select>

                                <label class="spacingtop">Religion:</label>
                                <select name="religion" class="form-control">
                                    <option>Roman Catholic</option>
                                    <option>Islam</option>
                                    <option>Iglesia ni Cristo</option>
                                    <option>Seventh-day Adventist</option>
                                    <option>Bible Baptist Church</option>
                                    <option>United Church of Christ in the P...</option>
                                    <option>Jehovah's Witnesses</option>
                                </select>
                            </div>
                        </div>

                        <div class="row spacingtop">
                            <div class="col-sm-6 font23">
                                <label >Blood Type:</label>
                                <select name="blood_type" class="form-control">
                                    <option>O+</option>
                                    <option>A+</option>
                                    <option>A-</option>
                                    <option>B+</option>
                                    <option>B-</option>
                                    <option>AB+</option>
                                    <option>AB-</option>
                                </select>

                                <label class="spacingtop">Educational Attainment:</label>
                                <select name="educational_attainment" class="form-control">
                                    <option>Elementary</option>
                                    <option>High School</option>
                                    <option>College</option>
                                    <option>Vocational</option>
                                    <option>Masters</option>
                                    <option>Degree</option>
                                    <option>Doctoral</option>
                                </select>

                                <label class="spacingtop">Employment:</label>
                                <select name="employment_status" class="form-control">
                                    <option>Employed</option>
                                    <option>Self Employed</option>
                                    <option>Unemployed</option>
                                </select>
                            </div>

                            <div class="col-sm-6 font23">
                            <label >Birthday: </label>
                            <div class="birthday">
                             
                                
                                <select name="birth_month" class="form-control">
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
                                
                                <select name="birth_day" class="form-control">
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
                         
                                <input type="text" name="birth_year" placeholder="Enter Year" class="form-control">
                            </div>  
                            

                                <label class="spacingtop">Address:</label>
                                <input type="text" name="address" class="form-control">
                   

                                <label class="spacingtop">Phone Number:</label>
                                <input type="number" name="phone_number" class="form-control">
                            </div>
                        </div>

                        <div class="row spacingtop">
                            <div class="col-sm-6 documents">
                                <div class="requirements">
                                    <label for="image-documents" class="upload-icon">
                                        <img id="preview-documents" src="https://files.axshare.com/gsc/JK2WS3/7d/72/d7/7d72d709bc3b4c8cb808bfd8757274b5/images/register/u47.svg?pageId=c824c539-f06d-4c4c-aef8-7773a5e7e7fe" alt="Upload Icon">
                                        <span>Upload here the Brgy. Certificate of Residency, Birth Certificate or 2 Valid IDs</span>
                                    </label>
                                    <input type="file" id="image-documents" name="image-documents[]" multiple class="imgbutton form-control" accept="image/*"  required>
                                </div>
                            </div>
                            <div class="col-sm-6 finger-print">
                                <label for="image-signature" class="upload-icon">
                                    <img id="preview-signature" src="https://files.axshare.com/gsc/JK2WS3/7d/72/d7/7d72d709bc3b4c8cb808bfd8757274b5/images/register/u47.svg?pageId=c824c539-f06d-4c4c-aef8-7773a5e7e7fe" alt="Upload Icon">
                                    <span>Upload here the Signature or Thumbmark of the Senior Citizen</span>
                                </label>
                                <input type="file" id="image-signature" name="image-signature" class="imgbutton form-control" accept="image/*"  required> 
                            </div>
                        </div>
                        <div class="row spacingtop">
                            <div class="col-sm-12 text-center">
                                <input type="submit" value="Done" class="submitbtn btn btn-primary">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
    document.getElementById('image').addEventListener('change', function(event) {
        const file = event.target.files[0]; // Get the uploaded file
        const previewImage = document.getElementById('preview-image');

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                // Set the preview image's source to the uploaded file
                previewImage.src = e.target.result;
            };

            reader.readAsDataURL(file); // Convert the file into a data URL
        }
    });

    document.getElementById('image-documents').addEventListener('change', function(event) {
        const file = event.target.files[0]; // Get the first uploaded file
        const previewImage = document.getElementById('preview-documents');

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                // Set the preview image's source to the uploaded file
                previewImage.src = e.target.result;
            };

            reader.readAsDataURL(file); // Convert the file into a data URL
        }
    });

    // Preview uploaded image for signature
    document.getElementById('image-signature').addEventListener('change', function(event) {
        const file = event.target.files[0]; // Get the first uploaded file
        const previewImage = document.getElementById('preview-signature');

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                // Set the preview image's source to the uploaded file
                previewImage.src = e.target.result;
            };

            reader.readAsDataURL(file); // Convert the file into a data URL
        }
    });
</script>


<?php include './components/footer.php'; ?>  
</body>

</html>