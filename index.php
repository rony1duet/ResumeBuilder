<?php
$title = "My Resumes | Resume Builder";
require './assets/includes/inc.header.php';
require './assets/includes/inc.navbar.php';
$fn->AuthPage();
$resumes = $db->query('SELECT * FROM resumes WHERE user_id = ' . $fn->Auth()['id'] . ' ORDER BY updated_at DESC');
$resumes = $resumes->fetch_all(true);
?>
<div class="container">
    <div class="bg-white rounded shadow p-4 mt-4" style="min-height:80vh">
        <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
            <h5 class="fw-bold fs-4">My Resumes</h5>
            <div>
                <a href="resume_create.php" class="btn btn-primary btn-sm">
                    <i class="bi bi-file-earmark-plus me-2"></i> Add New Resume
                </a>
            </div>
        </div>
        <?php if (!$resumes) { ?>
            <div class="text-center py-3 border rounded mt-3" style="background-color: rgba(236, 236, 236, 0.56);">
                <i class="bi bi-file-text fs-1"></i>
                <p class="mt-3">No Resumes Available</p>
            </div>
        <?php } else { ?>
            <div class="row g-3">
                <?php foreach ($resumes as $resume) { ?>
                    <div class="col-12 col-md-6 p-2">
                        <div class="p-2 border rounded shadow-sm h-100">
                            <h5 class=" bg-primary text-white"><?= $resume['resume_title'] ?></h5>
                            <?php
                            $lastUpdated = new DateTime();
                            $lastUpdated->setTimestamp($resume['updated_at']);
                            $formattedLastUpdated = $lastUpdated->format('d F, Y h:i A');
                            ?>

                            <p class="small text-secondary m-0" style="font-size:12px">
                                <i class="bi bi-clock-history"></i> Last Updated <?= $formattedLastUpdated ?>
                            </p>


                            </p>

                            <div class="d-flex gap-2 mt-1">
                                <a href="resume_view.php?resume=<?= $resume['slug']; ?>"
                                    class="text-decoration-none small clr-success">
                                    <i class="bi bi-file-text"></i> Open
                                </a>
                                <a href="resume_update.php?resume=<?= $resume['slug']; ?>"
                                    class="text-decoration-none small clr-warning">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <a href="actions/action.resume_clone.php?resume=<?= $resume['slug']; ?>"
                                    class="text-decoration-none small clr-info">
                                    <i class="bi bi-copy"></i> Clone
                                </a>

                                <a href="javascript:void(0);" onclick="confirmDelete('<?php echo $resume['id']; ?>')"
                                    class="text-decoration-none small clr-danger">
                                    <i class="bi bi-trash2"></i> Delete
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(resumeId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `actions/action.resume_delete.php?id=${resumeId}`;
            }
        });
    }
    <?php $fn->error(); ?>
</script>
<style>
    h5.bg-primary {
        background-color: #6c63ff !important;
        padding: 0.5rem;
        border-radius: 0.25rem;
    }

    .clr-success:hover {
        color: #8fd19e;
    }

    .clr-warning:hover {
        color: #ffe066;
    }

    .clr-info:hover {
        color: #80dfff;
    }

    .clr-danger:hover {
        color: #ff6666;
    }

    .clr-danger,
    .clr-info,
    .clr-primary,
    .clr-success,
    .clr-warning {
        transition: color 0.3s ease;
        color: #000;
    }
</style>
<?php require './assets/includes/inc.footer.php'; ?>