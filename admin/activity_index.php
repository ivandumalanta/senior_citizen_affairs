<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
include '.././database/db_connection.php';

$sql = "SELECT * FROM activities ORDER BY activity_date DESC";
$stmt = $pdo->query($sql);
$activities = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activities</title>
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/9zpa5zr8ynaahayymw4ncblg9b5scwbzeu3phvzayidn3rws/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'anchor autolink charmap codesample emoticons link lists searchreplace visualblocks',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough  | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
    </script>
</head>

<body>

    <nav class="navbar">
        <?php include '.././components/admin-nav.php'; ?>
    </nav>
    <div class="main-content">
        
        <div class="container">
        <h1>Activities List</h1>
                <button class="btn btn-success" data-toggle="modal" data-target="#activityModal" id="createBtn">Create
                    New Activity</button><br><br>
        <div class="col-sm-12 formapplicants paddingtop" >

                <table class="table table-striped table-hover spacingtop20">
                    <thead>
                        <tr class="rowtable">
                            <th>Title</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($activities as $activity): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($activity['title']); ?></td>
                            <td><?php echo date('Y-m-d H:i', strtotime($activity['activity_date'])); ?></td>
                            <td>
                                <button class="btn btn-warning editBtn" data-id="<?php echo $activity['id']; ?>"
                                    data-title="<?php echo htmlspecialchars($activity['title']); ?>"
                                    data-date="<?php echo date('Y-m-d\TH:i', strtotime($activity['activity_date'])); ?>"
                                    data-content="<?php echo htmlspecialchars($activity['content']); ?>"
                                    data-image_path="<?php echo htmlspecialchars($activity['image_path']); ?>">Edit</button>

                                <button class="btn btn-danger deleteBtn"
                                    data-id="<?php echo $activity['id']; ?>">Delete</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Delete Confirmation Modal (Moved outside of loop) -->
            <div id="deleteConfirmModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Confirm Deletion</h4>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this activity?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for Creating/Editing Activity -->
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
                                    <input type="text" class="form-control" name="title" id="activityTitle"
                                        required><br><br>
                                </div>

                                <div class="form-group">
                                    <label for="date">Activity Date:</label>
                                    <input type="datetime-local" class="form-control" name="date" id="activityDate"
                                        required><br><br>
                                </div>
                                <div class="form-group">
                                    <label for="content">Featured Photo</label>
                                    <input type="file" id="image" name="image" accept="image/*" class="form-control">
                                    <br>
                                    <img id="imagePreview" src="" alt="Current Image"
                                        style="max-width: 400px; display: none;">
                                    <input type="hidden" id="existingImage" name="existing_image">
                                </div>
                                <div class="form-group">
                                    <label for="content">Content:</label>
                                    <div id="imagePreview"></div>
                                    <textarea name="content" id="tiny" class="form-control" rows="5"></textarea>
                                    <br><br>
                                </div>

                                <button type="submit" class="btn btn-primary">Save Activity</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
          </div> 
        </div>

        <script>
        tinymce.init({
            selector: '#tiny',
            plugins: 'image link code',
            toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright | link image | code',
            setup: function(editor) {
                editor.on('change', function() {
                    // Update the textarea with TinyMCE content
                    $('#tiny').val(editor.getContent());
                });
            }
        });

        // Show Create Modal
        $('#createBtn').click(function() {
            $('#activityForm')[0].reset();
            $('#activityId').val('');
            $('#modalTitle').text('Create Activity');
        });

        // Edit Activity Button
        $('.editBtn').click(function() {
            const id = $(this).data('id');
            const title = $(this).data('title');
            const date = $(this).data('date');
            const content = $(this).data('content');
            const imagePath = $(this).data('image_path'); // Get the image path

            // Set values into the modal form fields
            $('#activityId').val(id);
            $('#activityTitle').val(title);
            $('#activityDate').val(date);
            tinymce.get('tiny').setContent(content);

            if (imagePath) {
                $('#imagePreview').attr('src', imagePath).show();
                $('#existingImage').val(imagePath); // Store existing image path
            } else {
                $('#imagePreview').hide();
                $('#existingImage').val(''); // No existing image
            }
            $('#modalTitle').text('Update Activity');
            $('#activityModal').modal('show');
        });

        // Submit the form via AJAX
        $('#activityForm').submit(function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            formData.append('content', tinymce.get('tiny').getContent()); // Append TinyMCE content manually

            $.ajax({
                url: 'activity_action.php',
                type: 'POST',
                data: formData,
                processData: false, // Important for file uploads
                contentType: false, // Important for file uploads
                success: function(response) {
                    $('#activityModal').modal('hide');
                    loadActivities();
                },
                error: function(xhr, status, error) {
                    alert('Error: ' + error);
                }
            });
        });

        let deleteId = null;

        // Use event delegation for dynamically added delete buttons
        $(document).on('click', '.deleteBtn', function() {
            deleteId = $(this).data('id'); // Store ID of the activity to delete
            $('#deleteConfirmModal').modal('show');
        });

        // Handle delete confirmation
        $('#confirmDeleteBtn').click(function() {
            if (deleteId) {
                $.ajax({
                    url: 'delete_activity.php',
                    type: 'GET',
                    data: { id: deleteId },
                    success: function(response) {
                        $('#deleteConfirmModal').modal('hide'); // Hide modal
                        loadActivities(); // Reload activities
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
