<?php
// Include the database connection file
include 'connectDB.php';

// Get the current date and time
$currentDateTime = date('Y-m-d H:i:s');

// Start a transaction
$dbConnection->begin_transaction();

try {
    // Step 1: Get the room quantities from expired bookings
    $getExpiredBookingsQuery = "
        SELECT room_type, SUM(room_quantity) AS total_expired
        FROM bookings
        WHERE status = 'active' AND checkout < ? AND processed = 0
        GROUP BY room_type
    ";
    $stmt = $dbConnection->prepare($getExpiredBookingsQuery);
    $stmt->bind_param("s", $currentDateTime);
    $stmt->execute();
    $result = $stmt->get_result();

    // Prepare to update room availability
    $updateRoomsQuery = "
        UPDATE rooms r
        JOIN (
            SELECT ? AS room_type, ? AS total_expired
        ) b ON r.id = b.room_type
        SET r.available_rooms = r.available_rooms + COALESCE(b.total_expired, 0)
    ";

    // Prepare to batch update rooms
    $updateStmt = $dbConnection->prepare($updateRoomsQuery);

    // Loop through expired bookings to update rooms
    while ($row = $result->fetch_assoc()) {
        $roomTypeId = $row['room_type'];
        $totalExpired = $row['total_expired'];
        $updateStmt->bind_param("ii", $roomTypeId, $totalExpired);
        $updateStmt->execute();
    }

    // Step 2: Mark the processed bookings as processed
    $updateProcessedBookingsQuery = "
        UPDATE bookings
        SET status = 'expired', processed = 1
        WHERE status = 'active' AND checkout < ? AND processed = 0
    ";
    $stmt = $dbConnection->prepare($updateProcessedBookingsQuery);
    $stmt->bind_param("s", $currentDateTime);
    $stmt->execute();

    // Commit the transaction
    $dbConnection->commit();

} catch (Exception $e) {
    // Rollback the transaction in case of an error
    $dbConnection->rollback();
    // Log error for debugging
    error_log($e->getMessage());
    // Optionally, display a user-friendly message
    echo "An error occurred. Please try again later.";
}

// Close the database connection
$dbConnection->close();
?>
