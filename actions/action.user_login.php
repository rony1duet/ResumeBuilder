<?php
require '../assets/class/class.Database.php';
require '../assets/class/class.Functions.php';

if ($_POST) {
    $post = $_POST;
    if ($post['email_id'] && $post['password']) {
        $email_id = $db->real_escape_string($post['email_id']);
        $password = md5($db->real_escape_string($post['password']));

        $result = $db->query("SELECT id, full_name FROM users WHERE (email_id = '$email_id' && password = '$password')");

        $result = $result->fetch_assoc();

        if ($result) {
            $fn->setAuth($result);
            $fn->setAlert("Login successful!");
            $fn->redirect('../index.php');
        } else {
            $fn->setError('Invalid email or password!');
            $fn->redirect('../user_login.php');
            die();
        }

    } else {
        $fn->setError('Please fill all the fields!');
        $fn->redirect('../user_login.php');
    }
} else {
    $fn->redirect('../user_login.php');
}
?>