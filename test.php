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

header('Content-Type: application/json');

define('UPLOAD_DIR', 'uploads/'); // Directory for file uploads

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

    // Fact Validation via Python API
    $data = ["message" => $content];
    $jsonData = json_encode($data);

    $url = 'http://localhost:8000'; // Python server URL
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($jsonData)
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    if ($response === false) {
        echo "<script>alert('Failed to connect to the validation server.'); window.location.href='upload.php';</script>";
        exit();
    }

    // Decode and validate fact
    $responseData = json_decode($response, true);

    if (isset($responseData['reply'])) {
        $innerJson = json_decode(trim($responseData['reply'], "```json\n```"), true);

        if (isset($innerJson['fact']) && $innerJson['fact'] === true) {
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
                echo "<script>alert('Database error: " . $stmt->error . "'); window.location.href='upload.php';</script>";
            }

            $stmt->close();
        } else {
            // Fact is false; redirect user
            echo "<script>alert('The given content is incorrect. Please verify and try again.'); window.location.href='upload.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Invalid response from validation server.'); window.location.href='upload.php';</script>";
        exit();
    }
} else {
    echo "Invalid request method.";
}

// Close connection
$conn->close();
?>
