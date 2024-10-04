<?php
$title = "Forgot Password | Resume Builder";
require './assets/includes/inc.header.php';
$fn->nonAuthPage();
?>

<div class="d-flex align-items-center p-3" style="height:100vh;">
    <div class="w-100">
        <main class="form-signin w-100 m-auto bg-white shadow rounded">
            <!-- Form submission to send the verification code -->
            <form action="actions/action.otp_send.php" method="POST">
                <div class="d-flex gap-2 justify-content-center">
                    <img class="mb-4" src="./assets/images/logo_main.gif" alt="Resume Builder Logo" height="70">

                    <div>
                        <h1 class="h3 fw-normal my-1"><b>Resume</b> Builder</h1>
                        <p class="m-0">Forgot your password?</p>
                    </div>
                </div>

                <!-- Email input for password reset -->
                <div class="form-floating mb-4">
                    <input type="email" class="form-control" id="floatingEmail" name="email_id"
                        placeholder="name@example.com" required>
                    <label for="floatingEmail"><i class="bi bi-envelope"></i> Email address</label>
                </div>

                <!-- Submit button -->
                <button class="btn btn-primary w-100 py-2" type="submit">
                    <i class="bi bi-send"></i> Send Verification Code
                </button>

                <!-- Links to register or login -->
                <div class="d-flex justify-content-between my-3">
                    <a href="user_register.php" class="text-decoration-none">Register</a>
                    <a href="user_login.php" class="text-decoration-none">Login</a>
                </div>
            </form>
        </main>
    </div>
</div>

<?php require './assets/includes/inc.footer.php'; ?>