<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Profile</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Bootstrap Ecommerce Template" name="keywords">
    <meta content="Bootstrap Ecommerce Template Free Download" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="lib/slick/slick.css" rel="stylesheet">
    <link href="lib/slick/slick-theme.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">


    <style>
    .list-group-item {
    position: relative;
    display: block;
    padding: .75rem 1.25rem;
    background-color: #3a6d8c;
    border: 1px solid rgba(0, 0, 0, .125);
    }
    .border {
    border: 1px solid #ead8b1 !important;
}
    </style>

</head>

<body>
<?php include("header.php");?>

    <!-- Profile Options Start -->
    <div class="container my-5">
        <div class="profile-options text-center">
            <h2 class="mb-4">Account Settings</h2>
            <ul class="list-group">
                <li class="list-group-item"><a href="view_profile.php">View Profile</a></li>
                <li class="list-group-item"><a href="pwd.php">Password Change</a></li>
                <li class="list-group-item"><a href="notification.php">Notifications</a></li>
                <li class="list-group-item"><a href="T&C.php">Terms and Conditions</a></li>
                <li><a href="#" onclick="confirmLogout(event)">Logout</a></li>
                <script>
                function confirmLogout(event) {
                    event.preventDefault(); // Prevent the default link behavior
                    const userConfirmed = confirm("Are you sure you want to logout?");
                    if (userConfirmed) {
                        window.location.href = 'login.php'; // Replace with your login page URL
                    }
                    // If "No" is clicked, nothing happens, and the user stays on the current page
                }
            </script>
            </ul>
        </div>
    </div>
    <!-- Profile Options End -->

    <?php include('footer.php');?>
    <!-- Back to Top -->
    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/slick/slick.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
</html>
