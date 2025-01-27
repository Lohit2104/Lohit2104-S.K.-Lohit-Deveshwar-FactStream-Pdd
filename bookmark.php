<?php
session_start();
include("conn.php");

// Ensure the session user ID and submission ID are set
if (isset($_POST['submission_id']) && isset($_SESSION['id'])) {
    $submission_id = $_POST['submission_id'];
    $user_id = $_SESSION['id']; // Logged-in user's ID

    // Check if this bookmark already exists
    $sql_check = "SELECT * FROM bookmarks WHERE user_id = ? AND submission_id = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("ii", $user_id, $submission_id);
    $stmt_check->execute();
    $result = $stmt_check->get_result();

    if ($result->num_rows > 0) {
        // If bookmark exists, remove it (unbookmark)
        $sql_delete = "DELETE FROM bookmarks WHERE user_id = ? AND submission_id = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("ii", $user_id, $submission_id);
        
        if ($stmt_delete->execute()) {
            echo "<script>alert('Bookmark removed successfully!'); window.location.href='fact_detail.php?id=$submission_id';</script>";
        } else {
            echo "Error: " . $stmt_delete->error;
        }
        $stmt_delete->close();
    } else {
        // If bookmark does not exist, add it
        $sql_insert = "INSERT INTO bookmarks (user_id, submission_id) VALUES (?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("ii", $user_id, $submission_id);
        
        if ($stmt_insert->execute()) {
            echo "<script>alert('Post added to bookmarks!'); window.location.href='fact_detail.php?id=$submission_id';</script>";
        } else {
            echo "Error: " . $stmt_insert->error;
        }
        $stmt_insert->close();
    }

    $stmt_check->close();
} else {
    echo "<script>alert('Error: Missing submission ID or user not logged in.'); window.location.href='login.php';</script>";
}

// Close the database connection
$conn->close();
?>

