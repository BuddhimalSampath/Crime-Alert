<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

$user_id = $_SESSION['user_id'];
$crime_id = $_GET['crime_id'];

// Check if the user owns the crime
$check_stmt = $conn->prepare("SELECT id FROM crimes WHERE id = ? AND user_id = ?");
$check_stmt->bind_param("ii", $crime_id, $user_id);
$check_stmt->execute();
$check_stmt->store_result();

if ($check_stmt->num_rows > 0) {
    // User owns the crime, proceed with deletion
    $delete_stmt = $conn->prepare("DELETE FROM crimes WHERE id = ?");
    $delete_stmt->bind_param("i", $crime_id);
    if ($delete_stmt->execute()) {
        echo "Crime deleted successfully.";
    } else {
        echo "Error deleting crime.";
    }
} else {
    echo "You are not authorized to delete this crime.";
}
?>
