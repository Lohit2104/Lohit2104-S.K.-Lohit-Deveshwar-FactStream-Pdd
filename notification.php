<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Fact Stream - Notifications</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Fact Stream Notifications" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- font awesome cdn link -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
<?php include("header.php");?>

    <!-- Notifications Page Start -->
    <div class="container my-5">
        <h2 class="text-center">Notifications</h2>
        <?php
        include('conn.php');    
        // Fetch notifications from the database
        $sql = "SELECT id, category, title, created_at FROM submissions ORDER BY created_at DESC LIMIT 10";
        $result = $conn->query($sql);

        if ($result->num_rows > 0): ?>
        <div class="notifications-section py-5">
            <ul class="list-group">
                <?php while ($row = $result->fetch_assoc()): ?>
                <li class="list-group-item">
                    <div>
                        <h5><?php echo htmlspecialchars($row['title']); ?></h5>
                        <p class="mb-1"><strong>Category:</strong> <?php echo htmlspecialchars($row['category']); ?></p>
                        <small class="text-muted">Uploaded on: <?php echo date("F j, Y, g:i a", strtotime($row['created_at'])); ?></small>
                    </div>
                </li>
                <?php endwhile; ?>
            </ul>
        </div>
        <?php else: ?>
        <div class="notifications-section text-center py-5">
            <i class="fas fa-bell fa-4x text-muted"></i>
            <h4 class="text-muted mt-3">No Notifications</h4>
            <p class="text-muted">We will notify you here when there are updates or new messages.</p>
        </div>
        <?php endif; ?>
    </div>
    <!-- Notifications Page End -->

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
