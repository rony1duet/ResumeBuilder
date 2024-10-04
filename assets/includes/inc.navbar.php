<nav class="navbar bg-body-tertiary shadow">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="./assets/images/logo_main.gif" alt="Logo" height="24" class="d-inline-block align-text-top me-2">
            <span class="fw-bold">Resume Builder</span>
        </a>
        <div class="d-flex gap-2">
            <a href="user_account.php" class="btn btn-sm btn-outline-dark d-flex align-items-center px-3"
                data-bs-toggle="tooltip" title="Manage your account">
                <i class="bi bi-person-circle me-2"></i>
                <span>Account</span>
            </a>
            <a href="actions/action.user_logout.php" class="btn btn-sm btn-outline-danger d-flex align-items-center px-3"
                data-bs-toggle="tooltip" title="Logout from your account">
                <i class="bi bi-box-arrow-left"></i>
            </a>
        </div>
    </div>
</nav>
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
</script>
