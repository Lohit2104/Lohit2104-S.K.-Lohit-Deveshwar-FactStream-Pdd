<?php
include("conn.php");
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['searchQuery'])) {
    $searchQuery = $conn->real_escape_string($_GET['searchQuery']);

    // Search query to find matching category or title
    $sql = "SELECT `id`, `category`, `picture`, `title`, `content`, `user_id`, `created_at` 
            FROM `submissions` 
            WHERE `category` LIKE '%$searchQuery%' OR `title` LIKE '%$searchQuery%'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Redirect to category-specific page (first match for simplicity)
        $row = $result->fetch_assoc();
        $category = $row['category'];
        header("Location: category_page.php?category=" . urlencode($category));
        exit();
    } else {
        echo "No results found.";
    }
}

$conn->close();
?>
