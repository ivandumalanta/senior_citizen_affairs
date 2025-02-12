$(document).ready(function() {
  function generateCalendar() {
    var date = new Date();
    var month = date.getMonth(); // Current month
    var year = date.getFullYear(); // Current year
    var daysInMonth = new Date(year, month + 1, 0).getDate(); // Number of days in the month
    var firstDay = new Date(year, month, 1).getDay(); // Day of the week the month starts on
    var today = date.getDate(); // Today's date
    var currentMonth = date.toLocaleString('default', { month: 'long' }); // Get the month name
    var currentYear = date.getFullYear(); // Get the current year

    var calendarHtml = '<table class="table table-bordered calendar">';
    calendarHtml += '<thead><tr>';
    var currentYear = new Date().getFullYear();
  
  // Set the current year inside the <b> tag
  $('#current-year').text(currentYear);

    // Days of the week
    var daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    for (var i = 0; i < daysOfWeek.length; i++) {
      calendarHtml += '<th>' + daysOfWeek[i] + '</th>';
    }
    calendarHtml += '</tr></thead>';

    calendarHtml += '<tbody><tr>';

    // Empty cells before the first day of the month
    for (var i = 0; i < firstDay; i++) {
      calendarHtml += '<td></td>';
    }

    // Days of the current month
    for (var day = 1; day <= daysInMonth; day++) {
      if ((firstDay + day - 1) % 7 === 0 && day !== 1) {
        calendarHtml += '</tr><tr>';
      }
      
      var dayClass = (day === today) ? 'today' : '';
      calendarHtml += '<td class="' + dayClass + '">' + day + '</td>';
    }

    // Empty cells after the last day of the month
    while ((firstDay + daysInMonth) % 7 !== 0) {
      calendarHtml += '<td></td>';
      daysInMonth++;
    }

    calendarHtml += '</tr></tbody></table>';
    $('#calendar').html(calendarHtml);

    // Display today's date below the calendar
    $('#current-day').html('Today\'s Date: ' + currentMonth + ' ' + today + ', ' + currentYear);
  }

  generateCalendar(); // Call the function to display the calendar
});




// register pagge

