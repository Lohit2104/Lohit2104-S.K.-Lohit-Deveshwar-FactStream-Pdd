<?php
session_start();
include('conn.php'); // Ensure your database connection is set up

// Ensure user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// User ID from session
$user_id = $_SESSION['id']; 

// Constants
define('FAKE_NEWS_API_URL', 'https://api-inference.huggingface.co/models/roberta-base-openai-detector');
define('FAKE_NEWS_API_KEY', 'YOUR_API_KEY'); // Replace with your valid API key

define('UPLOAD_DIR', 'uploads/'); // Directory for file uploads

/**
 * Validate Fake News using HuggingFace API
 */
function validateFakeNews($content) {
    $data = json_encode(["inputs" => $content]);

    $ch = curl_init(FAKE_NEWS_API_URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: Bearer " . FAKE_NEWS_API_KEY
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        die('Curl Error: ' . curl_error($ch));
    }

    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Log the API response for debugging
    file_put_contents('fake_news_api_log.txt', "Status: $http_status\nResponse: $response\nData Sent: $data\n", FILE_APPEND);

    if ($http_status !== 200) {
        echo "Fake News API Error: Invalid HTTP response code ($http_status)";
        exit();
    }

    $result = json_decode($response, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "Fake News API Error: Invalid JSON response.";
        exit();
    }

    // Extract label from response
    if (isset($result[0]['label'])) {
        return strtolower($result[0]['label']) === 'real';
    } else {
        echo "Fake News API Error: Unexpected response format.";
        exit();
    }
}

// Handling Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = $_POST['category'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $picture = $_FILES['picture']['name'];
    $picture_size = $_FILES['picture']['size'];
    $target_file = UPLOAD_DIR . basename($picture);

    // Validate file size (25MB limit)
    if ($picture_size > 25 * 1024 * 1024) {
        echo "<script>alert('File size exceeds 25MB limit.'); window.location.href='upload.php';</script>";
        exit();
    }

    // Validate word count (1000 characters limit)
    if (strlen($content) > 1000) {
        echo "<script>alert('Content exceeds 1000 characters.'); window.location.href='upload.php';</script>";
        exit();
    }

    // Validate fake news
    if (!validateFakeNews($content)) {
        echo "<script>alert('Content validation failed: Detected as Fake News.'); window.location.href='upload.php';</script>";
        exit();
    }

    // Upload file
    if (!move_uploaded_file($_FILES['picture']['tmp_name'], $target_file)) {
        echo "<script>alert('Failed to upload the file.'); window.location.href='upload.php';</script>";
        exit();
    }

    // Insert into Database
    $stmt = $conn->prepare("INSERT INTO submissions (category, picture, title, content, user_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $category, $target_file, $title, $content, $user_id);

    if ($stmt->execute()) {
        echo "<script>alert('Content uploaded successfully!'); window.location.href='adduploads.php';</script>";
    } else {
        echo "Database Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request method.";
}

// Close connection
$conn->close();
?>
