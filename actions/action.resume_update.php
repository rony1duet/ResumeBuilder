<?php
require '../assets/class/class.Database.php';
require '../assets/class/class.Functions.php';

if ($_POST) {
    $post = $_POST;
    $slug = $db->real_escape_string($_GET['slug']);
    $resume_id = $db->query("SELECT id FROM resumes WHERE slug = '$slug'")->fetch_assoc()['id'];

    if (!$resume_id) {
        $fn->setError('Invalid resume!');
        $fn->redirect('../index.php');
    }

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['tmp_name']) {
        try {
            $file_tmp = $_FILES['profile_picture']['tmp_name'];
            $file_type = $_FILES['profile_picture']['type'];
            if ($file_type !== 'image/jpeg' && $file_type !== 'image/png') {
                throw new Exception("Unsupported image format. Only JPEG and PNG are allowed.");
            }

            // Create image from file based on type
            $src_image = ($file_type === 'image/jpeg') ? imagecreatefromjpeg($file_tmp) : imagecreatefrompng($file_tmp);

            // Crop and resize image
            $orig_width = imagesx($src_image);
            $orig_height = imagesy($src_image);
            $min_side = min($orig_width, $orig_height);
            $crop_x = ($orig_width - $min_side) / 2;
            $crop_y = ($orig_height - $min_side) / 2;

            $dst_image = imagecreatetruecolor(400, 400);
            imagecopyresampled($dst_image, $src_image, 0, 0, $crop_x, $crop_y, 400, 400, $min_side, $min_side);
            ob_start();
            if ($file_type === 'image/jpeg') {
                imagejpeg($dst_image, null, 90);
            } else {
                imagepng($dst_image);
            }
            $image_data = ob_get_contents();
            ob_end_clean();
            $post['profile_picture'] = base64_encode($image_data);
            imagedestroy($src_image);
            imagedestroy($dst_image);
        } catch (Exception $e) {
            $fn->setError($e->getMessage());
            $fn->redirect('../resume_update.php');
            exit;
        }
    }

    // Ensure all required fields are present
    $required_fields = ['full_name', 'email', 'phone_number', 'linkedin', 'portfolio', 'summary'];
    foreach ($required_fields as $field) {
        if (empty($post[$field])) {
            $fn->setError('Please fill all required fields.');
            $fn->redirect('../resume_update.php');
            exit;
        }
    }

    $columns = [];
    $update_values = [];

    foreach ($post as $index => $value) {
        if (!is_array($value)) {
            $sanitized_value = $db->real_escape_string($value);
            $update_values[] = "$index = '$sanitized_value'";
        }
    }

    $update_values[] = 'updated_at = ' . "'" . time() . "'";

    try {
        // Update the resume in the database
        $query = "UPDATE resumes SET " . implode(',', $update_values) . " WHERE id = $resume_id";
        if (!$db->query($query)) {
            throw new Exception($db->error);
        }

        // Function to update records (experience, skills, education, projects, references)
        function updateRecords($db, $resume_id, $table, $data, $columns)
        {
            // First, delete old records
            $db->query("DELETE FROM $table WHERE resume_id = $resume_id");

            // Prepare insert query for each set of data
            foreach ($data[$columns[0]] as $key => $value) {
                $values = [];
                foreach ($columns as $column) {
                    // If a column is missing from the data array, assign an empty string
                    if (isset($data[$column][$key])) {
                        $values[] = $db->real_escape_string($data[$column][$key]);
                    } else {
                        $values[] = '';
                    }
                }
                $value_placeholders = implode("', '", $values);

                $query = "INSERT INTO $table (resume_id, " . implode(', ', $columns) . ") VALUES ('$resume_id', '$value_placeholders')";

                if (!$db->query($query)) {
                    throw new Exception($db->error);
                }
            }
        }

        // Update experience
        if (!empty($post['experience'])) {
            updateRecords($db, $resume_id, 'resume_experience', $post['experience'], ['job_title', 'company', 'start_date', 'end_date', 'description']);
        }

        // Update skills
        if (!empty($post['skills'])) {
            updateRecords($db, $resume_id, 'resume_skills', ['skill' => $post['skills']], ['skill']);
        }

        // Update education
        if (!empty($post['education'])) {
            updateRecords($db, $resume_id, 'resume_education', $post['education'], ['degree', 'institution', 'start_date', 'end_date', 'achievements']);
        }

        // Update projects
        if (!empty($post['projects'])) {
            $db->query("DELETE FROM resume_projects WHERE resume_id = $resume_id");
            foreach ($post['projects']['title'] as $key => $title) {
                $project_link = $db->real_escape_string($post['projects']['link'][$key]);
                $description = $db->real_escape_string($post['projects']['description'][$key]);

                $query = "INSERT INTO resume_projects (resume_id, title, project_link, description) 
                          VALUES ('$resume_id', '$title', '$project_link', '$description')";
                if (!$db->query($query)) {
                    throw new Exception($db->error);
                }
            }
        }

        // Update references
        if (!empty($post['references'])) {
            updateRecords($db, $resume_id, 'resume_references', $post['references'], ['name', 'company', 'position', 'relationship', 'ref_email', 'ref_number']);
        }

        $fn->setAlert('Resume updated successfully!');
        $fn->redirect('../index.php');

    } catch (Exception $e) {
        $fn->setError($e->getMessage());
        $fn->redirect('../resume_update.php');
    }
}
?>