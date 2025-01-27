<?php
// Database connection
include("conn.php");

// Query to fetch the latest submissions
$sql = "SELECT id, category, title, created_at FROM submissions ORDER BY created_at DESC LIMIT 10"; // Fetch the 10 most recent entries
$result = $conn->query($sql);

$notifications = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notifications[] = $row;
    }
}

// Return notifications as JSON for AJAX (if needed) or directly render them
header('Content-Type: application/json');
echo json_encode($notifications);

$conn->close();
?>
