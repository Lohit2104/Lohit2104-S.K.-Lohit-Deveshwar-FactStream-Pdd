<?php
session_start();
include 'conn.php';

// Redirect to login if not authenticated
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['id'];

// Fetch bookmarks and related submission details
try {
    $query = $conn->prepare("
        SELECT s.id, s.picture, s.title, s.content, s.category, s.created_at 
        FROM submissions s 
        JOIN bookmarks b ON s.id = b.submission_id 
        WHERE b.user_id = ?
    ");
    $query->bind_param("i", $user_id);
    $query->execute();

    $result = $query->get_result();

    if (!$result) {
        throw new Exception("Failed to fetch bookmarks: " . $conn->error);
    }

    $bookmarks = $result->fetch_all(MYSQLI_ASSOC); // Fetch all bookmarks at once
    $query->close();
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Fact Stream - Bookmarks</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Fact Stream Bookmarks" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <style>
        .bookmarks-container {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-top: 2rem;
        }

        .bookmark {
            display: flex;
            align-items: center;
            gap: 1rem;
            border: 1px solid #ddd;
            padding: 1rem;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .bookmark-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }

        .bookmark-details {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .bookmark-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
            margin: 0;
            text-decoration: none;
        }

        .bookmark-category,
        .bookmark-date {
            font-size: 0.9rem;
            color: #666;
        }
    </style>
</head>

<body>
    <?php include("header.php"); ?>

    <div class="container bookmarks-container">
        <h2 class="mb-4">Your Bookmarked Submissions</h2>
        <?php if (!empty($bookmarks)): ?>
            <?php foreach ($bookmarks as $bookmark): ?>
                <div class="bookmark">
                    <img src="<?php echo htmlspecialchars($bookmark['picture']); ?>" alt="Thumbnail" class="bookmark-image">
                    <div class="bookmark-details">
                        <a href="fact_detail.php?id=<?php echo htmlspecialchars($bookmark['id']); ?>" class="bookmark-title">
                            <?php echo htmlspecialchars($bookmark['title']); ?>
                        </a>
                        <span class="bookmark-category">
                            <strong>Category:</strong> <?php echo htmlspecialchars($bookmark['category']); ?>
                        </span>
                        <span class="bookmark-date">
                            <strong>Created At:</strong> <?php echo htmlspecialchars($bookmark['created_at']); ?>
                        </span>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">No bookmarks found.</p>
        <?php endif; ?>
    </div>

    <?php include('footer.php'); ?>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/slick/slick.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
</html>
