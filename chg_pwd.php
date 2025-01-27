<?php
session_start();
include("conn.php");
$id =  $_SESSION["id"];

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usersname = isset($_POST['name']) ? $_POST['name'] : ''; // Or use $_SESSION['username'] if using sessions
    $password = $_POST['password'];

    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        die("New password and confirmation do not match.");
    }

    $sql = "SELECT * FROM user WHERE password = '$password' AND id= $id";
    $result = $conn->query($sql);
        
    // Check if a user with the given credentials exists
    if ($result->num_rows == 1) {
        // User is authenticated, set session variable to indicate login
        $_SESSION["logged_in"] = true;
        $userInfo = $result->fetch_assoc();
        $id = $userInfo["id"];
        
        $sql = "UPDATE user SET password='$new_password' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
         
            echo "<script type='text/javascript'>alert('Profile Updated Successfully');window.location.href='pwd.php';</script>";
    
        } else {
            echo 'Error updating user details: ' . $conn->error;
        }

    }else{
        echo "<script type='text/javascript'>alert('Invalid Old Password');window.location.href='pwd.php';</script>";

    }
}

$conn->close();
?>