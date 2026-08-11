<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Invalid request.');
}

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

$mail = new PHPMailer(true);

try {

    // Gmail SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;

    // YOUR GMAIL
    $mail->Username = 'korin.kltn@gmail.com';

    // YOUR GMAIL APP PASSWORD
    $mail->Password = 'ymfbutyryecaibbz';

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;


    // Sender
    $mail->setFrom(
        'korin.kltn@gmail.com',
        'K.KLTN Website'
    );


    // Receive the email
    $mail->addAddress(
        'korin.kltn@gmail.com',
        'K.KLTN'
    );


    // When you click Reply, reply to the visitor
    $mail->addReplyTo(
        $email,
        $name
    );


    // Email content
    $mail->isHTML(true);

    $mail->Subject = 'New Contact Message - K.KLTN';

    $mail->Body = '

        <h2>New Contact Message</h2>

        <p>
            <strong>Name:</strong><br>
            ' . htmlspecialchars($name) . '
        </p>

        <p>
            <strong>Email:</strong><br>
            ' . htmlspecialchars($email) . '
        </p>

        <p>
            <strong>Project Details:</strong>
        </p>

        <p>
            ' . nl2br(htmlspecialchars($message)) . '
        </p>

    ';


    $mail->AltBody =
        "NEW CONTACT MESSAGE\n\n" .
        "Name: " . $name . "\n" .
        "Email: " . $email . "\n\n" .
        "Project Details:\n" .
        $message;


    // Send email
    $mail->send();


    // Success page
    header('Location: contact-success.html');
    exit;


} catch (Exception $e) {

    echo '<h1>EMAIL FAILED</h1>';

    echo '<p>';
    echo htmlspecialchars($mail->ErrorInfo);
    echo '</p>';

}

?>