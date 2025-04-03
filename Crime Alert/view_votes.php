<?php
include 'db_connect.php';

$query = "SELECT c.id, c.title, c.description, c.category, c.location, c.date, 
                 SUM(CASE WHEN v.vote = 'leading' THEN 1 ELSE 0 END) AS leading_votes, 
                 SUM(CASE WHEN v.vote = 'misleading' THEN 1 ELSE 0 END) AS misleading_votes 
          FROM crimes c
          LEFT JOIN votes v ON c.id = v.crime_id
          GROUP BY c.id 
          ORDER BY c.date DESC";

$result = $conn->query($query);

$crimeVotes = [];
while ($row = $result->fetch_assoc()) {
    $crimeVotes[] = $row;
}

echo json_encode($crimeVotes);
?>
