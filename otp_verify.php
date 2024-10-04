<?php
$title = "Verification | Resume Builder";
require './assets/includes/inc.header.php';
$fn->nonAuthPage();
$type = $_GET['type'] ?? null;
if ($type == '') {
  $fn->redirect('./user_login.php');
}
?>

<div class="d-flex align-items-center p-3" style="height: 100vh;">
  <div class="w-100">
    <main class="form-signin w-100 m-auto bg-white shadow rounded">
      <form action="actions/action.otp_verify.php" method="POST">
        <div class="d-flex gap-2 justify-content-center">
          <img class="mb-4" src="./assets/images/logo_main.gif" alt="Resume Builder Logo" height="70" />
          <div>
            <h1 class="h3 fw-normal my-1"><b>Resume</b> Builder</h1>
            <p class="m-0">Verify your email</p>
          </div>
        </div>
        <div class="mb-3">
          A 6-digit code was sent to <span class="fw-bold"><?= $fn->getSession('email_id') ?></span>
        </div>
        <div class="form-floating mb-4">
          <input type="number" class="form-control" id="verificationCode" name="otp" placeholder="Enter 6-digit code"
            required>
          <label for="verificationCode"><i class="bi bi-patch-check"></i> Enter 6-Digit Code</label>
        </div>
        <input type="hidden" name="type" value="<?= htmlspecialchars($type) ?>" />
        <button class="btn btn-primary w-100 py-2" type="submit">Verify Email</button>
      </form>
    </main>
  </div>
</div>

<?php require './assets/includes/inc.footer.php'; ?>