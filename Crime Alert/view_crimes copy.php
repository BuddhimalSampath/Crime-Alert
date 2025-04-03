<?php
include 'db_connect.php';

$query = "SELECT c.id, c.title, c.description, c.category, c.district, c.date, c.photo,
                 COALESCE(SUM(CASE WHEN v.vote = 'leading' THEN 1 ELSE 0 END), 0) AS leading_votes, 
                 COALESCE(SUM(CASE WHEN v.vote = 'misleading' THEN 1 ELSE 0 END), 0) AS misleading_votes 
          FROM crimes c
          LEFT JOIN votes v ON c.id = v.crime_id
          GROUP BY c.id 
          ORDER BY c.date DESC";

$result = $conn->query($query);

$crimes = [];
while ($row = $result->fetch_assoc()) {
    $row['photo'] = $row['photo'] ? $row['photo'] : null;
    $crimes[] = $row;
}

echo json_encode($crimes);
?>
