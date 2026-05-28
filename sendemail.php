<?php
define('RECIPIENT_NAME',  'Titus Tuitoek');
define('RECIPIENT_EMAIL', 'titus.buyersagent@gmail.com');

/* Sanitise inputs */
$userName     = isset($_POST['username'])  ? trim(strip_tags($_POST['username']))  : '';
$senderEmail  = isset($_POST['email'])     ? trim(strip_tags($_POST['email']))     : '';
$userPhone    = isset($_POST['phone'])     ? trim(strip_tags($_POST['phone']))     : '';
$userSubject  = isset($_POST['subject'])   ? trim(strip_tags($_POST['subject']))   : 'Website Enquiry';
$message      = isset($_POST['message'])   ? trim(strip_tags($_POST['message']))   : '';

/* Optional booking fields */
$prefDay      = isset($_POST['preferred_day'])  ? trim(strip_tags($_POST['preferred_day']))  : '';
$prefTime     = isset($_POST['preferred_time']) ? trim(strip_tags($_POST['preferred_time'])) : '';
$inquiryType  = isset($_POST['inquiry_type'])   ? trim(strip_tags($_POST['inquiry_type']))   : '';

$success = false;

if ($userName && filter_var($senderEmail, FILTER_VALIDATE_EMAIL) && $userPhone) {
    $to      = RECIPIENT_NAME . ' <' . RECIPIENT_EMAIL . '>';
    $subject = '[Titus Buyers Agent] ' . $userSubject;

    $body  = "New enquiry from the website\n";
    $body .= str_repeat('-', 40) . "\n";
    $body .= "Name:    $userName\n";
    $body .= "Email:   $senderEmail\n";
    $body .= "Phone:   $userPhone\n";
    $body .= "Subject: $userSubject\n";
    if ($inquiryType) { $body .= "Looking for: $inquiryType\n"; }
    if ($prefDay)     { $body .= "Preferred day:  $prefDay\n"; }
    if ($prefTime)    { $body .= "Preferred time: $prefTime\n"; }
    $body .= str_repeat('-', 40) . "\n";
    $body .= "Message:\n$message\n";

    $headers  = "From: $userName <$senderEmail>\r\n";
    $headers .= "Reply-To: $senderEmail\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $success = mail($to, $subject, $body, $headers);
}

header('Location: contact.php?message=' . ($success ? 'success' : 'error'));
exit;
