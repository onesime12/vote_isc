<?php if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($response)) : ?>
    <div class="my-4">
        <p class="alert alert-<?= $response["type"] ?> ; fw-bold fs-3"><?= $response["message"] ?></p>
        <a type="button" class="btn btn-outline-<?= $response["type"] ?> btn-lg" href="./">Okay</a>
    </div>
    <div>
        <?php dump($_POST)?>
    </div>
<?php endif ?>