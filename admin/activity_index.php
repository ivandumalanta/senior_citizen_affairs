<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
include '.././database/db_connection.php';

$sql = "SELECT * FROM activities ORDER BY date DESC";
$stmt = $pdo->query($sql);
$activities = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activities</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
    <nav class="navbar">
    <?php include '.././components/admin-nav.php'; ?>
    </nav>
        <h1>Activities List</h1>
        <button class="btn btn-primary" data-toggle="modal" data-target="#activityModal" id="createBtn">Create New Activity</button><br><br>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($activities as $activity): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($activity['title']); ?></td>
                        <td><?php echo date('Y-m-d H:i', strtotime($activity['date'])); ?></td>
                        <td>
                            <button class="btn btn-warning editBtn" data-id="<?php echo $activity['id']; ?>" data-title="<?php echo htmlspecialchars($activity['title']); ?>" data-date="<?php echo date('Y-m-d\TH:i', strtotime($activity['date'])); ?>">Edit</button>
                            <button class="btn btn-danger deleteBtn" data-id="<?php echo $activity['id']; ?>">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div id="activityModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="modalTitle">Create Activity</h4>
                </div>
                <div class="modal-body">
                    <form id="activityForm">
                        <input type="hidden" name="id" id="activityId">
                        <div class="form-group">
                            <label for="title">Activity Title:</label>
                            <input type="text" class="form-control" name="title" id="activityTitle" required><br><br>
                        </div>
                        <div class="form-group">
                            <label for="date">Activity Date:</label>
                            <input type="datetime-local" class="form-control" name="date" id="activityDate" required><br><br>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Activity</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Show Create Modal
        $('#createBtn').click(function() {
            $('#activityForm')[0].reset();
            $('#activityId').val('');
            $('#modalTitle').text('Create Activity');
        });

        // Show Edit Modal with pre-filled data
        $('.editBtn').click(function() {
            const id = $(this).data('id');
            const title = $(this).data('title');
            const date = $(this).data('date');

            $('#activityId').val(id);
            $('#activityTitle').val(title);
            $('#activityDate').val(date);
            $('#modalTitle').text('Update Activity');
            $('#activityModal').modal('show');
        });

        // Submit the form via AJAX
        $('#activityForm').submit(function(e) {
            e.preventDefault();
            const formData = $(this).serialize();

            $.ajax({
                url: 'activity_action.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    // Close the modal and reload the page content dynamically
                    $('#activityModal').modal('hide');
                    loadActivities();
                },
                error: function(xhr, status, error) {
                    alert('Error: ' + error);
                }
            });
        });

        // Delete activity
        $('.deleteBtn').click(function() {
            const id = $(this).data('id');
            if (confirm("Are you sure you want to delete this activity?")) {
                $.ajax({
                    url: 'delete_activity.php',
                    type: 'GET',
                    data: { id: id },
                    success: function(response) {
                        loadActivities();
                    },
                    error: function(xhr, status, error) {
                        alert('Error: ' + error);
                    }
                });
            }
        });

        // Load activities dynamically (after Create or Update)
        function loadActivities() {
            $.ajax({
                url: 'activity_index.php',
                success: function(response) {
                    $('tbody').html($(response).find('tbody').html());
                }
            });
        }
    </script>
</body>
</html>
