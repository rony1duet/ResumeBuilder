<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../assets/class/class.Database.php';
require '../assets/class/class.Functions.php';

require '../assets/packages/PHPMailer/Exception.php';
require '../assets/packages/PHPMailer/PHPMailer.php';
require '../assets/packages/PHPMailer/SMTP.php';

if ($_POST) {
    $post = $_POST;
    if ($post['email_id']) {
        $email_id = $db->real_escape_string($post['email_id']);

        // Check if the email exists in the database
        $result = $db->query("SELECT COUNT(*) as user FROM users WHERE email_id = '$email_id'");
        $result = $result->fetch_assoc();

        if ($result) {

            $otp = rand(100000, 999999);  // Generate a random OTP
            $mail = new PHPMailer(true);

            try {
                // PHPMailer server configuration
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'rony.hossen.duet@gmail.com';  // Your email used for sending
                $mail->Password = 'tpqepvrirhipriot';  // Use app-specific password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port = 465;

                // Set the sender email (different from your sending email)
                $mail->setFrom('no-reply@resumebuilder.com', 'Resume Builder');

                // Recipient email (user who requested OTP)
                $mail->addAddress($email_id, $post['full_name']);

                // Email content
                $mail->isHTML(true);
                $mail->Subject = 'Resume Builder - Email Verification';
                $mail->Body = "Your email verification code is: <b>$otp</b>";
                $mail->AltBody = "Your email verification code is: $otp";

                $mail->send();

                // Save OTP in the session
                $_SESSION = [
                    'otp' => $otp,
                    'email_id' => $email_id,
                    'full_name' => $post['full_name'],
                    'password' => $post['password']
                ];

                // Redirect to the verification page
                $fn->setAlert('A 6 digit code has been sent to your email address!');
                $fn->redirect('../otp_verify.php?type=register');

            } catch (Exception $e) {
                $fn->setError('Failed to send OTP. Error: ' . $mail->ErrorInfo);
                $fn->redirect('../user_register.php');
            }

        } else {
            $fn->setError("$email_id is not registered!");
            $fn->redirect('../user_register.php');
            die();
        }
    } else {
        $fn->setError('Please enter your email address!');
        $fn->redirect('../user_register.php');
    }
} else {
    $fn->redirect('../user_register.php');
}
?>