<?php
// Include the database connection file
include 'connectDB.php';

// Fetch room types with their amounts
$query = "SELECT id, room as room_name, available_rooms, amount FROM rooms";
$result = $dbConnection->query($query);

$rooms = [];
while ($row = $result->fetch_assoc()) {
    $rooms[] = $row;
}

echo json_encode($rooms);
?>
