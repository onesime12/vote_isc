<?php

use src\Controllers\ElectionController;

require dirname(__DIR__) . "../../../public/config/dbConnect.php";
$electionController = new ElectionController($pdo);
if (!empty($_SESSION)) {
    $elections = $electionController->getElection(null, $_SESSION["company_id"]);
}
?>


<div class="container text-center pt-5 mt-3 d-flex justify-content-center align-items-center flex-column">
    <div class="title mb-3">
        <h1 class="pageTitle fw-bold">Nouvel électeur</h1>
    </div>

    <?php //dump($_SESSION) 
    ?>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") : ?>
        <?php if (!empty($response)) : ?>
            <div class="my-4">
                <p class="alert alert-<?= $response["type"] ?> ; fw-bold fs-3"><?= $response["message"] ?></p>
                <a type="button" class="btn btn-outline-<?= $response["type"] ?> btn-lg" href="./new-electer ">Okay</a>
            </div>
        <?php endif ?>
    <?php else : ?>

        <form action="" method="POST" class="border border-secondary border-5 w-50 rounded-3 d-flex justify-content-evenly align-items-center" enctype="multipart/form-data">
            <fieldset class="w-100 row mb-3 ">
                <div class="d-flex justify-content-around align-items-center pt-1">
                    <div class="form-group w-50 mb-3 w-100 rounded-3">
                        <picture class="" style="width: 250px; height:250px">
                            <source srcset="..." type="image">
                            <label for="image" style="cursor: pointer;" class="">
                                <img src="<?= $avatar ?>" alt="electeur logo ..." id="imagePreview" width="100" height="100" class="img-thumbnail" style="display: <?= $full_path_img ? 'block' : 'none' ?>"><br>
                            </label>
                        </picture>
                        <input class="d-none" type="file" id="image" name="image" accept="image/*" required onchange="previewImage(event)" />
                    </div>
                    <div class="form-group mb-3 w-100">
                        <select name="election" id="election " class="form-control w-100">
                            <option selected disabled>Type d'élection...</option>
                            <?php foreach ($elections as $election) : ?>
                                <option value="<?= $election->getCompany() ?>"><?= $election->getType() ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <input type="text" name="nom" class="form-control" placeholder="Nom de l'électeur ..." required>
                </div>
                <div class="form-group mb-3">
                    <input type="text" name="postnom" class="form-control" placeholder="Postnom de l'élécteur ..." required>
                </div>
                <div class="form-group mb-3">
                    <input type="text" name="prenom" class="form-control" placeholder="Prenom de l'élécteur..." required>
                </div>

                <div class="form-group mb-3">
                    <select name="genre" class="form-control" required>
                        <option disabled selected>Genre de l'électeur ...</option>
                        <option value="masculin">Masculin</option>
                        <option value="feminin">Feminin</option>
                        <option value="autre">Autre</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <input type="text" name="phone" class="form-control" placeholder="Numéro de téléphone..." required>
                </div>
                <button type="submit" class="btn btn-primary fw-bold rounded-3 d-block float-right border border-none">Enregistrer</button>
            </fieldset>

            <!-- <div>
            <p class="my-0">Avez-vous déjà une entreprise ? </p>
            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Ajouter une Election</a>
        </div> -->
        </form>

    <?php endif ?>

</div>