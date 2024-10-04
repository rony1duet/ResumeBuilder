<?php
require '../assets/class/class.Database.php';
require '../assets/class/class.Functions.php';

if ($_POST['otp'] && $_POST['type']) {

    $entered_otp = $_POST['otp'];
    $type = $_POST['type'];

    // Check if OTP is correct
    if ($entered_otp != $fn->getSession('otp')) {
        $fn->setError('Invalid OTP!');
        $fn->redirect('../otp_verify.php?type=' . $type);
        die();
    }

    // OTP verified, handle based on type
    if ($type == 'register') {
        // For registration, insert user into the database
        $full_name = $fn->getSession('full_name');
        $email_id = $fn->getSession('email_id');
        $password = md5($fn->getSession('password'));

        try {
            $db->query("INSERT INTO users (full_name, email_id, password) VALUES ('$full_name', '$email_id', '$password')");
            $user_id = $db->insert_id;
            $_SESSION['user_id'] = $user_id;

            // Fetch user data and set other session variables
            $user = $db->query("SELECT * FROM users WHERE id = $user_id")->fetch_assoc();
            $_SESSION['Auth'] = $user;

            // Unset the session variables used during OTP verification
            unset($_SESSION['otp']);
            unset($_SESSION['email_id']);
            unset($_SESSION['full_name']);
            unset($_SESSION['password']);

            $fn->setAlert('Registration successful! You are now logged in.');
            $fn->redirect('../index.php'); // Redirect to myresumes page
        } catch (Exception $e) {
            $fn->setError('Failed to register! Please try again.');
            $fn->redirect('../user_register.php');
        }
    } elseif ($type == 'forgot_password') {
        // For forgot password, redirect to change password page
        $fn->redirect('../password_change.php');
    } else {
        $fn->setError('Unknown verification type.');
        $fn->redirect('../otp_verify.php');
    }
} else {
    $fn->setError('Invalid request.');
    $fn->redirect('../otp_verify.php');
}