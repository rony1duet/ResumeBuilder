<?php
require '../assets/class/class.Database.php';
require '../assets/class/class.Functions.php';

if ($_POST) {
    $post = $_POST;
    if ($post['resume_id'] && $post['theme']) {
        $resume_id = $db->real_escape_string($post['resume_id']);
        $theme = $db->real_escape_string($post['theme']);
        $query = "UPDATE resumes SET theme = '$theme' WHERE id = $resume_id";
        $db->query($query);

    }
}
?>