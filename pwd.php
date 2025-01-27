

<?php
        session_start();
        
        $id =  $_SESSION["id"];
            // Database connection settings
            $servername = "localhost";
            $db_username = "root";
            $db_password = "";
            $dbname = "userdb"; // Replace with your actual database name
            
            // Create connection
            $conn = new mysqli($servername, $db_username, $db_password, $dbname, 3307);
        
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
        
            $sql = "SELECT * FROM user WHERE id= $id";
            
            // Execute the query
            $result = $conn->query($sql);
        
            // Check if a user with the given credentials exists
            if ($result->num_rows == 1) {
                // User is authenticated, set session variable to indicate login
                $_SESSION["logged_in"] = true;
                $userInfo = $result->fetch_assoc();
                $_SESSION["id"] = $userInfo["id"];
                $_SESSION["username"] = $userInfo["username"];
                
              
                $users = $userInfo["username"];
                $passkey = $userInfo["password"];
                    
                
            }
            // Close the database connection
            $conn->close();
        
        ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Fact Stream - Change Password</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Fact Stream Password Change" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
<?php include("header.php");?>

    <!-- Change Password Section -->
    <div class="container my-5">
        <h2 class="text-center">Change Password</h2>
        <p class="text-muted text-center">Update your account password below.</p>
        <div class="row justify-content-center">
            <div class="col-md-6">
            <form action="chg_pwd.php" method="POST" class="p-4 border rounded">
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="name" class="form-control" value="<?php echo htmlspecialchars($users); ?>" readonly>
    </div>
    <div class="form-group">
        <label for="password">Current Password:</label>
        <input type="password" name="password"  class="form-control" value="<?php echo htmlspecialchars($passkey); ?>"  placeholder="Enter current password" required>
    </div>
    <div class="form-group">
        <label for="new-password">New Password:</label>
        <input type="password" name="new_password" id="new-password" class="form-control" placeholder="Enter new password" required>
    </div>
    <div class="form-group">
        <label for="confirm-password">Confirm New Password:</label>
        <input type="password" name="confirm_password" id="confirm-password" class="form-control" placeholder="Confirm new password" required>
    </div>
    <button type="submit" class="btn btn-primary btn-block">Update Password</button>
</form>


            </div>
        </div>
    </div>
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
