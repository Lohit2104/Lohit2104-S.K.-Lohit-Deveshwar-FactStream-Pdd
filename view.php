<?php
$conn = new mysqli('localhost', 'root', '', 'userdb');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT title, content, picture, category FROM submissions WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo "<h1>" . htmlspecialchars($row['title']) . "</h1>";
    echo "<p><strong>Category:</strong> " . htmlspecialchars($row['category']) . "</p>";
    echo "<img src='" . htmlspecialchars($row['picture']) . "' alt='Image' style='max-width:100%;'><br>";
    echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
} else {
    echo "Submission not found.";
}

$conn->close();
?>
