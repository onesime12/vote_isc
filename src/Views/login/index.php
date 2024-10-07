<div class="container mt-5 pt-5 login d-flex align-items-center">
    <?php if ($_SESSION["is_logged_in"]) :?>
    <div class="alert alert-success w-100 text-center fs-4 fw-bold">
        <?= $_SESSION['message'] ?>
    </div>
    <?php else :?>
    <div class="alert alert-danger w-100 text-center fs-4 fw-bold">
        <?= $_SESSION["message"] ?>
    </div>
    <?php endif ?>
</div>