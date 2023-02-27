<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
// Replace these variables with your own values
$from_email = "mmmhmc.events@gmail.com"; // sender email address
$from_name = "Tri-Sakay"; // sender name
$subject = "One-Time Password"; // email subject

// SMTP server configuration
$smtp_host = "smtp.gmail.com"; // SMTP server hostname
$smtp_port = 587; // SMTP server port
$smtp_username = "mmmhmc.events@gmail.com"; // SMTP username
$smtp_password = "yqkkdadnplxcngkr"; // SMTP password

// Get the email and OTP from the GET request
if (isset($_GET['email']) && isset($_GET['otp'])) {
    $to_email = $_GET['email'];
    $otp = $_GET['otp'];

    // Create the email message
    $message = "Your one-time password is: $otp";


    
    // Create a PHPMailer object
    $mail = new PHPMailer();

    // Set SMTP configuration
    $mail->isSMTP();
    $mail->Host = $smtp_host;
    $mail->Port = $smtp_port;
    $mail->SMTPAuth = true;
    $mail->Username = $smtp_username;
    $mail->Password = $smtp_password;

    // Set email configuration
    $mail->setFrom($from_email, $from_name);
    $mail->addAddress($to_email);
    $mail->Subject = $subject;
    $mail->Body = $message;

    // Send the email
    if (!$mail->send()) {
        echo "Email could not be sent. Error: " . $mail->ErrorInfo;
    } else {
        echo "OTP sent to $to_email";
    }
} else {
    echo "Email or OTP not provided in the GET request";
}

?>