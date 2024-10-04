<?php
require './assets/class/class.Database.php';
require './assets/class/class.Functions.php';

$slug = $_GET['resume'] ?? '';
$resume = $db->query("SELECT * FROM resumes WHERE (slug='$slug')")->fetch_assoc();
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

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" />
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?&family=Caveat&family=Dancing+Script&family=Fredoka&family=Handlee&family=Lora&family=Merriweather+Sans&family=Montserrat&family=Noto+Sans&family=Noto+Serif&family=Open+Sans&family=Playfair+Display&family=Playpen+Sans&family=Playwrite+DE+Grund&family=Poppins&family=PT+Sans&family=PT+Sans+Narrow&family=PT+Serif&family=Raleway&family=Roboto&family=Roboto+Flex&family=Roboto+Serif&family=Source+Sans+3&family=Cardo&family=Italiana&family=Karla&family=Ubuntu&display=swap"
    rel="stylesheet">

  <link rel="icon" href="./assets/images/logo.jpg" />
  <title><?= $resume['full_name'] . ' | ' . $resume['resume_title'] ?></title>
  <?php require './assets/css/customResumeStyle.php'; ?>
</head>

<body>

  <?php

  $login_id = $fn->Auth()['id'];
  $resume_id = $resume['user_id'];

  if ($login_id == $resume_id && $fn->Auth()) {
  ?>
    <!----Resume Extra Buttons---->
    <div id="extraFunctionlities">
      <div class="action-buttons text-center my-4">
        <button id="save-btn" class="btn btn-primary mx-2"><i class="bi bi-save"></i> Save</button>
        <button id="theme-btn" class="btn btn-secondary mx-2" data-bs-toggle="offcanvas"
          data-bs-target="#theme-offcanvasRight"><i class="bi bi-palette"></i> Theme</button>
        <button id="font-btn" class="btn btn-info mx-2" data-bs-toggle="offcanvas"
          data-bs-target="#font-offcanvasRight"><i class="bi bi-file-earmark-font"></i> Font</button>
        <button id="share-btn" class="btn btn-success mx-2"><i class="bi bi-share"></i> Share</button>
      </div>
    </div>
  <?php
  }
  ?>

  <div class="offcanvas offcanvas-end" tabindex="-1" id="theme-offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasTopLabel">Change Theme</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <div class="theme-container">
        <!-- Default Theme Block -->
        <div class="theme-item">
          <div class="theme-block" data-theme="defaultTheme" onclick="selectTheme(this)">
            <div class="light-section" style="background: #f7f9fc;"></div>
            <div class="dark-section" style="background: #1a1b2e;"></div>
          </div>
          <p class="theme-name">Default Theme</p>
        </div>

        <!-- Classic Navy -->
        <div class="theme-item">
          <div class="theme-block" data-theme="ClassicNavy" onclick="selectTheme(this)">
            <div class="light-section" style="background: #EAEFF2;"></div>
            <div class="dark-section" style="background: #1A1B2E;"></div>
          </div>
          <p class="theme-name">Classic Navy</p>
        </div>

        <!-- Elegant Rose -->
        <div class="theme-item">
          <div class="theme-block" data-theme="ElegantRose" onclick="selectTheme(this)">
            <div class="light-section" style="background: #F8ECEA;"></div>
            <div class="dark-section" style="background: #EF476F;"></div>
          </div>
          <p class="theme-name">Elegant Rose</p>
        </div>

        <!-- Sunset Orange -->
        <div class="theme-item">
          <div class="theme-block" data-theme="SunsetOrange" onclick="selectTheme(this)">
            <div class="light-section" style="background: #FFF2E2;"></div>
            <div class="dark-section" style="background: #F78C6B;"></div>
          </div>
          <p class="theme-name">Sunset Orange</p>
        </div>

        <!-- Golden Glow -->
        <div class="theme-item">
          <div class="theme-block" data-theme="GoldenGlow" onclick="selectTheme(this)">
            <div class="light-section" style="background: #FFF9E1;"></div>
            <div class="dark-section" style="background: #FFD166;"></div>
          </div>
          <p class="theme-name">Golden Glow</p>
        </div>

        <!-- Mint Green -->
        <div class="theme-item">
          <div class="theme-block" data-theme="MintGreen" onclick="selectTheme(this)">
            <div class="light-section" style="background: #E6FFF5;"></div>
            <div class="dark-section" style="background: #06D6A0;"></div>
          </div>
          <p class="theme-name">Mint Green</p>
        </div>

        <!-- Sky Blue -->
        <div class="theme-item">
          <div class="theme-block" data-theme="SkyBlue" onclick="selectTheme(this)">
            <div class="light-section" style="background: #E0F5FF;"></div>
            <div class="dark-section" style="background: #118AB2;"></div>
          </div>
          <p class="theme-name">Sky Blue</p>
        </div>

        <!-- Slate Dark -->
        <div class="theme-item">
          <div class="theme-block" data-theme="SlateDark" onclick="selectTheme(this)">
            <div class="light-section" style="background: #E3E6E8;"></div>
            <div class="dark-section" style="background: #073B4C;"></div>
          </div>
          <p class="theme-name">Slate Dark</p>
        </div>
      </div>
    </div>
  </div>





  <!-- Font Selection Offcanvas -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="font-offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasTopLabel">Change Font</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">
      <select class="form-control" id="fonts">

        <!-- Handwriting Fonts -->
        <option value="Caveat" style="font-family: 'Caveat';">Caveat</option>
        <option value="Dancing Script" style="font-family: 'Dancing Script';">Dancing Script</option>
        <option value="Handlee" style="font-family: 'Handlee';">Handlee</option>

        <!-- Modern Fonts -->
        <option value="Fredoka" style="font-family: 'Fredoka';">Fredoka</option>
        <option value="Playpen Sans" style="font-family: 'Playpen Sans';">Playpen Sans</option>
        <option value="Playwrite DE Grund" style="font-family: 'Playwrite DE Grund';">Playwrite DE Grund</option>
        <option value="Poppins" style="font-family: 'Poppins';">Poppins</option>
        <option value="Raleway" style="font-family: 'Raleway';">Raleway</option>
        <option value="Montserrat" style="font-family: 'Montserrat';">Montserrat</option>

        <!-- Serif Fonts -->
        <option value="Lora" style="font-family: 'Lora';">Lora</option>
        <option value="Noto Serif" style="font-family: 'Noto Serif';">Noto Serif</option>
        <option value="Playfair Display" style="font-family: 'Playfair Display';">Playfair Display</option>
        <option value="PT Serif" style="font-family: 'PT Serif';">PT Serif</option>
        <option value="Cardo" style="font-family: 'Cardo';">Cardo</option>
        <option value="Italiana" style="font-family: 'Italiana';">Italiana</option>
        <option value="Roboto Serif" style="font-family: 'Roboto Serif';">Roboto Serif</option>

        <!-- Sans-Serif Fonts -->
        <option value="Merriweather Sans" style="font-family: 'Merriweather Sans';">Merriweather Sans</option>
        <option value="Noto Sans" style="font-family: 'Noto Sans';">Noto Sans</option>
        <option value="Open Sans" style="font-family: 'Open Sans';">Open Sans</option>
        <option value="PT Sans" style="font-family: 'PT Sans';">PT Sans</option>
        <option value="PT Sans Narrow" style="font-family: 'PT Sans Narrow';">PT Sans Narrow</option>
        <option value="Roboto" style="font-family: 'Roboto';">Roboto</option>
        <option value="Roboto Flex" style="font-family: 'Roboto Flex';">Roboto Flex</option>
        <option value="Source Sans 3" style="font-family: 'Source Sans 3';">Source Sans 3</option>
        <option value="Karla" style="font-family: 'Karla';">Karla</option>
        <option value="Ubuntu" style="font-family: 'Ubuntu';">Ubuntu</option>

      </select>
    </div>

  </div>

  <!---------------- Resume Content ---------------->

  <page size="A4">
    <div class="resume-container" id="resume_area" style="font-family: <?= $resume['font'] ?>;">
      <!-- Left Section -->
      <div class="left-section">
        <!-- Profile Header -->
        <div class="profile-header">
          <div class="profile-image">
            <img id="profile-preview" alt="Profile Picture">
          </div>
          <h2 class="mb-1" style="font-size: 20px;"><?= $resume['full_name']; ?></h2>
          <p class="text-muted" style="font-size: 14px;"><?= $resume['resume_title']; ?></p>
          <p class="objective text-center" style="font-size: 12px;"><?= $resume['summary'] ?></p>
        </div>

        <!-- Personal Details -->
        <div class="section-content">
          <h3 class="section-title"><i class="bi bi-person-lines-fill"></i>Contact</h3>
          <div class="contact-item"><i class="bi bi-telephone-fill"></i><span><?= $resume['phone_number'] ?></span>
          </div>
          <div class="contact-item"><i class="bi bi-envelope-fill"></i><span><?= $resume['email'] ?></span></div>
          <div class="contact-item"><i class="bi bi-linkedin"></i>
            <?php
            $linkedin = $resume['linkedin'];
            if (strpos($linkedin, 'http://') !== 0 && strpos($linkedin, 'https://') !== 0) {
              $linkedin = 'http://' . $linkedin;
            }
            ?>
            <a href="<?= $linkedin ?>"><?= $resume['linkedin'] ?></a>
          </div>
          <div class="contact-item"><i class="bi bi-globe"></i>

            <?php
            $portfolio = $resume['portfolio'];
            if (strpos($portfolio, 'http://') !== 0 && strpos($portfolio, 'https://') !== 0) {
              $portfolio = 'http://' . $portfolio;
            }
            ?>

            <a href="<?= $portfolio ?>"><?= $resume['portfolio'] ?></a>
          </div>
        </div>

        <!-- Skills -->
        <div class="skills section-content">
          <h3 class="section-title"><i class="bi bi-lightning-fill"></i>Skills</h3>
          <?php foreach ($skills as $skill) {
          ?>
            <span class="skill-item"><?= $skill['skill'] ?></span>
          <?php
          } ?>
        </div>

        <!-- References -->
        <div class="references section-content">
          <h3 class="section-title"><i class="bi bi-people-fill"></i>References</h3>
          <div class="reference-item">
            <?php foreach ($references as $ref) { ?>
              <p style="font-size: 12px; text-align: justify;">
                <strong style="font-size: 16px !important;"><?= $ref['name'] ?></strong>, <?= $ref['position'] ?> at
                <strong><?= $ref['company'] ?></strong>, can be reached via
                email at
                <strong><a href="mailto:<?= $ref['ref_email'] ?>"><?= $ref['ref_email'] ?></a></strong> or by phone at
                <strong><a href="tel:<?= $ref['ref_number'] ?>"><?= $ref['ref_number'] ?></a></strong>. Our professional
                relationship was
                established through <?= $ref['relationship'] ?>.
              </p>
            <?php } ?>
          </div>
        </div>

      </div>

      <!-- Right Section -->
      <div class="right-section">
        <!-- Work Experience -->
        <div class="work-experience section-content">
          <h3 class="section-title"><i class="bi bi-briefcase-fill"></i>Experience</h3>
          <?php foreach ($experience as $exp) {
          ?>
            <div class="experience-item">
              <strong><?= $exp['job_title'] ?></strong> @ <?= $exp['company'] ?>
              <div><?= date('F, Y', strtotime($exp['start_date'])) ?> to
                <?php
                if ($exp['end_date'] == '') {
                  echo 'Present';
                } else {
                  echo date('F, Y', strtotime($exp['end_date']));
                } ?>
              </div>
              <p style="font-size: 12px; text-align: justify; "><?= $exp['description'] ?></p>
            </div>
          <?php
          } ?>
        </div>

        <!-- Education -->
        <div class="education section-content">
          <h3 class="section-title"><i class="bi bi-mortarboard-fill"></i>Education</h3>
          <div class="education-item">
            <?php foreach ($education as $edu) {
            ?>
              <strong><?= $edu['degree'] ?></strong> @ <?= $edu['institution'] ?>
              <div><?= date('F, Y', strtotime($edu['start_date'])) ?> to
                <?php
                if ($edu['end_date'] == '') {
                  echo 'Present';
                } else {
                  echo date('F, Y', strtotime($edu['end_date']));
                } ?>
              </div>
              <p style="font-size: 12px; text-align: justify;"><?= $edu['achievements'] ?></p>
            <?php
            } ?>
          </div>
        </div>

        <!-- Projects -->
        <div class="projects section-content">
          <h3 class="section-title"><i class="bi bi-diagram-3-fill"></i>Projects</h3>

          <?php foreach ($projects as $project) {
          ?>
            <div class="project-item">
              <strong><?= $project['title'] ?></strong>
              <?php
              $project_link = $project['project_link'];
              if (strpos($project_link, 'http://') !== 0 && strpos($project_link, 'https://') !== 0) {
                $project_link = 'http://' . $project_link;
              }
              ?>
              <p style="font-size: 12px;"><a href="<?= $project_link ?>"><?= $project['project_link'] ?></a></p>
              <p style="font-size: 12px; text-align: justify;"><?= $project['description'] ?></p>
            </div>
          <?php
          } ?>
        </div>
      </div>
    </div>
  </page>
  
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

  <?php require './assets/js/customResumeAnimation.php'; ?>

</body>

</html>