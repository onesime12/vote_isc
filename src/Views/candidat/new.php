<div class="container text-center">
    <div class="title mb-3">
        <h1 class="pageTitle fw-bold">Candidature aux éléctions</h1>
    </div>

    <?php //dump($_POST) ?>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") : ?>
        <?php if (!empty($response)) : ?>
            <div class="my-4">
                <p class="alert alert-<?= $response["type"] ?> ; fw-bold fs-3"><?= $response["message"] ?></p>
                <a type="button" class="btn btn-outline-<?= $response["type"] ?> btn-lg" href="./new-election-<?= $id ?>">Okay</a>
            </div>
        <?php endif ?>
    <?php else : ?>

        <div class="my-4 alert alert-info fw-bold fs-4 d-flex justify-content-around align-items-center">
            <p class=""><?= "Remplissez ce formulaire pour Ajouter un nouveau candidat" ?></p> <a href="./show-company-<?= $id ?>" class="btn btn-outline-success text-danger float-right">Retour</a>
        </div>

    <form action="./create-candidat-<?= $id ?>" method="POST" class="border border-secondary border-5 rounded-3 d-flex justify-content-evenly align-items-end py-1" enctype="multipart/form-data">

        <fieldset class="w-50 px-3 position-relative">
            <div class="form-group w-50 mb-3 w-100">
                <picture class="">
                    <source srcset="..." type="image">
                    <label for="image" style="cursor: pointer;" class="">
                        <img src="<?= $avatar ?>" alt="company logo ..." id="imagePreview" width="150" height="150" class="img-thumbnail" style="display: <?= $full_path_img ? 'block' : 'none' ?>"><br>
                    </label>
                </picture>
                <input class="d-none" type="file" id="image" name="image" accept="image/*" required onchange="previewImage(event)" />
            </div>
            <div class="form-group mb-3">
                <input type="text" name="nom" class="form-control" placeholder="Nom du candidat ..." required>
            </div>
            <div class="form-group mb-3">
                <input type="text" name="postnom" class="form-control" placeholder="Postnom du candidat ..." required>
            </div>
            <div class="form-group mb-3">
                <input type="text" name="prenom" class="form-control" placeholder="Prenom du candidat..." required>
            </div>
            <div class="form-group mb-3">
                <select name="genre" class="form-control" required>
                    <option disabled selected>Genre du candidat ...</option>
                    <option value="masculin">Masculin</option>
                    <option value="feminin">Feminin</option>
                    <option value="autre">Autre</option>
                </select>
            </div>
            <div class="form-group position-absolute top-0 end-0 w-25 my-2 mx-3">
                <input type="number" name="numero" class="form-control fs-4 fw-bold" placeholder="Num..." required>
            </div>
        </fieldset>

        <fieldset class="w-50 px-3">
            
            <div class="form-group mb-3">
                <input type="text" name="phone" class="form-control" placeholder="Numéro de téléphone..." required>
            </div>
            <div class="form-group mb-3">
                <textarea class="form-control" name="slogat" cols="30" rows="1" placeholder="Slogat du candidat..." required></textarea>
            </div>
            <div class="form-group mb-3 border border-white">
                <button disabled="disabled" class="btn border border-0 bg-white">Verifier le données avant de les enregistrer</button>
            </div>
            <div class="form-group mb-3 d-flex justify-content-center">
                <button type="submit" class="btn btn-primary fw-bold rounded-3 border-0">Enregistrer</button>
            </div>
            
        </fieldset>
    </form>
    <?php endif ?>
</div>