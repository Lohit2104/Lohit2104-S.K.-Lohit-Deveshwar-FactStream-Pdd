<?php
session_start();
include('conn.php');

// Ensure user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Check if ID is provided
if (isset($_GET['id'])) {
    $submission_id = intval($_GET['id']); // Sanitize input

    try {
        // Begin transaction
        $conn->begin_transaction();

        // Step 1: Delete related bookmarks
        $stmt1 = $conn->prepare("DELETE FROM bookmarks WHERE submission_id = ?");
        $stmt1->bind_param("i", $submission_id);
        $stmt1->execute();
        $stmt1->close();

        // Step 2: Delete submission
        $stmt2 = $conn->prepare("DELETE FROM submissions WHERE id = ?");
        $stmt2->bind_param("i", $submission_id);
        $stmt2->execute();
        $stmt2->close();

        // Commit transaction
        $conn->commit();

        echo "<script>alert('Upload deleted successfully!'); window.location.href='adduploads.php';</script>";
    } catch (mysqli_sql_exception $e) {
        // Rollback on error
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}

// Close connection
$conn->close();
?>
