<?php
include '.././database/db_connection.php'; // Ensure correct path

$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

// Prepare SQL query based on the selected filter
switch ($filter) {
    case 'today':
        $sql = "SELECT * FROM events WHERE DATE(start) = CURDATE() ORDER BY start ASC";
        break;
    case 'week':
        $sql = "SELECT * FROM events WHERE YEARWEEK(start, 1) = YEARWEEK(CURDATE(), 1) ORDER BY start ASC";
        break;
    case 'month':
        $sql = "SELECT * FROM events WHERE MONTH(start) = MONTH(CURDATE()) AND YEAR(start) = YEAR(CURDATE()) ORDER BY start ASC";
        break;
    default:
        $sql = "SELECT * FROM events ORDER BY start ASC";
        break;
}

try {
    $stmt = $conn->query($sql);
    $appointments = $stmt->fetch_all(MYSQLI_ASSOC);
} catch (Exception $e) {
    die("Error fetching appointments: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Appointments</title>    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="./assets/style.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<style>
    .appointments {
    padding: 20px;
    background-color: rgb(220, 237, 243);
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    align-content: stretch;
    justify-content: center;
    align-items: stretch;
    border-radius: 5px;
    height: 100%;
    filter: drop-shadow(5px 5px 2.5px rgba(0, 0, 0, 0.34901960784313724));

    }

    .rowtable{
        background-color: blue;
        color: white;
}
.table {
    border-collapse: collapse;
    border: none;
}

.table th, .table td {
    border: none !important;  /* Removes borders from table cells */
    padding: 10px;  /* Optional: Adjust spacing */
}

</style>
<body>
<nav class="sidebar">
        <?php include '.././components/admin-nav.php'; ?>
    </nav>
    <div class="main-content">
    <div class="container">
        <h2><strong>Appointments</strong></h2>
        <div class="col-sm-12 appointments">
              <!-- Filter Options -->
        <form method="GET" class="form-inline">
            <label for="filter">Filter:</label>
            <select name="filter" id="filter" class="form-control" onchange="this.form.submit()">
                <option value="all" <?= $filter == 'all' ? 'selected' : '' ?>>All</option>
                <option value="today" <?= $filter == 'today' ? 'selected' : '' ?>>Today</option>
                <option value="week" <?= $filter == 'week' ? 'selected' : '' ?>>This Week</option>
                <option value="month" <?= $filter == 'month' ? 'selected' : '' ?>>This Month</option>
            </select>
        </form>

        <br>

        <?php if (count($appointments) > 0): ?>
            <table class="table table-bordered">
                <tr class="rowtable">
                    <th>ID</th>
                    <th>Title</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Request Type</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($appointments as $row): ?>
                    <tr id="row-<?= $row['id'] ?>">
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['title']) ?></td>
                        <td><?= date("F j, Y g:i A", strtotime($row['start'])) ?></td>
                        <td><?= date("F j, Y g:i A", strtotime($row['end'])) ?></td>


                        <td><?= htmlspecialchars($row['request_type']) ?></td>
                        <td id="status-<?= $row['id'] ?>">
                            <?php 
                                if ($row['status'] == 'pending') {
                                    echo '<span class="label label-warning">Pending</span>';
                                } elseif ($row['status'] == 'accepted') {
                                    echo '<span class="label label-success">Accepted</span>';
                                } else {
                                    echo '<span class="label label-danger">Declined</span>';
                                }
                            ?>
                        </td>
                        <td>
                            <?php if ($row['status'] == 'pending'): ?>
                                <button class="btn btn-success btn-sm update-status" data-id="<?= $row['id'] ?>" data-status="accepted">Accept</button>
                                <button class="btn btn-danger btn-sm update-status" data-id="<?= $row['id'] ?>" data-status="declined">Decline</button>
                            <?php else: ?>
                                <span class="label label-default">No Actions</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <div class="alert alert-warning">No appointments found for the selected filter.</div>
        <?php endif; ?>
            </div>
      
    </div>
        </div>


    <script>
      $(document).ready(function() {
    $(".update-status").click(function() {
        var id = $(this).data("id");
        var status = $(this).data("status");
        var button = $(this);
        var statusText = status === "accepted" ? "accept" : "decline";

        Swal.fire({
            title: "Are you sure?",
            text: "Do you really want to " + statusText + " this appointment?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, " + statusText + " it!",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "update_status.php",
                    type: "POST",
                    data: { id: id, status: status },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            $("#status-" + id).html(
                                status === "accepted"
                                    ? '<span class="label label-success">Accepted</span>'
                                    : '<span class="label label-danger">Declined</span>'
                            );
                            button.closest("td").html('<span class="label label-default">No Actions</span>');

                            Swal.fire({
                                icon: "success",
                                title: "Success!",
                                text: "Appointment " + status + " successfully.",
                                timer: 2000,
                                showConfirmButton: false
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Error!",
                                text: response.message
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: "error",
                            title: "Error!",
                            text: "Something went wrong."
                        });
                    }
                });
            }
        });
    });
});

    </script>
</body>
</html>
