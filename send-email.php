<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php';


// ========================================
// CHECK FORM SUBMISSION
// ========================================

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    die('Please submit the project brief form.');

}


// ========================================
// GET FORM DATA
// ========================================

$name       = $_POST['name'] ?? '';
$email      = $_POST['email'] ?? '';
$phone      = $_POST['phone'] ?? '';
$location   = $_POST['location'] ?? '';

$hotel      = $_POST['hotel'] ?? '';
$website    = $_POST['website'] ?? '';

$goals      = $_POST['goals'] ?? '';
$challenges = $_POST['challenges'] ?? '';

$services   = $_POST['services'] ?? [];
$budget     = $_POST['budget'] ?? '';
$timeline   = $_POST['timeline'] ?? '';


// ========================================
// SERVICES ARRAY → TEXT
// ========================================

if (is_array($services)) {

    $services = implode(', ', $services);

} else {

    $services = 'None selected';

}


// ========================================
// CREATE PHPMailer
// ========================================

$mail = new PHPMailer(true);


try {

    // ====================================
    // GMAIL SMTP
    // ====================================

    $mail->isSMTP();

    $mail->Host = 'smtp.gmail.com';

    $mail->SMTPAuth = true;

    // KEEP YOUR WORKING GMAIL
    $mail->Username = 'korin.kltn@gmail.com';

    // KEEP YOUR WORKING APP PASSWORD
    $mail->Password = 'ymfbutyryecaibbz';

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    $mail->Port = 587;


    // ====================================
    // FROM
    // ====================================

    $mail->setFrom(
        'korin.kltn@gmail.com',
        'K.KLTN Website'
    );


    // ====================================
    // TO
    // ====================================

    $mail->addAddress(
        'korin.kltn@gmail.com',
        'K.KLTN'
    );


    // ====================================
    // REPLY TO CLIENT
    // ====================================

    if (!empty($email)) {

        $mail->addReplyTo(
            $email,
            $name
        );

    }


    // ====================================
    // SUBJECT
    // ====================================

    $mail->Subject =
        'New Project Brief — ' . $hotel;


    // ====================================
    // HTML EMAIL
    // ====================================

    $mail->isHTML(true);

    $mail->Body = '

    <div style="
        font-family: Arial, sans-serif;
        max-width: 700px;
        margin: auto;
        color: #222;
        line-height: 1.6;
    ">

        <h1 style="
            margin-bottom: 5px;
        ">
            New Project Brief
        </h1>

        <p style="color:#777;">
            K.KLTN Website
        </p>

        <hr>


        <!-- CONTACT -->

        <h2>01 — Contact Information</h2>

        <p>
            <strong>Name</strong><br>
            ' . htmlspecialchars($name) . '
        </p>

        <p>
            <strong>Email</strong><br>
            ' . htmlspecialchars($email) . '
        </p>

        <p>
            <strong>Phone</strong><br>
            ' . htmlspecialchars($phone) . '
        </p>

        <p>
            <strong>Location</strong><br>
            ' . htmlspecialchars($location) . '
        </p>


        <hr>


        <!-- PROPERTY -->

        <h2>02 — Property Details</h2>

        <p>
            <strong>Hotel / Property</strong><br>
            ' . htmlspecialchars($hotel) . '
        </p>

        <p>
            <strong>Current Website</strong><br>
            ' . htmlspecialchars($website) . '
        </p>


        <hr>


        <!-- SERVICES -->

        <h2>03 — Services Needed</h2>

        <p>
            ' . htmlspecialchars($services) . '
        </p>


        <hr>


        <!-- BUDGET -->

        <h2>04 — Budget & Timeline</h2>

        <p>
            <strong>Budget</strong><br>
            ' . htmlspecialchars($budget) . '
        </p>

        <p>
            <strong>Timeline</strong><br>
            ' . htmlspecialchars($timeline) . '
        </p>


        <hr>


        <!-- GOALS -->

        <h2>05 — Project Goals</h2>

        <p>
            <strong>Main Goals</strong>
        </p>

        <p>
            ' . nl2br(htmlspecialchars($goals)) . '
        </p>

        <p>
            <strong>Current Challenges</strong>
        </p>

        <p>
            ' . nl2br(htmlspecialchars($challenges)) . '
        </p>


        <hr>

        <p style="
            color:#999;
            font-size:12px;
        ">
            Submitted through K.KLTN Project Brief
        </p>

    </div>

    ';


    // ====================================
    // PLAIN TEXT VERSION
    // ====================================

    $mail->AltBody =

        "NEW K.KLTN PROJECT BRIEF\n\n" .

        "01 — CONTACT INFORMATION\n\n" .

        "Name: $name\n" .
        "Email: $email\n" .
        "Phone: $phone\n" .
        "Location: $location\n\n" .

        "02 — PROPERTY DETAILS\n\n" .

        "Hotel: $hotel\n" .
        "Website: $website\n\n" .

        "03 — SERVICES NEEDED\n\n" .

        "$services\n\n" .

        "04 — BUDGET & TIMELINE\n\n" .

        "Budget: $budget\n" .
        "Timeline: $timeline\n\n" .

        "05 — PROJECT GOALS\n\n" .

        "Goals:\n$goals\n\n" .

        "Challenges:\n$challenges";


    // ====================================
    // SEND EMAIL
    // ====================================

    $mail->send();


    // ====================================
    // SUCCESS PAGE
    // ====================================

    ?>

    <!DOCTYPE html>

    <html>

    <head>

        <meta charset="UTF-8">

        <title>Brief Submitted — K.KLTN</title>

        <style>

            body {
                margin: 0;
                background: #f4f0e8;
                color: #171717;
                font-family: Arial, sans-serif;
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: 100vh;
                text-align: center;
            }

            .success {
                max-width: 600px;
                padding: 50px;
            }

            .dot {
                color: #df002b;
            }

            h1 {
                font-size: 48px;
                margin-bottom: 20px;
            }

            p {
                color: #71839a;
                font-size: 18px;
                line-height: 1.6;
            }

            a {
                display: inline-block;
                margin-top: 30px;
                padding: 16px 28px;
                background: #df002b;
                color: white;
                text-decoration: none;
                font-weight: bold;
            }

        </style>

    </head>

    <body>

        <div class="success">

            <h1>
                Brief Received<span class="dot">.</span>
            </h1>

            <p>
                Thank you for reaching out to K.KLTN.
                I've received your project details and
                will review your brief shortly.
            </p>

            <a href="index.html">
                BACK TO WEBSITE →
            </a>

        </div>

    </body>

    </html>

    <?php


} catch (Exception $e) {

    echo '<h1>Something went wrong.</h1>';

    echo '<p>';

    echo htmlspecialchars($mail->ErrorInfo);

    echo '</p>';

}

?>