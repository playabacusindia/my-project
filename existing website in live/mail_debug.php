<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Log file for debugging
$logFile = 'mail_debug_log.txt';

function logDebug($message)
{
    global $logFile;
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$timestamp] $message\n", FILE_APPEND);
}

logDebug("=== Mail Debug Script Started ===");

// Adjust path if your PHPMailer files are in a different directory
try {
    require 'PHPMailer/Exception.php';
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';
    logDebug("PHPMailer files loaded successfully");
} catch (Exception $e) {
    logDebug("ERROR: Failed to load PHPMailer files - " . $e->getMessage());
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'PHPMailer files not found']);
    exit;
}

header('Content-Type: application/json');

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    logDebug("ERROR: Non-POST request received");
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method Not Allowed']);
    exit;
}

logDebug("POST request received");

// Get POST data
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$message = $_POST['message'] ?? '';
$type = $_POST['type'] ?? 'General Inquiry';

logDebug("Form data - Name: $name, Email: $email, Phone: $phone, Type: $type");

// Basic Validation
if (empty($name) || empty($email) || empty($phone) || empty($message)) {
    logDebug("ERROR: Validation failed - missing fields");
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Please fill all fields.']);
    exit;
}

logDebug("Validation passed, creating PHPMailer instance");

$mail = new PHPMailer(true);

try {
    // Enable verbose debug output
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->Debugoutput = function ($str, $level) {
        logDebug("SMTP Debug: $str");
    };

    // Server settings
    $mail->isSMTP();
    logDebug("Set to use SMTP");

    $mail->Host = 'mail.playabacusindia.com';
    logDebug("SMTP Host: " . $mail->Host);

    $mail->SMTPAuth = true;
    $mail->Username = 'contact@playabacusindia.com';
    logDebug("SMTP Username: " . $mail->Username);

    $mail->Password = 'PlayAbacusIndia@IPA.123';
    logDebug("Password set (hidden)");

    // Using STARTTLS on port 587 (more reliable on shared hosting)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    logDebug("Using STARTTLS encryption");

    $mail->Port = 587;
    logDebug("SMTP Port: " . $mail->Port);

    // Alternative: Use SMTPS on port 465 if 587 doesn't work
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    // $mail->Port = 465;

    // Recipients
    $mail->setFrom('contact@playabacusindia.com', 'Play Abacus India Web');
    logDebug("From address set");

    $mail->addAddress('contact@playabacusindia.com');
    $mail->addAddress('idealplayabacus20@gmail.com');
    logDebug("Recipients added");

    $mail->addReplyTo($email, $name);
    logDebug("Reply-to set");

    // Content
    $mail->isHTML(true);
    $mail->Subject = "New $type from $name";
    logDebug("Subject set: " . $mail->Subject);

    // HTML Body
    $mail->Body = "
        <h3>New Contact Form Inquiry ($type)</h3>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Phone:</strong> $phone</p>
        <p><strong>Message:</strong><br>$message</p>
    ";

    // Plain Text Body
    $mail->AltBody = "Type: $type\nName: $name\nEmail: $email\nPhone: $phone\nMessage: $message";

    logDebug("Attempting to send email...");
    $mail->send();
    logDebug("SUCCESS: Email sent successfully!");

    echo json_encode(['status' => 'success', 'message' => 'Message has been sent']);

} catch (Exception $e) {
    logDebug("ERROR: Email send failed - " . $mail->ErrorInfo);
    logDebug("Exception message: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}",
        'debug' => $e->getMessage()
    ]);
}

logDebug("=== Mail Debug Script Ended ===\n");
?>