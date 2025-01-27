<?php
session_start();
require 'conn.php';

// Get the fact ID from URL or POST
$user_id = $_GET['id'] ?? 0; // Assuming you're passing id in query string

// Initialize $facts as an empty array by default
$facts = [];

if ($user_id > 0) {
    // Query to fetch fact details
    $query = $conn->prepare("SELECT category, picture, title, content, created_at FROM submissions WHERE id = ?");
    $query->bind_param("i", $user_id);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $facts = $result->fetch_all(MYSQLI_ASSOC); // Fetch data as associative array
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Facts</title>

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <style>
        #comments-section {
    margin-top: 20px;
}
#comments-box {
    max-height: 300px;
    overflow-y: auto;
    padding: 10px;
    border: 1px solid #ddd;
    background: #6a98b0;
}

.comment {
    margin-bottom: 15px;
}

.comment strong {
    font-size: 1rem;
    color: #007bff;
}

.comment p {
    margin: 5px 0;
}

.comment small {
    color: #666;
}

#comment-form {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-top: 10px;
}

#comment-input {
    width: 100%;
    height: 60px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

#comment-form button {
    align-self: flex-end;
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

#comment-form button:hover {
    background-color: #0056b3;
}


</style>

</head>
<body>
<?php include("header.php");?>

    <!-- Fact Details Start -->
    <div class="container my-5">
    <h1 class="text-center">Welcome to Your Fact Page</h1>
    <?php if (!empty($facts)): ?>
        <div class="facts-list">
            <?php foreach ($facts as $fact): ?>
                <div class="fact-card card my-4 p-3">
                    <h1><?php echo htmlspecialchars($fact['title']); ?></h1>
                    <p><?php echo nl2br(htmlspecialchars($fact['content'])); ?></p>
                    <img src="<?php echo htmlspecialchars($fact['picture']); ?>" alt="Fact Image" style="width:200px;height:200px;">
                    <p>Category: <?php echo htmlspecialchars($fact['category']); ?></p>
                    <p>Created on: <?php echo htmlspecialchars($fact['created_at']); ?></p>


                    <!-- <form method="POST" action="bookmark.php">
                        <input type="hidden" name="submission_id" value="<?php echo $user_id; ?>">
                        <button type="submit" name="bookmark" class="btn btn-primary">Bookmark</button>
                    </form> -->

    
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center text-muted">No facts found for the provided ID. Try another one!</p>
    <?php endif; ?>
</div>
                    <form method="POST" action="bookmark.php">
                        <input type="hidden" name="submission_id" value="<?php echo $user_id; ?>">
                        <button type="submit" name="bookmark" class="btn btn-primary">Bookmark</button>
                    </form>

   <!-- Fact Details End -->
    <!-- Bookmark icon -->
    <!-- <form method="POST" action="bookmark.php">
        <input type="hidden" name="submission_id" value="">
        <button type="submit">Bookmark</button>
    </form> -->

    <!-- Comment Section -->
<div id="comments-section">
    <h3>Comments</h3>
    <div id="comments-box"></div>
    <form id="comment-form">
        <textarea id="comment-input" placeholder="Write a comment..." required></textarea>
        <input type="hidden" id="post-id" value="<?php echo $user_id; ?>"> <!-- Dynamically set post ID -->
        <button type="submit">Post Comment</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
    const postId = $('#post-id').val(); // Ensure the correct post ID is fetched for each post

    function loadComments() {
        $.ajax({
            url: 'load_comments.php',
            method: 'GET',
            data: { post_id: postId },
            dataType: 'json',
            success: function (data) {
                $('#comments-box').html('');
                if (data.length === 0) {
                    $('#comments-box').html('<p>No comments yet!</p>');
                    return;
                }
                data.forEach(comment => {
                    const commentHtml = `
                        <div class="comment">
                            <strong>${comment.username}</strong>
                            <p>${comment.comment}</p>
                            <small>${comment.created_at}</small>
                        </div>
                    `;
                    $('#comments-box').append(commentHtml);
                });
            },
            error: function (err) {
                console.error("Error loading comments", err);
            }
        });
    }

    $('#comment-form').submit(function (e) {
        e.preventDefault();
        const comment = $('#comment-input').val();

        if (comment.trim() === '') return;

        $.ajax({
            url: 'add_comment.php',
            method: 'POST',
            data: {
                post_id: postId,
                comment: comment
            },
            success: function (response) {
                $('#comment-input').val('');
                loadComments(); // Reload comments
            },
            error: function (err) {
                console.error("Error submitting comment", err);
            }
        });
    });

    loadComments(); // Load comments initially
});

</script>



<?php include('footer.php');?>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/slick/slick.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
   
</body>
</html>
