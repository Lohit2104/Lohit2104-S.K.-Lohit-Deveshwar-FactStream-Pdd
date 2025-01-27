<?php
session_start();
include("conn.php"); // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    echo "<script>alert('Please log in to access the chat.'); window.location.href='login.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Fact Stream - Chat</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Chat with the community on Fact Stream" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="lib/slick/slick.css" rel="stylesheet">
    <link href="lib/slick/slick-theme.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <style>

#chat-container {
    width: 100%;
    max-width: 500px;
    margin: auto;
    display: flex;
    flex-direction: column;
    height: 90vh;
    border: 1px solid #ddd;
    border-radius: 10px;
    overflow: hidden;
}

.chat-messages {
    flex: 1;
    padding: 10px;
    overflow-y: scroll;
    background-color: #f0f0f0;
}

.chat-message {
    margin-bottom: 10px;
}

.chat-message .username {
    font-weight: bold;
}

.chat-message .message-text {
    background: #6a98b0;
    display: inline-block;
    padding: 5px 10px;
    border-radius: 5px;
}

.chat-message .timestamp {
    font-size: 0.8em;
    color: #999;
    margin-left: 10px;
}

.chat-input-container {
    display: flex;
    padding: 10px;
    background: #fff;
    border-top: 1px solid #ddd;
}

.chat-input-container input {
    flex: 1;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-right: 10px;
}

.send-button {
    background: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

</style>
</head>

<body>
<?php include("header.php");?>

    <div id="chat-container">
    <h1 align="center">Community Chat</h1>
    <div id="chat-box" class="chat-messages">
       
        <!-- Messages will be dynamically loaded here -->
    </div>
    <form id="chat-form" class="chat-input-container">
        <input type="text" id="message" placeholder="Type a message..." required />
        <button type="submit" class="send-button">Send</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery library -->

<script>
    // Fetch and display messages when the page loads
    $(document).ready(function() {
        fetchMessages();
    });

    // Function to fetch and display chat messages
    function fetchMessages() {
        $.ajax({
            url: 'load_chat.php',  // Adjust this if the endpoint is different
            method: 'GET',
            success: function(data) {
                let messages = JSON.parse(data);
                let messageHTML = '';

                messages.forEach(function(message) {
                    let messageClass = message.username === 'user' ? 'user' : 'system'; // Check if message is from current user or not
                    messageHTML += `
                        <div class="chat-message ${messageClass}">
                            <div class="message-header">
                                <span class="username">${message.username}</span>
                                <span class="timestamp">${message.created_at}</span>
                            </div>
                            <div class="message-content">${message.message}</div>
                        </div>
                    `;
                });

                $('#chat-box').html(messageHTML);
                $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);  // Scroll to bottom
            }
        });
    }

    // Function to send message
    function sendMessage() {
        const message = $('#messageInput').val();
        if (message) {
            $.ajax({
                url: 'send_message.php',  // Adjust the URL based on your back-end
                method: 'POST',
                data: { message: message },
                success: function(response) {
                    $('#messageInput').val('');  // Clear input field
                    fetchMessages();  // Refresh messages
                }
            });
        }
    }

    // Bind send message action to enter key
    $('#messageInput').keypress(function(e) {
        if (e.which == 13) {  // Enter key
            sendMessage();
        }
    });
</script>

    <!-- Chat Section End--->

    <?php include('footer.php');?>

    <!-- Footer Start -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="lib/slick/slick.min.js"></script>
    <script src="js/main.js"></script>

    <script>
    // Fetch messages and display them
    function fetchMessages() {
        $.ajax({
            url: 'load_chat.php',
            method: 'GET',
            success: function(data) {
                $('#chat-box').html(data);

                // Ensure the chat box scrolls to the bottom
                $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
            },
            error: function(err) {
                console.error("Error fetching messages: ", err);
            }
        });
    }

    // Send message
    $('#chat-form').on('submit', function(e) {
        e.preventDefault();
        var message = $('#message').val();

        if (message.trim() === '') {
            return; // Prevent sending empty messages
        }

        $.ajax({
            url: 'send_message.php',
            method: 'POST',
            data: { message: message },
            success: function(response) {
                $('#message').val(''); // Clear input after sending
                fetchMessages(); // Refresh messages
            },
            error: function(err) {
                console.error("Error sending message: ", err);
            }
        });
    });

    // Load chat messages on page load and refresh every 5 seconds
    $(document).ready(function() {
        fetchMessages();
        setInterval(fetchMessages, 5000); // Auto-refresh chat every 5 seconds
    });
</script>

</body>
</html>
