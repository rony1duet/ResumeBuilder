<?php
$title = "Update Resume | Resume Builder";
require './assets/includes/inc.header.php';
$fn->AuthPage();
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

?>

<div class="container">
  <div class="bg-white rounded shadow p-4 mt-4 mb-4" style="min-height: 80vh;">
    <div class="d-flex justify-content-between border-bottom mb-3">
      <h5>Create Your Resume</h5>
      <div>
        <a class="text-decoration-none" onclick='history.back()'>
          <i class="bi bi-arrow-left-circle"></i> Back
        </a>
      </div>
    </div>

    <form id="resumeForm"
      action="actions/action.resume_update.php?slug=<?= htmlspecialchars($resume['slug'], ENT_QUOTES, 'UTF-8'); ?>"
      method="POST" class="row g-3 p-3" enctype="multipart/form-data">

      <!-- Resume Title -->
      <div class="col-md-12 d-flex align-items-center mb-3">
        <label class="form-label me-2 mb-0" style="white-space: nowrap;">Resume Title</label>
        <input type="text" name="resume_title" value="<?= $resume['resume_title'] ?>"
          placeholder="Enter your resume title" class="form-control flex-grow-1" required />
      </div>

      <!-- Profile Picture -->
      <h5 class="mt-4 text-secondary">
        <i class="bi bi-image"></i> Profile Picture
      </h5>
      <div class="col-12 text-center p-2 border border-2 rounded-1 border-light">
        <label for="profilePicture" class="form-label">Upload Your Picture</label>
        <div class="profile-img-container mb-3">
          <img id="profile-preview" src="./assets/images/profile.png" alt="Profile Picture"
            class="img-fluid rounded-circle"
            style="width: 150px; height: 150px; object-fit: cover; border: 2px solid #ddd;">
        </div>
        <input type="file" name="profile_picture" class="form-control" id="profilePicture"
          accept="image/jpeg,image/png" />
        <small class="text-muted">Accepted formats: JPG, PNG. Max size: 1 MB [400px x 400px]</small>
      </div>

      <!-- Personal Information -->
      <h5 class="mt-4 text-secondary">
        <i class="bi bi-person-badge"></i> Personal Information
      </h5>
      <div class="col-md-6">
        <label class="form-label">Full Name</label>
        <input type="text" name="full_name" value="<?= $resume['full_name'] ?>" placeholder="Md Rony Hossen"
          class="form-control" required />
      </div>
      <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="email" name="email" value="<?= $resume['email'] ?>" placeholder="rony.hossen.duet@gmail.com"
          class="form-control" required />
      </div>
      <div class="col-md-6">
        <label class="form-label">Phone Number</label>
        <input type="tel" name="phone_number" pattern="\+\d{1,3}\d{7,14}" value="<?= $resume['phone_number'] ?>"
          placeholder="+8801571208220" class="form-control" required />
      </div>
      <div class="col-md-6">
        <label class="form-label">LinkedIn Profile</label>
        <input type="text" id="website" name="linkedin" value="<?= $resume['linkedin'] ?>"
          placeholder="www.linkedin.com/in/rony1duet" class="form-control" />
      </div>
      <div class="col-md-6">
        <label class="form-label">Portfolio / Website</label>
        <input type="text" id="website" name="portfolio" value="<?= $resume['portfolio'] ?>"
          placeholder="rony1duet.github.io/gitcodehub" class="form-control" />
      </div>

      <hr />

      <!-- Professional Summary -->
      <h5 class="text-secondary">
        <i class="bi bi-journal"></i> Professional Summary
      </h5>
      <div class="col-12">
        <label class="form-label">Summary</label>
        <textarea name="summary" class="form-control" rows="4"
          placeholder="Brief summary about your experience, goals, and key skills"
          required><?= $resume['summary'] ?></textarea>
      </div>
      <hr />

      <!-- Professional Experience -->
      <h5 class="text-secondary">
        <i class="bi bi-briefcase"></i> Professional Experience
      </h5>
      <div id="experience-section">
        <?php

        if ($experience) {
          foreach ($experience as $exp) {
            ?>
            <div class="row experience-entry p-2 border border-2 rounded-2 border-light">
              <div class="col-md-6">
                <label class="form-label">Job Title</label>
                <input type="text" name="experience[job_title][]" value="<?= $exp['job_title'] ?>"
                  placeholder="Software Engineer" class="form-control" required />
              </div>
              <div class="col-md-6">
                <label class="form-label">Company</label>
                <input type="text" name="experience[company][]" value="<?= $exp['company'] ?>" placeholder="Google"
                  class="form-control" required />
              </div>
              <div class="col-md-6">
                <label class="form-label">Start Date</label>
                <input type="month" name="experience[start_date][]" value="<?= $exp['start_date'] ?>" class="form-control"
                  required />
              </div>
              <div class="col-md-6">
                <label class="form-label">End Date</label>
                <input type="month" name="experience[end_date][]" value="<?= $exp['end_date'] ?>" class="form-control" />
                <small class="text-muted">Leave blank if currently working</small>
              </div>
              <div class="col-12">
                <label class="form-label">Key Achievements & Responsibilities</label>
                <textarea name="experience[description][]" class="form-control" rows="3"
                  placeholder="Describe your responsibilities and accomplishments in this role"
                  required><?= $exp['description'] ?></textarea>
              </div>
            </div>
            <?php
          }
        } else {
          ?>
          <div class="row experience-entry p-2 border border-2 rounded-2 border-light">
            <div class="col-md-6">
              <label class="form-label">Job Title</label>
              <input type="text" name="experience[job_title][]" placeholder="Software Engineer" class="form-control"
                required />
            </div>
            <div class="col-md-6">
              <label class="form-label">Company</label>
              <input type="text" name="experience[company][]" placeholder="Google" class="form-control" required />
            </div>
            <div class="col-md-6">
              <label class="form-label">Start Date</label>
              <input type="month" name="experience[start_date][]" class="form-control" required />
            </div>
            <div class="col-md-6">
              <label class="form-label">End Date</label>
              <input type="month" name="experience[end_date][]" class="form-control" />
              <small class="text-muted">Leave blank if currently working</small>
            </div>
            <div class="col-12">
              <label class="form-label">Key Achievements & Responsibilities</label>
              <textarea name="experience[description][]" class="form-control" rows="3"
                placeholder="Describe your responsibilities and accomplishments in this role" required></textarea>
            </div>
          </div>
          <?php

        }

        ?>
      </div>
      <div class="col-12 d-flex justify-content-between align-items-center">
        <button type="button" class="btn btn-outline-primary add-experience">
          <i class="bi bi-file-earmark-plus"></i> Add New
        </button>
        <button type="button" class="btn btn-danger remove-experience" style="display: none;">
          <i class="bi bi-x-lg"></i> Remove
        </button>
      </div>
      <hr />

      <!-- Skills -->
      <h5 class="text-secondary">
        <i class="bi bi-lightbulb"></i> Skills
      </h5>

      <div id="skills-section">
        <?php
        if ($skills) {
          foreach ($skills as $skill) {
            ?>
            <div class="row skill-entry">
              <div class="col-md-6">
                <label class="form-label">Skill</label>
                <input type="text" name="skills[]" value="<?= $skill['skill'] ?>" placeholder="e.g. Java, Python, C++"
                  class="form-control" required />
              </div>
            </div>
            <?php
          }
        } else {
          ?>
          <div class="row skill-entry">
            <div class="col-md-6">
              <label class="form-label">Skill</label>
              <input type="text" name="skills[]" placeholder="e.g. Java, Python, C++" class="form-control" required />
            </div>
          </div>
          <?php
        }
        ?>
      </div>
      <div class="col-12 d-flex justify-content-between align-items-center">
        <button type="button" class="btn btn-outline-primary add-skill">
          <i class="bi bi-file-earmark-plus"></i> Add New
        </button>
        <button type="button" class="btn btn-danger remove-skill" style="display: none;">
          <i class="bi bi-x-lg"></i> Remove
        </button>
      </div>
      <hr />

      <!-- Education -->
      <h5 class="text-secondary">
        <i class="bi bi-book"></i> Education
      </h5>
      <div id="education-section">
        <?php
        if ($education) {
          foreach ($education as $edu) {
            ?>
            <div class="row education-entry p-2 border border-2 rounded-2 border-light">
              <div class="col-md-6">
                <label class="form-label">Degree</label>
                <input type="text" name="education[degree][]" value="<?= $edu['degree'] ?>"
                  placeholder="Bachelor of Science in Engineering" class="form-control" required />
              </div>
              <div class="col-md-6">
                <label class="form-label">Institution</label>
                <input type="text" name="education[institution][]" value="<?= $edu['institution'] ?>"
                  placeholder="Dhaka University of Engineering & Technology" class="form-control" required />
              </div>
              <div class="col-md-6">
                <label class="form-label">Start Date</label>
                <input type="month" name="education[start_date][]" value="<?= $edu['start_date'] ?>" class="form-control"
                  required />
              </div>
              <div class="col-md-6">
                <label class="form-label">End Date</label>
                <input type="month" name="education[end_date][]" value="<?= $edu['end_date'] ?>" class="form-control" />
                <small class="text-muted">Leave blank if currently studying</small>
              </div>
              <div class="col-12">
                <label class="form-label">Achievements</label>
                <textarea name="education[achievements][]" class="form-control" rows="3"
                  placeholder="List your achievements in this program (optional)"><?= $edu['achievements'] ?></textarea>
              </div>
            </div>
            <?php
          }
        } else {
          ?>
          <div class="row education-entry p-2 border border-2 rounded-2 border-light">
            <div class="col-md-6">
              <label class="form-label">Degree</label>
              <input type="text" name="education[degree][]" placeholder="Bachelor of Science in Engineering"
                class="form-control" required />
            </div>
            <div class="col-md-6">
              <label class="form-label">Institution</label>
              <input type="text" name="education[institution][]"
                placeholder="Dhaka University of Engineering & Technology" class="form-control" required />
            </div>
            <div class="col-md-6">
              <label class="form-label">Start Date</label>
              <input type="month" name="education[start_date][]" class="form-control" required />
            </div>
            <div class="col-md-6">
              <label class="form-label">End Date</label>
              <input type="month" name="education[end_date][]" class="form-control" />
              <small class="text-muted">Leave blank if currently studying</small>
            </div>
            <div class="col-12">
              <label class="form-label">Achievements</label>
              <textarea name="education[achievements][]" class="form-control" rows="3"
                placeholder="List your achievements in this program (optional)"></textarea>
            </div>
          </div>
          <?php
        }
        ?>
      </div>
      <div class="col-12 d-flex justify-content-between align-items-center">
        <button type="button" class="btn btn-outline-primary add-education">
          <i class="bi bi-file-earmark-plus"></i> Add New
        </button>
        <button type="button" class="btn btn-danger remove-education" style="display: none;">
          <i class="bi bi-x-lg"></i> Remove
        </button>
      </div>
      <hr />

      <!-- Projects (Optional) -->
      <h5 class="text-secondary">
        <i class="bi bi-box-seam"></i> Projects
      </h5>
      <div id="projects-section">
        <?php
        if ($projects) {
          foreach ($projects as $project) {
            ?>
            <div class="row project-entry p-2 border border-2 rounded-2 border-light">
              <div class="col-md-6">
                <label class="form-label">Project Title</label>
                <input type="text" name="projects[title][]" value="<?= $project['title'] ?>" placeholder="GitCodeHub"
                  class="form-control" required />
              </div>
              <div class="col-md-6">
                <label class="form-label">Project Link</label>
                <input type="text" id="website" name="projects[link][]" value="<?= $project['project_link'] ?>"
                  placeholder="github.com/rony1duet/gitcodehub" class="form-control" required />
              </div>
              <div class="col-md-12">
                <label class="form-label">Description</label>
                <textarea name="projects[description][]" class="form-control" rows="3"
                  placeholder="Brief description of the project" required><?= $project['description'] ?></textarea>
              </div>
            </div>
            <?php
          }
        } else {
          ?>
          <div class="row project-entry p-2 border border-2 rounded-2 border-light">
            <div class="col-md-6">
              <label class="form-label">Project Title</label>
              <input type="text" name="projects[title][]" placeholder="GitCodeHub" class="form-control" required />
            </div>
            <div class="col-md-6">
              <label class="form-label">Project Link</label>
              <input type="text" id="website" name="projects[link][]" placeholder="github.com/rony1duet/gitcodehub"
                class="form-control" required />
            </div>
            <div class="col-md-12">
              <label class="form-label">Description</label>
              <textarea name="projects[description][]" class="form-control" rows="3"
                placeholder="Brief description of the project" required></textarea>
            </div>
          </div>
          <?php
        }
        ?>
      </div>
      <div class="col-12 d-flex justify-content-between align-items-center">
        <button type="button" class="btn btn-outline-primary add-project">
          <i class="bi bi-file-earmark-plus"></i> Add New
        </button>
        <button type="button" class="btn btn-danger remove-project" style="display: none;">
          <i class="bi bi-x-lg"></i> Remove
        </button>
      </div>

      <hr />

      <!-- References Section -->
      <h5 class="text-secondary">
        <i class="bi bi-people"></i> References
      </h5>
      <div id="references-section">
        <?php
        if ($references) {
          foreach ($references as $ref) {
            ?>
            <div class="row reference-entry p-2 border border-2 rounded-2 border-light">
              <div class="col-md-6">
                <label class="form-label">Name</label>
                <input type="text" name="references[name][]" value="<?= $ref['name'] ?>" placeholder="Greg Brockman"
                  class="form-control" required />
              </div>

              <div class="col-md-6">
                <label class="form-label">Company</label>
                <input type="text" name="references[company][]" value="<?= $ref['company'] ?>" placeholder="OpenAI"
                  class="form-control" required />
              </div>

              <div class="col-md-6">
                <label class="form-label">Position</label>
                <input type="text" name="references[position][]" value="<?= $ref['position'] ?>" placeholder="Co-founder"
                  class="form-control" required />
              </div>

              <div class="col-md-6">
                <label class="form-label">Relationship</label>
                <input type="text" name="references[relationship][]" value="<?= $ref['relationship'] ?>"
                  placeholder="Cross-functional team member" class="form-control" required />
              </div>

              <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" name="references[ref_email][]" value="<?= $ref['ref_email'] ?>"
                  placeholder="greg.brockman@openai.com" class="form-control" required />
              </div>

              <div class="col-md-6">
                <label class="form-label">Phone Number</label>
                <input type="tel" name="references[ref_number][]" pattern="\+\d{1,3}\d{7,14}"
                  value="<?= $ref['ref_number'] ?>" placeholder="+12025551234" class="form-control" required />
              </div>
            </div>

            <?php
          }
        } else {
          ?>
          <div class="row reference-entry p-2 border border-2 rounded-2 border-light">
            <div class="col-md-6">
              <label class="form-label">Name</label>
              <input type="text" name="references[name][]" placeholder="Greg Brockman" class="form-control" required />
            </div>

            <div class="col-md-6">
              <label class="form-label">Company</label>
              <input type="text" name="references[company][]" placeholder="OpenAI" class="form-control" required />
            </div>

            <div class="col-md-6">
              <label class="form-label">Position</label>
              <input type="text" name="references[position][]" placeholder="Co-founder" class="form-control" required />
            </div>

            <div class="col-md-6">
              <label class="form-label">Relationship</label>
              <input type="text" name="references[relationship][]" placeholder="Cross-functional team member"
                class="form-control" required />
            </div>

            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input type="email" name="references[ref_email][]" placeholder="greg.brockman@openai.com"
                class="form-control" required />
            </div>

            <div class="col-md-6">
              <label class="form-label">Phone Number</label>
              <input type="tel" name="references[ref_number][]" pattern="\+\d{1,3}\d{7,14}" placeholder="+12025551234"
                class="form-control" required />
            </div>
          </div>
          <?php
        }
        ?>
      </div>
      <div class="col-12 d-flex justify-content-between align-items-center">
        <button type="button" class="btn btn-outline-primary add-reference">
          <i class="bi bi-file-earmark-plus"></i> Add New
        </button>
        <button type="button" class="btn btn-danger remove-reference" style="display: none;">
          <i class="bi bi-x-lg"></i> Remove
        </button>
      </div>

      <hr />

      <!-- Submit -->
      <div class="col-12 text-end">
        <button type="submit" class="btn btn-primary">Update Resume</button>
      </div>
    </form>
  </div>
</div>

<?php
if ($resume['profile_picture'] != ''):
  ?>
  <script>
    function updateProfilePicture(base64Image) {
      const imgPreview = document.getElementById('profile-preview');
      imgPreview.src = base64Image;
    }
    const receivedBase64Image = "data:image/jpeg;base64,<?php echo $resume['profile_picture']; ?>";
    updateProfilePicture(receivedBase64Image);
  </script>
<?php endif; ?>

<?php
require './assets/includes/inc.footer.php';
?>