<?php
$host = 'localhost';  // Hostname of the server
$dbname = 'userdb';  // Database name
$username = 'root';  // Default XAMPP username
$password = '';  // Default XAMPP password is empty

// Connect to the database
$conn = new mysqli($host, $username, $password, $dbname,3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>