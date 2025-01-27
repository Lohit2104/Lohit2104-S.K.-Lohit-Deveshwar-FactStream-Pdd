<?php
session_start();
require_once 'conn.php'; // Include your database connection file

date_default_timezone_set('Asia/Kolkata'); // Replace with your timezone

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    echo "User not logged in.";
    exit();
}

$userId = $_SESSION['id'];
$message = $_POST['message'];
$createdAt = date('Y-m-d H:i:s');

// Insert message into the database
$query = "INSERT INTO messages (user_id, message, created_at) 
          VALUES ('$userId', '$message', '$createdAt')";

if (mysqli_query($conn, $query)) {
    echo "Message sent.";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
