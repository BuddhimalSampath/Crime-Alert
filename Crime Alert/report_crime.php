<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access. <a href='login.html'>Login here</a>");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $district = $_POST['district'];
    $category = $_POST['category'];

    // Handle file upload
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true); // Create directory if it doesn't exist
    }

    $photo = $_FILES['photo'];
    $photo_name = basename($photo["name"]);
    $photo_path = $target_dir . time() . "_" . $photo_name; // Unique filename to avoid overwriting

    if (move_uploaded_file($photo["tmp_name"], $photo_path)) {
        // Save crime report with image path
        $stmt = $conn->prepare("INSERT INTO crimes (user_id, title, description, district, category, photo) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $user_id, $title, $description, $district, $category, $photo_path);

        if ($stmt->execute()) {
            header('Location: view_crimes.html'); 
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Error uploading file.";
    }
}
?>