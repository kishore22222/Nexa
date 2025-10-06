<?php
// 1️⃣ Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/src/SMTP.php';
require '../vendor/phpmailer/src/Exception.php';

// 2️⃣ Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 3️⃣ Get form data
    $name    = $_POST['name'] ?? '';
    $email   = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? 'Contact Form Submission';
    $message = $_POST['message'] ?? '';
    $phone   = $_POST['phone'] ?? '';

    // 4️⃣ Create PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // 5️⃣ Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'selvakishore2023@gmail.com';       // replace with your Gmail
        $mail->Password   = 'txxi qtgm fmkx rtuw';         // Gmail App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // 6️⃣ Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('selvakishore2023@gmail.com'); // where you want to receive emails

        // 7️⃣ Email content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = "
            <h3>New Contact Form Submission</h3>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Message:</strong><br>$message</p>
        ";
        $mail->AltBody = "Name: $name\nEmail: $email\nPhone: $phone\nMessage: $message";

        // 8️⃣ Send email
        $mail->send();
        echo 'Message sent successfully!';
    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
}
?>


