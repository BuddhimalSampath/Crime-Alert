<?php
$host = "localhost";
$user = "root";  // Default user for XAMPP
$password = "";  // Default password for XAMPP
$dbname = "crime_alert";

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
