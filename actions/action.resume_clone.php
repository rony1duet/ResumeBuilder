<?php
require '../assets/class/class.Database.php';
require '../assets/class/class.Functions.php';

$slug = $_GET['resume'] ?? '';
$resume = $db->query("SELECT * FROM resumes WHERE (slug='$slug' AND user_id=" . $fn->Auth()['id'] . ")")->fetch_assoc();
if (!$resume) {
    $fn->setError('Resume not found!');
    $fn->redirect('index.php');
}

$experience = $db->query("SELECT * FROM resume_experience WHERE resume_id=" . $resume['id'])->fetch_all(true);
$skills = $db->query("SELECT * FROM resume_skills WHERE resume_id=" . $resume['id'])->fetch_all(true);
$education = $db->query("SELECT * FROM resume_education WHERE resume_id=" . $resume['id'])->fetch_all(true);
$projects = $db->query("SELECT * FROM resume_projects WHERE resume_id=" . $resume['id'])->fetch_all(true);
$references = $db->query("SELECT * FROM resume_references WHERE resume_id=" . $resume['id'])->fetch_all(true);

// Helper function to clone data from the provided section
function cloneSection($db, $sectionData, $tableName, $resume_id)
{
    if (!empty($sectionData)) {
        foreach ($sectionData as $data) {
            $columns = [];
            $values = [];
            unset($data['id']);
            $data['resume_id'] = $resume_id;

            foreach ($data as $index => $value) {
                $sanitized_value = $db->real_escape_string($value);
                $columns[] = $index;
                $values[] = "'$sanitized_value'";
            }

            $query = "INSERT INTO $tableName (" . implode(',', $columns) . ") VALUES (" . implode(',', $values) . ")";
            if (!$db->query($query)) {
                throw new Exception($db->error);
            }
        }
    }
}

$new_slug = $fn->randomString();
$last_four_chars_of_slug = substr($new_slug, -4); // Get last 4 characters of the slug

// Clone resume
$columns = [];
$values = [];
unset($resume['id'], $resume['slug'], $resume['updated_at']);
$columns[] = 'resume_title';
$values[] = "'Copy of " . $resume['resume_title'] . " " . $last_four_chars_of_slug . "'";
unset($resume['resume_title']);

foreach ($resume as $index => $value) {
    $sanitized_value = $db->real_escape_string($value);
    $columns[] = $index;
    $values[] = "'$sanitized_value'";
}

// Add additional columns
$authid = $fn->Auth()['id'];
$columns[] = 'slug';
$values[] = "'$new_slug'";
$columns[] = 'updated_at';
$values[] = "'" . time() . "'";

try {
    // Insert data into resumes table
    $query = "INSERT INTO resumes (" . implode(',', $columns) . ") VALUES (" . implode(',', $values) . ")";
    if (!$db->query($query)) {
        throw new Exception($db->error);
    }

    $resume_id = $db->insert_id;

    // Clone sections using the helper function
    cloneSection($db, $experience, 'resume_experience', $resume_id);
    cloneSection($db, $skills, 'resume_skills', $resume_id);
    cloneSection($db, $education, 'resume_education', $resume_id);
    cloneSection($db, $projects, 'resume_projects', $resume_id);
    cloneSection($db, $references, 'resume_references', $resume_id);

    $fn->setAlert('Resume cloned successfully!');
    $fn->redirect('../index.php');

} catch (Exception $e) {
    $fn->setError($e->getMessage());
    $fn->redirect('../index.php');
}
?>