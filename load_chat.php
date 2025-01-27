<?php
require_once 'conn.php'; // Database connection
session_start();

if (!isset($_SESSION['id'])) {
    echo "<p>You must log in to view messages.</p>";
    exit();
}

$query = "SELECT m.message, m.created_at, u.username
          FROM messages m
          JOIN user u ON m.user_id = u.id
          ORDER BY m.created_at ASC";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $username = htmlspecialchars($row['username']);
        $message = htmlspecialchars($row['message']);
        $created_at = date('Y-m-d H:i:s', strtotime($row['created_at']));

        echo "<div class='chat-message'>
                <strong class='username'>{$username}:</strong>
                <p class='message-text'>{$message}</p>
                <span class='timestamp'>{$created_at}</span>
              </div>";
    }
} else {
    echo "<p>No messages yet. Start the conversation!</p>";
}
?>