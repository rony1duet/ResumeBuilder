<?php
require '../assets/class/class.Database.php';
require '../assets/class/class.Functions.php';

if ($_GET) {
    $post = $_GET;

    if ($post['id']) {
        $authid = $fn->Auth()['id'];
        try {

            $query = "DELETE resumes,  resume_experience,resume_skills,resume_education, resume_references FROM resumes LEFT JOIN resume_experience ON resumes.id = resume_experience.resume_id LEFT JOIN resume_skills ON resumes.id = resume_skills.resume_id LEFT JOIN resume_education ON resumes.id = resume_education.resume_id LEFT JOIN resume_references ON resumes.id = resume_references.resume_id WHERE resumes.id = " . $post['id'] . " AND resumes.user_id = " . $authid;

            $db->query($query);
            $db->rollBack();
            $fn->setAlert("Resume deleted successfully");
            $fn->redirect("../index.php");
        } catch (PDOException $e) {
            $fn->setError($e->getMessage());
            $fn->redirect("../index.php");
        }
    } else {
        $fn->setError("Invalid request");
        $fn->redirect("../index.php");
    }
} else {
    $fn->redirect("../index.php");
}
?>