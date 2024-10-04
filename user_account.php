<?php
$title = "Account | Resume Builder";
require './assets/includes/inc.header.php';
$fn->AuthPage();
require './assets/includes/inc.navbar.php';

$user = $db->query("SELECT full_name, email_id FROM users WHERE id='" . $fn->Auth()['id'] . "'")->fetch_assoc();
?>

<div class="container">
  <div class="bg-white rounded shadow p-2 mt-4">
    <div class="d-flex justify-content-between border-bottom">
      <h5>Account</h5>
      <div>
        <a class="text-decoration-none" onclick='history.back()'><i class="bi bi-arrow-left-circle"></i> Back</a>
      </div>
    </div>

    <div>
      <form class="row g-3 p-3" action="actions/action.profile_update.php" method="POST">
        <div class="col-md-6">
          <label class="form-label">Full Name</label>
          <input type="text" name="full_name" placeholder="Your Name" class="form-control"
            value="<?= htmlspecialchars($user['full_name']) ?>" required />
        </div>
        <div class="col-md-6">
          <label class="form-label">Email</label>
          <input type="email" name="email_id" placeholder="example@gmail.com" class="form-control"
            value="<?= htmlspecialchars($user['email_id']) ?>" required />
        </div>
        <div class="col-12">
          <label class="form-label">New Password (Leave empty if you don't want to change)</label>
          <input type="password" name="password" placeholder="Enter new password" class="form-control" />
        </div>

        <div class="col-12 text-end">
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-floppy"></i> Update Profile
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php require './assets/includes/inc.footer.php'; ?>