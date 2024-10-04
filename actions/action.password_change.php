<?php
require '../assets/class/class.Database.php';
require '../assets/class/class.Functions.php';

if ($_POST) {
    $post = $_POST;
    if ($post['new_password']) {

        $new_password = md5($db->real_escape_string($post['new_password']));
        $email_id = $fn->getSession('email_id');

        // Update the password in the database
        $db->query("UPDATE users SET password='$new_password' WHERE email_id='$email_id'");

        // Fetch the updated user data and set session variables
        $user = $db->query("SELECT * FROM users WHERE email_id='$email_id'")->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['Auth'] = $user;

        // Unset OTP and email session data
        unset($_SESSION['otp']);
        unset($_SESSION['email_id']);

        $fn->setAlert('Password changed successfully!');
        $fn->redirect('../index.php');
    } else {
        $fn->setError('Please enter new password!');
        $fn->redirect('../password_change.php');
    }
} else {
    $fn->redirect('../password_change.php');
}
?>