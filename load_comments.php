<?php
session_start();
require_once 'conn.php';

if (!isset($_GET['post_id']) || empty($_GET['post_id'])) {
    echo json_encode([]);
    exit();
}

$post_id = intval($_GET['post_id']); // Ensuring post_id is an integer

$query = "SELECT c.comment, c.created_at, u.username
          FROM comments c
          JOIN user u ON c.user_id = u.id
          WHERE c.post_id = ?
          ORDER BY c.created_at ASC";

$stmt = $conn->prepare($query);
if (!$stmt) {
    echo json_encode(["error" => $conn->error]);
    exit();
}

$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();

$comments = [];
while ($row = $result->fetch_assoc()) {
    $comments[] = [
        'username' => htmlspecialchars($row['username']),
        'comment' => htmlspecialchars($row['comment']),
        'created_at' => date('Y-m-d H:i:s', strtotime($row['created_at']))
    ];
}

echo json_encode($comments);
?>
