<?php
session_start();
require_once 'conn.php';

if (!isset($_SESSION['id'], $_POST['post_id'], $_POST['comment']) || empty($_POST['post_id']) || empty($_POST['comment'])) {
    echo json_encode(["error" => "Invalid request"]);
    exit();
}

$user_id = intval($_SESSION['id']);
$post_id = intval($_POST['post_id']);
$comment = trim($_POST['comment']);

if ($comment === '') {
    echo json_encode(["error" => "Comment cannot be empty"]);
    exit();
}

$comment = mysqli_real_escape_string($conn, $comment);

$query = "INSERT INTO comments (post_id, user_id, comment) VALUES (?, ?, ?)";
$stmt = $conn->prepare($query);

if (!$stmt) {
    echo json_encode(["error" => $conn->error]);
    exit();
}

$stmt->bind_param("iis", $post_id, $user_id, $comment);

if ($stmt->execute()) {
    echo json_encode(["success" => "Comment added successfully"]);
} else {
    echo json_encode(["error" => $stmt->error]);
}
?>
