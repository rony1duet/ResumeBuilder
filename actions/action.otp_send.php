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

        $result = $db->query("SELECT id, full_name FROM users WHERE (email_id = '$email_id')");

        $result = $result->fetch_assoc();

        if ($result) {
            $otp = rand(100000, 999999);
            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'rony.hossen.duet@gmail.com';
                $mail->Password = 'tpqepvrirhipriot';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port = 465;
                $mail->setFrom('verify@resumebuilder.com', 'Resume Builder');
                $mail->addAddress($email_id, $result['full_name']);
                $mail->isHTML(true);
                $mail->Subject = 'Resume Builder - Password Reset';
                $mail->Body = "Your password reset code is: <b>$otp</b>";
                $mail->AltBody = "Your password reset code is: $otp";
                $mail->send();

                $fn->setSession('otp', $otp);
                $fn->setSession('email_id', $email_id);


                $fn->setAlert('A 6 digit code has been sent to your email address!');
                $fn->redirect('../otp_verify.php?type=forgot_password');
            } catch (Exception $e) {
                $fn->setError($mail->ErrorInfo);
                $fn->redirect('../password_forgot.php');
            }

        } else {
            $fn->setError("$email_id is not registered!");
            $fn->redirect('../password_forgot.php');
            die();
        }

    } else {
        $fn->setError('Please enter your email address!');
        $fn->redirect('../password_forgot.php');
    }
} else {
    $fn->redirect('../password_forgot.php');
}
?>
