<?php
require '../assets/class/class.Database.php';
require '../assets/class/class.Functions.php';

if ($_POST) {
    $post = $_POST;

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['tmp_name']) {
        try {
            // Get temporary file and its details
            $file_tmp = $_FILES['profile_picture']['tmp_name'];
            $file_type = $_FILES['profile_picture']['type'];

            // Check if the file is an image
            if ($file_type !== 'image/jpeg' && $file_type !== 'image/png') {
                throw new Exception("Unsupported image format. Only JPEG and PNG are allowed.");
            }

            // Load the image based on file type
            if ($file_type === 'image/jpeg') {
                $src_image = imagecreatefromjpeg($file_tmp);
            } elseif ($file_type === 'image/png') {
                $src_image = imagecreatefrompng($file_tmp);
            } else {
                throw new Exception("Failed to load image.");
            }

            // Get the original dimensions
            $orig_width = imagesx($src_image);
            $orig_height = imagesy($src_image);

            // Calculate dimensions for cropping (1:1 aspect ratio)
            $min_side = min($orig_width, $orig_height);
            $crop_x = ($orig_width - $min_side) / 2;
            $crop_y = ($orig_height - $min_side) / 2;

            // Create a blank image for the cropped and resized result
            $dst_image = imagecreatetruecolor(400, 400);

            // Crop and resize the image to 400x400 px
            imagecopyresampled($dst_image, $src_image, 0, 0, $crop_x, $crop_y, 400, 400, $min_side, $min_side);

            // Compress and capture the final image in a buffer
            ob_start();
            if ($file_type === 'image/jpeg') {
                imagejpeg($dst_image, null, 90); // JPEG compression (90% quality)
            } elseif ($file_type === 'image/png') {
                imagepng($dst_image); // PNG compression (default)
            }
            $image_data = ob_get_contents();
            ob_end_clean();

            // Convert the compressed image data to base64
            $base64_image = base64_encode($image_data);
            $post['profile_picture'] = $base64_image;

            // Free up memory
            imagedestroy($src_image);
            imagedestroy($dst_image);

        } catch (Exception $e) {
            // Handle error and redirect
            $fn->setError($e->getMessage());
            $fn->redirect('../resume_create.php');
        }
    } else {
        echo "No profile picture provided!";
    }


    if ($post['full_name'] && $post['full_name'] && $post['email'] && $post['phone_number'] && $post['linkedin'] && $post['portfolio'] && $post['summary'] && $post['experience']) {
        // Initialize columns and values arrays for dynamic SQL construction
        $columns = [];
        $values = [];

        // Loop through the POST data to process fields
        foreach ($post as $index => $value) {
            if (!is_array($value)) {
                $sanitized_value = $db->real_escape_string($value);
                $columns[] = $index;
                $values[] = "'$sanitized_value'";
            }
        }

        // Add additional columns
        $user_id = $fn->Auth()['id'];
        $columns[] = 'slug';
        $values[] = "'" . $fn->randomString() . "'";
        $columns[] = 'updated_at';
        $values[] = "'" . time() . "'";
        $columns[] = 'user_id';
        $values[] = "'$user_id'";

        try {
            // Insert data into resumes table
            $query = "INSERT INTO resumes (" . implode(',', $columns) . ") VALUES (" . implode(',', $values) . ")";

            if (!$db->query($query)) {
                throw new Exception($db->error);  // Capture the SQL error
            }

            // Get the last inserted resume ID
            $resume_id = $db->insert_id;

            // Handle experience data (assuming it's in an array)
            if (!empty($post['experience'])) {
                foreach ($post['experience']['job_title'] as $key => $ob_title) {
                    $company = $db->real_escape_string($post['experience']['company'][$key]);
                    $start_date = $db->real_escape_string($post['experience']['start_date'][$key]);
                    $end_date = !empty($post['experience']['end_date'][$key]) ? $db->real_escape_string($post['experience']['end_date'][$key]) : null;
                    $description = $db->real_escape_string($post['experience']['description'][$key]);

                    // Insert experience into resume_experience table
                    $query = "INSERT INTO resume_experience (resume_id, job_title, company, start_date, end_date, description) 
                              VALUES ('$resume_id', '$ob_title', '$company', '$start_date', '$end_date', '$description')";
                    if (!$db->query($query)) {
                        throw new Exception($db->error);
                    }
                }
            }

            // Handle skills data (assuming it's in an array)
            if (!empty($post['skills'])) {
                foreach ($post['skills'] as $skill) {
                    $skill = $db->real_escape_string($skill);

                    // Insert skill into resume_skills table
                    $query = "INSERT INTO resume_skills (resume_id, skill) VALUES ('$resume_id', '$skill')";
                    if (!$db->query($query)) {
                        throw new Exception($db->error);
                    }
                }
            }

            // Handle education data (assuming it's in an array)
            if (!empty($post['education'])) {
                foreach ($post['education']['degree'] as $key => $degree) {
                    $institution = $db->real_escape_string($post['education']['institution'][$key]);
                    $start_date = $db->real_escape_string($post['education']['start_date'][$key]);
                    $end_date = !empty($post['education']['end_date'][$key]) ? $db->real_escape_string($post['education']['end_date'][$key]) : null;
                    $achievements = $db->real_escape_string($post['education']['achievements'][$key]);

                    // Insert education into resume_education table
                    $query = "INSERT INTO resume_education (resume_id, degree, institution, start_date, end_date, achievements) 
                              VALUES ('$resume_id', '$degree', '$institution', '$start_date', '$end_date', '$achievements')";
                    if (!$db->query($query)) {
                        throw new Exception($db->error);
                    }
                }
            }

            // Handle projects data (assuming it's in an array)
            if (!empty($post['projects'])) {
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

            // Handle references data (assuming it's in an array)
            if (!empty($post['references'])) {
                foreach ($post['references']['name'] as $key => $name) {

                    $company = $db->real_escape_string($post['references']['company'][$key]);
                    $position = $db->real_escape_string($post['references']['position'][$key]);
                    $relationship = $db->real_escape_string($post['references']['relationship'][$key]);
                    $ref_email = $db->real_escape_string($post['references']['ref_email'][$key]);
                    $ref_number = $db->real_escape_string($post['references']['ref_number'][$key]);

                    // Insert reference into resume_references table
                    $query = "INSERT INTO resume_references (resume_id, name, company, position, relationship, ref_email, ref_number) 
                              VALUES ('$resume_id', '$name', '$company', '$position', '$relationship', '$ref_email', '$ref_number')";
                    if (!$db->query($query)) {
                        throw new Exception($db->error);
                    }
                }
            }

            $fn->setAlert('Resume created successfully!');
            $fn->redirect('../index.php');

        } catch (Exception $e) {
            $fn->setError($e->getMessage());
            $fn->redirect('../resume_create.php');
        }
    } else {
        $fn->setError('Please fill in all required fields.');
        $fn->redirect('../resume_create.php');
    }
} else {
    $fn->setError('Invalid request.');
    $fn->redirect('../resume_create.php');
}
?>