<?php
session_start();
include("conn.php"); // Ensure this file contains your database connection settings

// Check if the user is logged in
if (!isset($_SESSION["id"])) {
    header('Location: login.php');
    exit();
}

// Get the user ID from the session
$id = $_SESSION["id"];

// Fetch user details from the database
$sql = "SELECT * FROM user WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id); // Use prepared statement
$stmt->execute();
$result = $stmt->get_result();

// Check if the user exists in the database
if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
} else {
    echo "<script>alert('User not found. Please log in again.'); window.location.href='login.php';</script>";
    exit();
}

// Update user profile if the form is submitted
if (isset($_POST['save_changes'])) {
    // Get form data
    $email = $_POST['email_id'];
    $username = $_POST['username'];
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];

    // Handle file upload for profile picture
    if (!empty($_FILES['profile_picture']['name'])) {
        $target_dir = "uploads/"; // Ensure this directory exists and is writable
        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            $profile_picture = $target_file;
        } else {
            echo "<script>alert('Error uploading file.');</script>";
            $profile_picture = $user_data['profile_picture']; // Fallback to old picture
        }
    } else {
        $profile_picture = $user_data['profile_picture'];
    }

    // Update user data in the database
    $update_sql = "UPDATE user SET 
                    email_id = ?, 
                    username = ?, 
                    name = ?, 
                    dob = ?, 
                    age = ?, 
                    gender = ?, 
                    profile_picture = ? 
                    WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param(
        "ssssissi",
        $email,
        $username,
        $name,
        $dob,
        $age,
        $gender,
        $profile_picture,
        $id
    );

    if ($update_stmt->execute()) {
        echo "<script>alert('Profile updated successfully'); window.location.href='view_profile.php';</script>";
    } else {
        echo "<script>alert('Error updating profile: " . $conn->error . "');</script>";
    }
}

// Close the database connection
$conn->close();
?>
