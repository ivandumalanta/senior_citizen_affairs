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
    <link rel="stylesheet" href="assets/css/style.css"> <!-- Link to external CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <nav>
        <?php include './components/nav.php'; ?>
    </nav>

    <main>
        <section id="section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <div class="department">
                            <p class="font32"><b>Office of Senior Citizen Affairs</b> <br> <span class="font24">Malasiqui</span></p>
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
                            <input type="file" id="image" name="image">
                            <span>
                                1x1 ID Picture
                            </span>
                        </div>
                    </div>
                </div>

                <div class="container spacingtop">
                    <div class="col-sm-12 font23">
                        <label for="osca_id">OSCA ID number:</label>
                        <input type="number" id="osca_id" name="osca_id"><br><br>

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
                        <input type="number" name="phone_number"><br><br>

                        <div class="documents">
                            <div class="requirements">
                            <input type="file" id="image-documents" name="image-documents[]" multiple>
                                <span>Upload here the Brgy. Certificate of Residency, Birth Certificate or 2 Valid Id's</span>
                            </div>
                            <div class="finger-print">
                            <input type="file" id="image-signature" name="image-signature">
                                <span>Upload here the Signature or Thumbmark of the Senior Citizen</span>
                            </div>
                        </div>

                        <input type="submit" value="Submit" ">
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
</script>