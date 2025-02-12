<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senior citizen affairs</title>
    <link rel="stylesheet" href="assets/css/styleHome.css"> <!-- Link to external CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>

<nav class="navbar">
        <?php include './components/nav.php'; ?>
    </nav>
    <main class="heromain">
    <div class="container">
    <h1><b>VERIFICATION BY NAME AND BIRTHDAY</b></h1>
    <p>To verify using this option, you will be required to enter exactly the name and birth date as entered in your registration record, particularly in spelling and the exact date of birth. With just a slight difference on these entries, your record cannot be retrieved.</p>

    <form action="verify_function.php" method="POST">
        <!-- ENTER COMPLETE NAME -->
        <div class="form-section">
            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" required>

            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" required>

            <label for="middle_name" class="spacingtop">Middle name:</label>
            <input type="checkbox" id="no_middlename" name="no_middlename" /> No Middlename
            <input type="text" id="middle_name" name="middle_name" required>
        </div>

        <!-- ENTER BIRTHDAY -->
        <div class="form-section">
            <label for="month">Enter Birthday</label>
            <select id="month" name="month" required>
                <option value="">Select Month</option>
                <option value="01">January</option>
                <option value="02">February</option>
                <option value="03">March</option>
                <option value="04">April</option>
                <option value="05">May</option>
                <option value="06">June</option>
                <option value="07">July</option>
                <option value="08">August</option>
                <option value="09">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>

            <select id="date" name="date" required>
                <option value="">Select Date</option>
                <!-- Options for date 1-31 (you can generate dynamically) -->
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
                <!-- Add other date options here -->
            </select>

            <input type="text" id="year" name="year" placeholder="Enter Year" required>
        </div>

        <!-- SUFFIX -->
        <div class="form-section">
            <label>Suffix:</label>
            <div class="radio-group">
                <label><input type="radio" name="suffix" value="WALA"> WALA</label>
                <label><input type="radio" name="suffix" value="JR"> JR</label>
                <label><input type="radio" name="suffix" value="SR"> SR</label>
                <label><input type="radio" name="suffix" value="I"> I</label>
                <label><input type="radio" name="suffix" value="II"> II</label>
                <label><input type="radio" name="suffix" value="III"> III</label>
                <label><input type="radio" name="suffix" value="IV"> IV</label>
                <label><input type="radio" name="suffix" value="V"> V</label>
            </div>
        </div>
        <!-- Submit Button -->
        <div class="buttons">
            <button type="submit">Submit</button>
            <button type="reset">Cancel</button>
        </div>
    </form>
</div>
    </div>
</main>
<?php include './components/footer.php'; ?>  
</body>
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
</html>