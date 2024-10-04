<?php
$title = "Change Password | Resume Builder";
require './assets/includes/inc.header.php';
$fn->nonAuthPage();
?>

<div class="d-flex align-items-center p-3" style="height: 100vh;">
  <div class="w-100">
    <main class="form-signin w-100 m-auto bg-white shadow rounded">
      <form action="actions/action.password_change.php" method="POST"> <!-- Add action and method -->
        <div class="d-flex gap-2 justify-content-center">
          <img class="mb-4" src="./assets/images/resume_icon.gif" alt="" height="70" />

          <div>
            <h1 class="h3 fw-normal my-1"><b>Resume</b> Builder</h1>
            <p class="m-0">Change Password</p>
          </div>
        </div>

        <div class="mb-3">
          <!-- Display session email dynamically -->
          <span class="mb-3 fw-bold"><?= $fn->getSession('email_id') ?: $fn->redirect('password_forgot.php'); ?></span>
        </div>

        <!-- Use password input type -->
        <div class="form-floating mb-4">
          <input type="password" class="form-control" id="newPassword" name="new_password"
            placeholder="Enter new password" required />
          <label for="newPassword"><i class="bi bi-key"></i> Enter new password</label>
        </div>

        <button class="btn btn-primary w-100 py-2" type="submit">
          Change Password
        </button>

        <div class="d-flex justify-content-between my-3">
          <a href="user_register.php" class="text-decoration-none">Register</a>
          <a href="user_login.php" class="text-decoration-none">Login</a>
        </div>
      </form>
    </main>
  </div>
</div>

<?php require './assets/includes/inc.footer.php'; ?>