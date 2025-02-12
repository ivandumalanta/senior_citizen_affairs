<!DOCTYPE html>
<html>

<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./asssets/css/sidenav.css">
    <link rel="stylesheet" href="./asssets/css/chat.css">


    <style>
        body {
          
            text-align: center;
            font-size: 12px;
            font-family: "Lucida Grande", Helvetica, Arial, Verdana, sans-serif;
        }

        #calendar {
            width: 900px;
            margin: 0 auto;
            
        }

        
        .success {
            background: #cdf3cd;
            padding: 10px 60px;
            border: #c3e6c3 1px solid;
            display: inline-block;
        }
        .fc {
    background-color: white !important; /* Set background color to white */
    border-radius: 8px; /* Optional: Add rounded corners for a cleaner look */
    padding: 10px; /* Optional: Add spacing inside the calendar */
}

/* Ensure the table cells have a white background */
.fc-day, .fc-widget-content {
    background-color: white !important;
}

/* Change the background of the header */
.fc-toolbar {
    background-color: white !important;
    padding: 10px;
    border-radius: 8px;
}

/* Ensure event cells and borders remain visible */
.fc-event {
    background-color: #007bff !important; /* Keep event colors distinct */
    color: white !important; /* Ensure event text is visible */
    border: none;
}

    </style>
</head>

<body>
<nav class="sidebar">
        <?php include '.././components/user-nav.php'; ?>
    </nav>
    <div class="main-content">
        <h2><b>Make an Appointment</b></h2>


    <div id='calendar'></div>
    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Schedule an Appointment</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="eventForm">
                    <div class="form-group">
                        <label for="eventTitle">Appointment Title</label>
                        <input type="text" class="form-control" id="eventTitle" required>
                    </div>
                    <div class="form-group">
                        <label for="timeSlot">Select Time Slot</label>
                        <select class="form-control" id="timeSlot">
                            <option value="08:00:00-09:00:00">8:00 AM - 9:00 AM</option>
                            <option value="09:00:00-10:00:00">9:00 AM - 10:00 AM</option>
                            <option value="10:00:00-11:00:00">10:00 AM - 11:00 AM</option>
                            <option value="11:00:00-12:00:00">10:00 AM - 12:00 PM</option>
                            <option value="13:00:00-14:00:00">01:00 PM - 02:00 PM</option>
                            <option value="14:00:00-15:00:00">02:00 PM - 03:00 PM</option>
                            <option value="15:00:00-16:00:00">03:00 PM - 04:00 PM</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="requestType">Request Type</label>
                        <select class="form-control" id="requestType">
                            <option value="Walk-in">Walk-in</option>
                            <option value="Document Submission">Document Submission</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-primary" id="saveEvent">Save Event</button>
                </form>
            </div>
        </div>
    </div>
</div>

    </div>



    <!-- Modal -->
 



    <script>
$(document).ready(function () {
    var calendar = $('#calendar').fullCalendar({
        editable: true,
        events: "fetch-event.php",
        displayEventTime: false,
        selectable: true,
        selectHelper: true,
        select: function (start, end) {
            var today = moment().startOf('day'); // Get today's date without time
            var selectedDate = moment(start).startOf('day'); // Get selected date without time
            var dayOfWeek = selectedDate.day(); // Get day of the week (0 = Sunday, 6 = Saturday)

            // Prevent past dates and weekends
            if (selectedDate.isBefore(today)) {
                alert("You cannot add appointment in the past.");
                $('#calendar').fullCalendar('unselect');
                return;
            }
            if (dayOfWeek === 0 || dayOfWeek === 6) {
                alert("You cannot add appointment on weekends.");
                $('#calendar').fullCalendar('unselect');
                return;
            }

            $('#eventModal').modal('show');

            $('#saveEvent').off('click').on('click', function () {
                var title = $('#eventTitle').val();
                var timeSlot = $('#timeSlot').val();
                var requestType = $('#requestType').val();

                if (title && timeSlot && requestType) {
                    var [slotStart, slotEnd] = timeSlot.split('-');

                    var formattedStart = moment(start).format("YYYY-MM-DD") + " " + slotStart;
                    var formattedEnd = moment(end).subtract(1, 'days').format("YYYY-MM-DD") + " " + slotEnd;

                    $.ajax({
                        url: 'add-event.php',
                        type: "POST",
                        data: {
                            title: title,
                            start: formattedStart,
                            end: formattedEnd,
                            request_type: requestType
                        },
                        success: function () {
                            displayMessage("Added Successfully");
                            $('#calendar').fullCalendar('refetchEvents');
                            $('#eventModal').modal('hide');
                        }
                    });
                } else {
                    alert("Please fill all fields");
                }
            });
        },
        eventClick: function (event) {
            var deleteMsg = confirm("Do you really want to delete?");
            if (deleteMsg) {
                $.ajax({
                    type: "POST",
                    url: "delete-event.php",
                    data: { id: event.id },
                    success: function () {
                        $('#calendar').fullCalendar('removeEvents', event.id);
                        displayMessage("Deleted Successfully");
                    }
                });
            }
        }
    });
});


function displayMessage(message) {
    $(".response").html("<div class='success'>" + message + "</div>");
    setInterval(function () { $(".success").fadeOut(); }, 1000);
}

    </script>

</body>

</html>
