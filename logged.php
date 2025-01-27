<?php
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

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

    // Use Prepared Statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password); // Bind parameters safely
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a user with the given credentials exists
    if ($result->num_rows == 1) {
        // User is authenticated, set session variable to indicate login
        $_SESSION["logged_in"] = true;
        $userInfo = $result->fetch_assoc();
        $_SESSION["id"] = $userInfo["id"];
        $_SESSION["username"] = $userInfo["username"];

        header("Location: home.php");
        exit();
    } else {
        // Invalid credentials, show an error message
        echo "<script type='text/javascript'>
                alert('Invalid Username and Password');
                window.location.href='login.php';
              </script>";
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}
?>
