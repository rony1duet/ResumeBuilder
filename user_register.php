<?php
$title = "Register | Resume Builder";
require './assets/includes/inc.header.php';
$fn->nonAuthPage();
?>

<div class="d-flex align-items-center" style="height:100vh">
    <div class="w-100">
        <main class="form-signin w-100 m-auto bg-white shadow rounded">
            <form action="actions/action.user_register.php" method="POST">
                <div class="d-flex gap-2 justify-content-center">
                    <img class="mb-4" src="./assets/images/logo_main.gif" alt="CV Maker Logo" height="70">
                    <div>
                        <h1 class="h3 fw-normal my-1"><b>Resume</b> Builder</h1>
                        <p class="m-0">Create your new account</p>
                    </div>
                </div>

                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingName" name="full_name"
                        placeholder="Enter your full name" required>
                    <label for="floatingName"><i class="bi bi-person"></i> Full Name</label>
                </div>
                <div class="form-floating">
                    <input type="email" class="form-control" id="floatingEmail" name="email_id"
                        placeholder="name@example.com" required>
                    <label for="floatingEmail"><i class="bi bi-envelope"></i> Email address</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" name="password"
                        placeholder="Password" required>
                    <label for="floatingPassword"><i class="bi bi-key"></i> Password</label>
                </div>

                <button class="btn btn-primary w-100 py-2" type="submit"><i class="bi bi-person-plus-fill"></i>
                    Register</button>
                <div class="d-flex justify-content-between my-3">
                    <a href="password_forgot.php" class="text-decoration-none">Forgot Password?</a>
                    <a href="user_login.php" class="text-decoration-none">Login</a>
                </div>
            </form>
        </main>
    </div>
</div>

<?php require './assets/includes/inc.footer.php'; ?>