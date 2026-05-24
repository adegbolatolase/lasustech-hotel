<?php
// Include your database connection file
include 'connectDB.php';

$email = isset($_POST['email']) ? $_POST['email'] : '';
$success = false;

if ($email) {
    $stmt = $conn->prepare("INSERT INTO newsletter_subscribers (email) VALUES (?)");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        $success = true;
    }

    $stmt->close();
}

$conn->close();
?>