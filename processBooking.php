<?php
// Include the database connection file
include 'connectDB.php'; // Ensure connectDB.php defines $dbConnection

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer classes manually
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$checkin = $_POST['checkin'];
$checkout = $_POST['checkout'];
$roomTypeId = $_POST['room_type']; // Room type ID selected by user
$roomQuantity = $_POST['room_quantity'];

// Handle special request, set to NULL if empty
$specialRequest = !empty($_POST['special_request']) ? $_POST['special_request'] : NULL;

// Generate a unique booking code
$bookingCode = strtoupper(bin2hex(random_bytes(3))); // 6 characters

// Fetch the room name based on the selected room type ID
$roomQuery = $dbConnection->prepare("SELECT room FROM rooms WHERE id = ?");
$roomQuery->bind_param("i", $roomTypeId);
$roomQuery->execute();
$roomQuery->bind_result($roomName);
$roomQuery->fetch();
$roomQuery->close();

// Format the checkin and checkout dates
$checkinDate = (new DateTime($checkin))->format('Y-m-d H:i');
$checkoutDate = (new DateTime($checkout))->format('Y-m-d H:i');

// Insert booking with room name and initial status as 'active'
$stmt = $dbConnection->prepare("INSERT INTO bookings (name, email, room_type, checkin, checkout, room_quantity, special_request, booking_code, created_at, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), 'active')");
$stmt->bind_param("ssssssis", $name, $email, $roomName, $checkinDate, $checkoutDate, $roomQuantity, $specialRequest, $bookingCode);
$stmt->execute();

// Function to send email using PHPMailer
function sendEmail($to, $subject, $message, $from)
{
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'mail.lasustechhotel.com.ng';                  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'bookings@lasustechhotel.com.ng';        // SMTP username
        $mail->Password = 'Lasustech1#';              // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        // Recipients
        $mail->setFrom($from, 'Lasustech Hotel');
        $mail->addAddress($to);                               // Add a recipient
        $mail->addReplyTo('noreply@lasustechhotel.com.ng', 'No Reply');

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// Prepare email content for the user
$userSubject = "Booking Confirmation - Booking Code: $bookingCode";
$userMessage = "
<html>
<head>
    <title>Booking Confirmation</title>
</head>
<body>
    <h2>Your Booking Details</h2>
    <p><strong>Booking Code:</strong> $bookingCode</p>
    <p><strong>Name:</strong> $name</p>
    <p><strong>Email:</strong> $email</p>
    <p><strong>Check-In:</strong> $checkinDate</p>
    <p><strong>Check-Out:</strong> $checkoutDate</p>
    <p><strong>Room Type:</strong> $roomName</p>
    <p><strong>Number of Rooms:</strong> $roomQuantity</p>
    <p><strong>Special Request:</strong> " . ($specialRequest ? $specialRequest : 'None') . "</p>
    <p><strong>Note:</strong> You’ll be required to provide these details on check-in at the hotel.</p>
</body>
</html>
";

// Send email to the user
sendEmail($email, $userSubject, $userMessage, 'noreply@lasustechhotel.com.ng');

// Prepare email content for the company
$companySubject = "New Booking - Booking Code: $bookingCode";
$companyMessage = "
<html>
<head>
    <title>New Booking</title>
</head>
<body>
    <h2>New Booking Received</h2>
    <p><strong>Booking Code:</strong> $bookingCode</p>
    <p><strong>Name:</strong> $name</p>
    <p><strong>Email:</strong> $email</p>
    <p><strong>Check-In:</strong> $checkinDate</p>
    <p><strong>Check-Out:</strong> $checkoutDate</p>
    <p><strong>Room Type:</strong> $roomName</p>
    <p><strong>Number of Rooms:</strong> $roomQuantity</p>
    <p><strong>Special Request:</strong> " . ($specialRequest ? $specialRequest : 'None') . "</p>
</body>
</html>
";

// Send email to the company
$companyEmail = "bookings@lasustechhotel.com.ng";
sendEmail($companyEmail, $companySubject, $companyMessage, 'noreply@lasustechhotel.com.ng');

// Redirect to a confirmation page
header("Location: modal2.html");
exit();

// Close the database connection
$dbConnection->close();
?>
