<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Handle form submission
$message_sent = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $contact_number = htmlspecialchars($_POST['contact_number']);
    $email = htmlspecialchars($_POST['email']);
    $message = nl2br(htmlspecialchars($_POST['body']));

    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'noreply2457892@gmail.com'; // Your email
        $mail->Password = 'xpgyheonlyjizzwo'; // Use App Password if using Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email Settings
        $mail->setFrom($email, $name);
        $mail->addAddress('sachithgamage2310@gmail.com', 'Admin');
        $mail->addReplyTo($email, $name);

        $mail->isHTML(true);
        $mail->Subject = "📩 New Contact Form Message";

        // Light Themed Email Template
        $mail->Body = "
        <div style='background-color: #f9f9f9; padding: 20px; border-radius: 12px; box-shadow: 0px 4px 10px rgba(0,0,0,0.1); font-family: Arial, sans-serif; max-width: 600px; margin: auto; border: 2px solid #ff8c00;'>
            <h2 style='color: #ff8c00; text-align: center; margin-bottom: 15px;'>📩 New Contact Message</h2>
            <div style='background: #ffffff; padding: 15px; border-radius: 10px;'>
                <p style='font-size: 16px;'><strong style='color: #ff8c00;'>Name:</strong> $name</p>
                <p style='font-size: 16px;'><strong style='color: #ff8c00;'>Contact Number:</strong> $contact_number</p>
                <p style='font-size: 16px;'><strong style='color: #ff8c00;'>Email:</strong> $email</p>
                <p style='font-size: 16px;'><strong style='color: #ff8c00;'>Message:</strong><br>$message</p>
            </div>
            <p style='margin-top: 20px; font-size: 14px; color: #777; text-align: center;'>This email was sent via your website's contact form.</p>
        </div>
        ";

        // Send Email
        $mail->send();
        $message_sent = true;
    } catch (Exception $e) {
        echo "<script>alert('Message could not be sent. Error: {$mail->ErrorInfo}');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    

    <style>
        body {
            background-color: #fdfdfd;
            color: #333;
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
        }
        .contact-container {
            width: 50%;
            margin: auto;
            padding: 25px;
            border-radius: 12px;
            background: white;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
            border: 2px solid #ff8c00;
            transition: transform 0.3s ease-in-out;
        }
        .contact-container:hover {
            transform: scale(1.02);
        }
        input, textarea {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 2px solid #ff8c00;
            border-radius: 8px;
            background: white;
            color: black;
            font-size: 16px;
        }
        button {
            background-color: #ff8c00;
            color: white;
            padding: 12px 20px;
            border: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        button:hover {
            background-color: #ffa733;
            box-shadow: 0px 0px 10px rgba(255, 140, 0, 0.6);
        }
        @media (max-width: 768px) {
            .contact-container {
                width: 90%;
            }
        }
        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            border: 2px solid #c3e6cb;
            width: 50%;
            margin: auto;
            margin-bottom: 15px;
            box-shadow: 0px 4px 8px rgba(0, 255, 100, 0.3);
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

 

    <?php if ($message_sent): ?>
    <div class="success-message">
        ✅ Your message has been sent successfully!
    </div>
    <script>
        setTimeout(function() {
            window.location.href = "farm.php"; 
        }, 3000); // Redirect after 3 seconds
    </script>
<?php endif; ?>


    
</html>
