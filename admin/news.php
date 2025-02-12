<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

include '.././database/db_connection.php';

$sql = "SELECT * FROM news ORDER BY news_date DESC";
$stmt = $pdo->query($sql);
$newsList = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
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
        <h1>News List</h1>
        <button class="btn btn-success" data-toggle="modal" data-target="#newsModal" id="createBtn">Create New News</button><br><br>

        <div class="col-sm-12 formapplicants paddingtop">
            <table class="table table-striped table-hover spacingtop20">
                <thead>
                    <tr class="rowtable">
                        <th>Title</th>
                        <th>Date</th>
                        <th>Author</th> <!-- Added Author Column -->
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($newsList as $news): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($news['title']); ?></td>
                            <td><?php echo date('Y-m-d H:i', strtotime($news['news_date'])); ?></td>
                            <td><?php echo htmlspecialchars($news['author']); ?></td> <!-- Display Author -->
                            <td>
                                <button class="btn btn-warning editBtn"
                                        data-id="<?php echo isset($news['id']) ? $news['id'] : ''; ?>"
                                        data-title="<?php echo isset($news['title']) ? htmlspecialchars($news['title']) : ''; ?>"
                                        data-date="<?php echo isset($news['news_date']) ? date('Y-m-d\TH:i', strtotime($news['news_date'])) : ''; ?>"
                                        data-content="<?php echo isset($news['content']) ? htmlspecialchars(strip_tags($news['content'])) : ''; ?>"
                                        data-image_path="<?php echo isset($news['image_path']) ? htmlspecialchars($news['image_path']) : ''; ?>"
                                        data-headline="<?php echo isset($news['headline']) ? $news['headline'] : 0; ?>"
                                        data-author="<?php echo isset($news['author']) ? $news['author'] : ''; ?>"> <!-- Add author data -->
                                    Edit
                                </button>

                                <button class="btn btn-danger deleteBtn"
                                        data-id="<?php echo isset($news['id']) ? $news['id'] : ''; ?>">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <!-- Delete Confirmation Modal -->
                    <div id="deleteConfirmModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Confirm Deletion</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this news?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </tbody>
            </table>
        </div>

        <!-- Modal -->
        <div id="newsModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" id="modalTitle">Create News</h4>
                    </div>
                    <div class="modal-body">
                        <form id="newsForm">
                            <input type="hidden" name="id" id="newsId">
                            <div class="form-group">
                                <label for="title">News Title:</label>
                                <input type="text" class="form-control" name="title" id="newsTitle"
                                       required><br><br>
                            </div>
                       
                            <div class="form-group">
                                <label for="date">News Date:</label>
                                <input type="datetime-local" class="form-control" name="date" id="newsDate"
                                       required><br><br>
                            </div>
                            <div class="form-group">
                                <label for="author">Author:</label> <!-- Added Author Input -->
                                <input type="text" class="form-control" name="author" id="newsAuthor" required>
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
                                <textarea name="content" id="tiny" class="form-control" rows="5"></textarea>
                                <br><br>
                            </div>

                            <div class="form-group">
                                <label for="headline">Set as Headline:</label>
                                <input type="checkbox" name="headline" id="headlineCheckbox" value="1">
                            </div>

                            <button type="submit" class="btn btn-primary">Save News</button>
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
                $('#tiny').val(editor.getContent());
            });
        }
    });

    $('#createBtn').click(function() {
        $('#newsForm')[0].reset();
        $('#newsId').val('');
        $('#modalTitle').text('Create News');
        $('#headlineCheckbox').prop('checked', false); // Reset the headline checkbox
    });

    $('.editBtn').click(function() {
        const id = $(this).data('id');
        const title = $(this).data('title');
        const date = $(this).data('date');
        const content = $(this).data('content');
        const imagePath = $(this).data('image_path');
        const headline = $(this).data('headline');
        const author = $(this).data('author'); // Added author

        $('#newsId').val(id);
        $('#newsTitle').val(title);
        $('#newsDate').val(date);
        $('#newsAuthor').val(author); // Set author
        tinymce.get('tiny').setContent(content);

        if (imagePath) {
            $('#imagePreview').attr('src', imagePath).show();
            $('#existingImage').val(imagePath);
        } else {
            $('#imagePreview').hide();
            $('#existingImage').val('');
        }

        $('#headlineCheckbox').prop('checked', headline == 1); // Set the checkbox based on the headline status

        $('#modalTitle').text('Update News');
        $('#newsModal').modal('show');
    });

    $('#newsForm').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        formData.append('content', tinymce.get('tiny').getContent());

        // Append the headline value (whether the checkbox is checked)
        const headline = $('#headlineCheckbox').prop('checked') ? 1 : 0;
        formData.append('headline', headline);

        $.ajax({
            url: 'news_action.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#newsModal').modal('hide');
                location.reload();
            },
            error: function(xhr, status, error) {
                alert('Error: ' + error);
            }
        });
    });

</script>

</body>
</html>
