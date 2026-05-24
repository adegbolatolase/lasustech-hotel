<?php
// Check for empty fields
$requiredFields = array('name', 'email', 'subject', 'message');
$errorMessage = '';
foreach ($requiredFields as $field) {
    if (empty($_POST[$field])) {
        $errorMessage .= ucfirst($field) . " is required.<br>";
    }
}

// Server-side validation for email format
if (!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errorMessage .= "Invalid email format.<br>";
}

// If there are any errors, display the error message and stop execution
if (!empty($errorMessage)) {
    echo $errorMessage;
    return false;
}

$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Create the email and send the message
$to = 'info@lasustechhotel.com.ng';
$email_subject = "Contact Form Submission";
$email_body = "You have received a new message from your website contact form.\n\n"
              . "Name: $name\n"
              . "Email: $email\n"
              . "Subject: $subject\n"
              . "Message:\n$message";
$headers = "From: noreply@lasustechhotel.com.ng\n";
$headers .= "Reply-To: $email";
mail($to, $email_subject, $email_body, $headers);

// Display thanks.html upon successful submission
include('thanks.html');
return true;
?>