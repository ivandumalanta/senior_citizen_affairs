<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Senior Citizen Affairs</title>
  <link rel="stylesheet" href="assets/css/styleHome.css"> <!-- Link to external CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  
  <!-- jQuery and Bootstrap JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

  <nav class="navbar">
    <?php include './components/nav.php'; ?>
  </nav>

  <main class="heromain">
    <div class="container">
      <div class="text-center">
        <h1><b>VERIFICATION BY NAME AND BIRTHDAY</b></h1>
        <p>To verify using this option, you will be required to enter exactly the name and birth date as entered in your registration record, particularly in spelling and the exact date of birth. With just a slight difference on these entries, your record cannot be retrieved.</p>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">
          Open Form
        </button>
      </div>

      <!-- Modal -->
      <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Enter Your Details</h4>
            </div>
            <div class="modal-body">
              <form id="verifyForm" action="verify_function.php" method="POST">
                <!-- ENTER COMPLETE NAME -->
                <div class="form-group">
                  <label for="last_name">Last Name</label>
                  <input type="text" id="last_name" name="last_name" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="first_name">First Name</label>
                  <input type="text" id="first_name" name="first_name" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="middle_name">Middle Name:</label>
                  <input type="checkbox" id="no_middlename" name="no_middlename"> No Middlename
                  <input type="text" id="middle_name" name="middle_name" class="form-control" required>
                </div>
                
                <!-- ENTER BIRTHDAY -->
                <div class="form-group">
                  <label>Enter Birthday</label>
                  <div class="row">
                    <div class="col-xs-4">
                      <select id="month" name="month" class="form-control" required>
                        <option value="">Month</option>
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
                    </div>
                    <div class="col-xs-4">
                      <select id="date" name="date" class="form-control" required>
                        <option value="">Date</option>
                        <!-- Options for date 1-31 -->
                        <script>
                          for (let i = 1; i <= 31; i++) {
                            document.write('<option value="' + i + '">' + i + '</option>');
                          }
                        </script>
                      </select>
                    </div>
                    <div class="col-xs-4">
                      <input type="text" id="year" name="year" class="form-control" placeholder="Year" required>
                    </div>
                  </div>
                </div>
                
                <!-- SUFFIX -->
                <div class="form-group">
                  <label>Suffix:</label>
                  <div class="radio">
                    <label><input type="radio" name="suffix" value=""> WALA</label>
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
                <div class="form-group text-center">
                  <button type="submit" class="btn btn-danger" id="submitBtn">Submit</button>
                  <button type="reset" class="btn btn-default">Cancel</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- End of Modal -->

    </div>
  </main>

  <?php include './components/footer.php'; ?>

  <script>
    // Disable Middle Name input when "No Middlename" is checked
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

    // jQuery AJAX form submission with SweetAlert modal and processing button text
    $(document).ready(function() {
      $('#verifyForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Change the submit button text to "Processing..." and disable it
        var $submitButton = $('#submitBtn');
        $submitButton.prop('disabled', true).text('Processing...');

        // Serialize the form data
        var formData = $(this).serialize();

        // Submit the form using AJAX
        $.ajax({
          url: $(this).attr('action'),
          type: $(this).attr('method'),
          data: formData,
          dataType: 'json', // Expect a JSON response
          success: function(response) {
            // Reset the button text and enable it for future submissions
            $submitButton.prop('disabled', false).text('Submit');

            if (response.status === 'success') {
              // Close the "Enter Your Details" modal
              $('#myModal').modal('hide');

              // Display a SweetAlert modal with email confirmation details and a Resend Email option
              Swal.fire({
                icon: 'success',
                title: 'Check Your Email',
                html: "We've sent a confirmation email to: <strong>" + response.email + "</strong><br>Please click the link in the email to verify your account.",
                showCancelButton: true,
                confirmButtonText: 'Resend Email',
                cancelButtonText: 'Close'
              }).then((result) => {
                if (result.isConfirmed) {
                  // Trigger the resend email AJAX function
                  $.ajax({
                    url: 'resend_email.php',
                    type: 'POST',
                    data: { email: response.email },
                    dataType: 'json',
                    success: function(resendResponse) {
                      if (resendResponse.status === 'success') {
                        Swal.fire({
                          icon: 'success',
                          title: 'Email Resent',
                          text: resendResponse.message
                        });
                      } else {
                        Swal.fire({
                          icon: 'error',
                          title: 'Error',
                          text: resendResponse.message
                        });
                      }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                      console.error('Resend AJAX Error:', textStatus, errorThrown);
                      Swal.fire({
                        icon: 'error',
                        title: 'AJAX Error',
                        text: 'An error occurred while resending the email.'
                      });
                    }
                  });
                }
              });
            } else {
              // Display an error message using SweetAlert
              Swal.fire({
                icon: 'error',
                title: 'Error',
                text: response.message
              });
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
            // Reset the button text and enable it
            $submitButton.prop('disabled', false).text('Submit');
            console.error('AJAX Error:', textStatus, errorThrown);
            Swal.fire({
              icon: 'error',
              title: 'AJAX Error',
              text: 'An error occurred. Please try again.'
            });
          }
        });
      });
    });
  </script>
</body>
</html>
