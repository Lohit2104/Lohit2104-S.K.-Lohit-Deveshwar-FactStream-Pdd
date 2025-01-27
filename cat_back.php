<?php
include("conn.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $category = trim($_POST["categoryName"]);

    if (!empty($category)) {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO add_cat (categoryName) VALUES (?)");
        $stmt->bind_param("s", $category);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to add_cat.php after successful insertion
            header("Location: add_cat.php?success=1");
            exit(); // Ensure no further code is executed after the redirect
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Please enter a category.";
    }
}

$conn->close();
?>
