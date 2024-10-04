<?php
require '../assets/class/class.Database.php';
require '../assets/class/class.Functions.php';

if ($_POST) {
    $post = $_POST;
    if ($post['resume_id'] && $post['font']) {
        $resume_id = $db->real_escape_string($post['resume_id']);
        $font = $db->real_escape_string($post['font']);
        $query = "UPDATE resumes SET font = '$font' WHERE id = $resume_id";
        $db->query($query);

    }
}
?>