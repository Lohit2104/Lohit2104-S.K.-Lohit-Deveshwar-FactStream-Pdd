<?php
    // Start the session and check if the user is logged in
    session_start();

    // Include the database connection
    include("conn.php");

    // Check if the user is logged in by checking session variables
    if(isset($_SESSION['id'])){
        $user_id = $_SESSION['id'];

        // Query to fetch user details from the database
        $sql = "SELECT * FROM user WHERE id = '$user_id'";
        $result = $conn->query($sql);

        // Check if the query returns a result
        if($result->num_rows > 0) {
            // Fetch user data
            $user_data = $result->fetch_assoc();
        } else {
            // If no user found, redirect or handle accordingly
            echo "No user data found.";
        }
    } else {
        // If user is not logged in, redirect to login page
        header("Location: login.php");
        exit();
    }

    // Close the database connection
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Fact Stream - View Profile</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Fact Stream Profile Page" name="description">

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

    <div class="container my-5">
        <h2 class="text-center">View Profile</h2>

        <!-- View Profile Section -->
        <div class="profile-section bg-light p-4 rounded">
            <div class="row">
                <div class="col-md-4 text-center">
                    <img src="<?php echo isset($user_data['profile_picture']) ? htmlspecialchars($user_data['profile_picture']) : 'img/default-profile.png'; ?>" alt="Profile Picture" class="img-fluid rounded-circle" style="max-width: 200px;">
                </div>
                <div class="col-md-8">
                    <table class="table">
                        <tr>
                            <th>Email:</th>
                            <td><?php echo isset($user_data['email_id']) ? htmlspecialchars($user_data['email_id']) : 'N/A'; ?></td>
                        </tr>
                        <tr>
                            <th>Username:</th>
                            <td><?php echo isset($user_data['username']) ? htmlspecialchars($user_data['username']) : 'N/A'; ?></td>
                        </tr>
                        <tr>
                            <th>Name:</th>
                            <td><?php echo isset($user_data['name']) ? htmlspecialchars($user_data['name']) : 'N/A'; ?></td>
                        </tr>
                        <tr>
                            <th>DOB:</th>
                            <td><?php echo isset($user_data['dob']) ? htmlspecialchars($user_data['dob']) : 'N/A'; ?></td>
                        </tr>
                        <tr>
                            <th>Age:</th>
                            <td><?php echo isset($user_data['age']) ? htmlspecialchars($user_data['age']) : 'N/A'; ?></td>
                        </tr>
                        <tr>
                            <th>Gender:</th>
                            <td><?php echo isset($user_data['gender']) ? htmlspecialchars($user_data['gender']) : 'N/A'; ?></td>
                        </tr>
                    </table>
                    <a href="#edit-profile" class="btn btn-primary" data-toggle="modal">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div class="modal fade" id="edit-profile" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form method="POST" enctype="multipart/form-data" action="vprofile.php">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Profile</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email_id" class="form-control" value="<?php echo isset($user_data['email_id']) ? htmlspecialchars($user_data['email_id']) : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo isset($user_data['username']) ? htmlspecialchars($user_data['username']) : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo isset($user_data['name']) ? htmlspecialchars($user_data['name']) : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>DOB</label>
                            <input type="date" name="dob" class="form-control" value="<?php echo isset($user_data['dob']) ? htmlspecialchars($user_data['dob']) : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Age</label>
                            <input type="number" name="age" class="form-control" value="<?php echo isset($user_data['age']) ? htmlspecialchars($user_data['age']) : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender" class="form-control">
                                <option value="Male" <?php echo isset($user_data['gender']) && $user_data['gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
                                <option value="Female" <?php echo isset($user_data['gender']) && $user_data['gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
                                <option value="Other" <?php echo isset($user_data['gender']) && $user_data['gender'] == 'Other' ? 'selected' : ''; ?>>Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Profile Picture</label>
                            <input type="file" name="profile_picture" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="save_changes">Save Changes</button>
                    </div>
                </div>
            </form>
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

