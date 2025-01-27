<?php
session_start(); // Start session at the very beginning before any output

include('conn.php');

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['id']; // Get logged-in user's ID

// Fetch user's submissions only
$sql = "SELECT id, category, picture, title, created_at FROM submissions WHERE user_id = '$user_id' ORDER BY created_at DESC";
$result = $conn->query($sql);

$submissions = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $submissions[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Fact Stream</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Bootstrap Ecommerce Template" name="keywords">
    <meta content="Bootstrap Ecommerce Template Free Download" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="lib/slick/slick.css" rel="stylesheet">
    <link href="lib/slick/slick-theme.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
<?php include("header.php");?>

   <!-- Add Button Start -->
<div class="container my-5 text-center">
    <h2 class="text-light">Submit News or Fact</h2>
    <a href="upload.php" class="btn btn-primary">Add +</a>

    <?php if (!empty($submissions)): ?>
        <?php foreach ($submissions as $row): ?>
            <div class="fact-item mb-4">
                <div class="fact-image">
                    <img src="<?php echo htmlspecialchars($row['picture']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>" class="img-fluid" style="width:200px;height:200px">
                </div>
                <div class="fact-title">
                    <a href="fact_detail.php?id=<?php echo $row['id']; ?>" class="fact-link">
                        <h3 class="text-center"><?php echo htmlspecialchars($row['title']); ?></h3>
                    </a>
                    <p class="text-muted text-center"><?php echo htmlspecialchars(date("F d, Y", strtotime($row['created_at']))); ?></p>
                </div>
                <!-- Delete Button Start -->
                <div class="text-center mt-2">
                    <a href="delete_upload.php?id=<?php echo $row['id']; ?>" 
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Are you sure you want to delete this upload?');">
                        🗑️ Delete
                    </a>
                </div>
                <!-- Delete Button End -->
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-center">No submissions found.</p>
    <?php endif; ?>
</div>
<!-- Add Button End -->


    <?php include('footer.php');?>

    <!-- Back to Top -->
    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/slick/slick.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
