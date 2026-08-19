<?php
/**
 * Backend Submission Handler for Enquiry Modal
 * Using PHP 8.x Best Practices & PHPMailer
 */

// Enable error reporting for debugging (Disable in production)
ini_set('display_errors', 0);
error_reporting(E_ALL);

header('Content-Type: application/json');

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

// 1. Sanitize and Validate Input Data
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

$name     = sanitizeInput($_POST['name'] ?? '');
$location = sanitizeInput($_POST['location'] ?? '');
$phone    = sanitizeInput($_POST['phone'] ?? '');
$email    = sanitizeInput($_POST['email'] ?? '');
$type     = sanitizeInput($_POST['enquiry_type'] ?? '');
$message  = sanitizeInput($_POST['message'] ?? '');
$page_url = sanitizeInput($_POST['page_url'] ?? 'Unknown');

// Basic Validation - Only Name, Location, and Phone are mandatory
if (empty($name) || empty($location) || empty($phone)) {
    echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
    exit;
}

// 2. Load PHPMailer
// Depending on your cPanel setup, adjust this path to where PHPMailer is located.
// If using Composer: require 'vendor/autoload.php';
// If manually uploaded to a folder named PHPMailer:
require_once 'PHPMailer/src/Exception.php';
require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    // 3. SMTP Server Configuration
    $mail->isSMTP();
    $mail->Host       = 'mocha3039.mochahost.com';
    $mail->SMTPAuth   = true;
    
    // -> REPLACE WITH YOUR ACTUAL EMAIL AND PASSWORD <-
    $mail->Username   = 'contact@playabacusindia.com'; 
    $mail->Password   = 'PlayAbacusIndia@IPA.123E'; 
    
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Use SSL/TLS
    $mail->Port       = 465;

    // 4. Email Headers & Content
    $mail->setFrom('contact@playabacusindia.com', 'IPA Website Form');
    $mail->addAddress('contact@playabacusindia.com'); // Send to self
    $mail->addAddress('idealplayabacus20@gmail.com'); // Secondary recipient
    $mail->addReplyTo('contact@playabacusindia.com', 'IPA Info');

    $mail->isHTML(true);
    $mail->Subject = 'New Enquiry Received' . ($type ? ': ' . $type : '');
    
    // HTML Email Template
    $emailBody = "
    <h2>New Website Enquiry</h2>
    <p>You have received a new enquiry from the website modal form.</p>
    <table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse; width: 100%; max-width: 600px;'>
        <tr style='background-color: #f8f9fa;'>
            <th style='text-align: left; width: 30%;'>Field</th>
            <th style='text-align: left;'>Details</th>
        </tr>
        <tr>
            <td><strong>Name</strong></td>
            <td>{$name}</td>
        </tr>
        <tr>
            <td><strong>Location</strong></td>
            <td>{$location}</td>
        </tr>
        <tr>
            <td><strong>Phone</strong></td>
            <td>{$phone}</td>
        </tr>
        <tr>
            <td><strong>Gmail / Email</strong></td>
            <td>" . ($email ? $email : 'Not provided') . "</td>
        </tr>
        <tr>
            <td><strong>Enquiry Type</strong></td>
            <td>" . ($type ? $type : 'Not specified') . "</td>
        </tr>
        <tr>
            <td><strong>Page Submitted From</strong></td>
            <td><a href='{$page_url}'>{$page_url}</a></td>
        </tr>
        <tr>
            <td><strong>Message</strong></td>
            <td>" . ($message ? nl2br($message) : 'No message provided') . "</td>
        </tr>
    </table>
    <p style='color: #666; font-size: 12px; margin-top: 20px;'>This email was generated securely from playabacusindia.com</p>
    ";

    $mail->Body = $emailBody;
    $mail->AltBody = "New Enquiry\n\nName: $name\nLocation: $location\nPhone: $phone\nGmail: " . ($email ? $email : 'Not provided') . "\nType: " . ($type ? $type : 'Not specified') . "\nPage: $page_url\nMessage: " . ($message ? $message : 'No message');

    // 5. Send the Email
    $mail->send();
    echo json_encode(['success' => true, 'message' => 'Your enquiry has been sent successfully.']);
} catch (Exception $e) {
    // Log error for the admin, show generic error to user
    error_log("Mailer Error: {$mail->ErrorInfo}");
    echo json_encode(['success' => false, 'message' => 'There was a technical error sending your enquiry. Please try again later.']);
}
?>
