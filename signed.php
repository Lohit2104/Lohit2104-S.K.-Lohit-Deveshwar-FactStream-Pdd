<?php
// Include the database connection file
include('conn.php');

// Initialize an empty message
$message = "";

if (isset($_POST['submit'])) {
    // Retrieve and sanitize form inputs
    $username = trim($_POST['username']);
    $email_id = trim($_POST['email_id']);
    $password = $_POST['password'];

    // Validate password strength
    if (!preg_match('/^(?=.*[!@#$%^&*(),.?":{}|<>]).{8}$/', $password)) {
        echo "<script>
                alert('Password must be exactly 8 characters long and contain at least one special character.');
                window.location.href = 'signup.php';
              </script>";
        exit();
    }

    // Check if email or username already exists
    $check_query = $conn->prepare("SELECT * FROM user WHERE email_id = ? OR username = ?");
    $check_query->bind_param("ss", $email_id, $username);
    $check_query->execute();
    $result = $check_query->get_result();

    if ($result->num_rows > 0) {
        echo "<script>
                alert('Email or Username already exists. Please try again with a different email or username.');
                window.location.href = 'signup.php';
              </script>";
        exit();
    } else {
        $check_query->close();

        // Insert new user into the database using prepared statements
        $insert_query = $conn->prepare("INSERT INTO user (email_id, username, password) VALUES (?, ?, ?)");
        $insert_query->bind_param("sss", $email_id, $username, $password);

        if ($insert_query->execute()) {
            echo "<script>
                    alert('Successfully registered! Redirecting to login page...');
                    window.location.href = 'login.php';
                  </script>";
            exit();
        } else {
            echo "<script>
                    alert('Error occurred: " . $insert_query->error . "');
                    window.location.href = 'signup.php';
                  </script>";
            exit();
        }
        $insert_query->close();
    }
}

$conn->close();
?>
