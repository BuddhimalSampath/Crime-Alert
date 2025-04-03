<?php
include 'db_connect.php';

$result = $conn->query("SELECT * FROM crimes ORDER BY date DESC");

$crimes = [];
while ($row = $result->fetch_assoc()) {
    $crimes[] = $row;
}

echo json_encode($crimes);
?>
