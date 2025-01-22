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
            <div class="upload-pic">
                <svg xmlns="http://www.w3.org/2000/svg" width="84" height="84" viewBox="0 0 24 24"><path fill="#045fb9" d="M19 13a1 1 0 0 0-1 1v.38l-1.48-1.48a2.79 2.79 0 0 0-3.93 0l-.7.7l-2.48-2.48a2.85 2.85 0 0 0-3.93 0L4 12.6V7a1 1 0 0 1 1-1h7a1 1 0 0 0 0-2H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3v-5a1 1 0 0 0-1-1M5 20a1 1 0 0 1-1-1v-3.57l2.9-2.9a.79.79 0 0 1 1.09 0l3.17 3.17l4.3 4.3Zm13-1a.9.9 0 0 1-.18.53L13.31 15l.7-.7a.77.77 0 0 1 1.1 0L18 17.21Zm4.71-14.71l-3-3a1 1 0 0 0-.33-.21a1 1 0 0 0-.76 0a1 1 0 0 0-.33.21l-3 3a1 1 0 0 0 1.42 1.42L18 4.41V10a1 1 0 0 0 2 0V4.41l1.29 1.3a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.42"/></svg>
                <span>
                    1x1 ID Picture
                </span>
            </div>
            <form action="" method="post">
                <label for="fname">OSCA ID number:</label>
                <input type="text" id="fname" name="fname"><br><br>
                <label for="fname">Last name:</label>
                <input type="text" id="fname" name="fname"><br><br>
                <label for="fname">First name:</label>
                <input type="text" id="fname" name="fname"><br><br>
                <label for="fname">Middle name:</label>
                <input type="checkbox" id="noMiddlename" />
                <input type="text" id="middlename"/>

                <div>
                    <div>
                        <label>Suffix:</label>
                        <label>
                            <input type="radio" name="suffix" value="WALA">
                            <span>WALA</span>
                        </label>
                        <label>
                            <input type="radio" name="suffix" value="JR">
                            <span>JR</span>
                        </label>
                        <label>
                            <input type="radio" name="suffix" value="SR">
                            <span>SR</span>
                        </label>
                        <label>
                            <input type="radio" name="suffix" value="I">
                            <span>I</span>
                        </label>
                        <label>
                            <input type="radio" name="suffix" value="II">
                            <span>II</span>
                        </label>
                        <label>
                            <input type="radio" name="suffix" value="III">
                            <span>III</span>
                        </label>
                        <label>
                            <input type="radio" name="suffix" value="IV">
                            <span>IV</span>
                        </label>
                        <label>
                            <input type="radio" name="suffix" value="V">
                            <span>V</span>
                        </label>
                    </div>

                    <!-- Sex Section -->
                    <div>
                        <label>Sex:</label>
                        <label>
                            <input type="radio" name="sex" value="MALE">
                            <span>MALE</span>
                        </label>
                        <label>
                            <input type="radio" name="sex" value="FEMALE">
                            <span>FEMALE</span>
                        </label>
                    </div>

                    <div>
                        <label>Birthday:</label>
                        <select>
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
                        <select>
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
                        <input type="text" placeholder="Enter Year">
                    </div>

                    <!-- Address Section -->
                    <div>
                        <label>Address:</label>
                        <input type="text" value="">
                        <span>Malasiqui, Pangasinan</span>
                    </div>

                    <!-- Phone Number Section -->
                    <div>
                        <label>Phone Number:</label>
                        <input type="text">
                    </div>
                    <div class="documents">
                        <div class="requirements">
                        <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24"><g fill="#045fb9" fill-rule="evenodd" clip-rule="evenodd"><path d="M13 10a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2H14a1 1 0 0 1-1-1"/><path d="M2 6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12c0 .556-.227 1.06-.593 1.422A1 1 0 0 1 20.5 20H4a2 2 0 0 1-2-2zm6.892 12l3.833-5.356l-3.99-4.322a1 1 0 0 0-1.549.097L4 12.879V6h16v9.95l-3.257-3.619a1 1 0 0 0-1.557.088L11.2 18z"/></g></svg>
                        <span>Upload here the Brgy. Certificate of Residency, Birth Certificate or 2 Valid Id's </span>

                        </div>
                        <div class="finger-print">
                        <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24"><g fill="#045fb9" fill-rule="evenodd" clip-rule="evenodd"><path d="M13 10a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2H14a1 1 0 0 1-1-1"/><path d="M2 6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12c0 .556-.227 1.06-.593 1.422A1 1 0 0 1 20.5 20H4a2 2 0 0 1-2-2zm6.892 12l3.833-5.356l-3.99-4.322a1 1 0 0 0-1.549.097L4 12.879V6h16v9.95l-3.257-3.619a1 1 0 0 0-1.557.088L11.2 18z"/></g></svg>
                        <span>
                        Upload here the Signature or Thumbmark of the Senior Citizen
                        </span>

                        </div>
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
  const noMiddlenameCheckbox = document.getElementById('noMiddlename');
  const middlenameInput = document.getElementById('middlename');

  noMiddlenameCheckbox.addEventListener('change', () => {
    if (noMiddlenameCheckbox.checked) {
      middlenameInput.disabled = true;
    } else {
      middlenameInput.disabled = false;
    }
  });
</script>
