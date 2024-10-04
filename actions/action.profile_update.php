<?php
session_start();
require '../assets/class/class.Database.php';
require '../assets/class/class.Functions.php';

if ($_POST) {
    $post = $_POST;
    if ($post['full_name'] && $post['email_id']) {
        $full_name = $db->real_escape_string($post['full_name']);
        $email_id = $db->real_escape_string($post['email_id']);
        
        $id = $fn->Auth()['id'];

        $result = $db->query("SELECT COUNT(*) as user FROM users WHERE (email_id = '$email_id' && id != '$id')");

        $result = $result->fetch_assoc();

        if ($result['user']) {
            $fn->setError($email_id . ' is already registered!');
            $fn->redirect('../user_account.php');
            die();
        }
        $db->query("UPDATE users SET full_name='$full_name', email_id='$email_id' WHERE id='$id'");
        if ($password) {
            $password = md5($db->real_escape_string($post['password']));
            $db->query("UPDATE users SET password='$password' WHERE id='$id'");
        }
        $fn->setAlert('Profile updated successfully!');
        $fn->redirect('../user_account.php');
        die();
        
    } else {
        $fn->setError('Please fill all the fields!');
        $fn->redirect('../user_account.php');
    }
} else {
    $fn->redirect('../user_account.php');
}
?>