<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $crime_id = $_POST['crime_id'];
    $user_id = $_SESSION['user_id'];
    $vote = $_POST['vote'];

    $stmt = $conn->prepare("INSERT INTO votes (crime_id, user_id, vote) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $crime_id, $user_id, $vote);

    if ($stmt->execute()) {
        echo "Vote recorded!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
