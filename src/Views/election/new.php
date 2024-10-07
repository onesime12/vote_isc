<div class="container text-center">
    <div class="title mb-3">
        <h1 class="pageTitle fw-bold">Nouvelle Election</h1>
    </div>

    <?php //dump($_POST) 
    ?>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") : ?>
        <?php if (!empty($response)) : ?>
            <div class="my-4">
                <p class="alert alert-<?= $response["type"] ?> ; fw-bold fs-3"><?= $response["message"] ?></p>
                <a type="button" class="btn btn-outline-<?= $response["type"] ?> btn-lg" href="./new-election-<?= $id ?>">Okay</a>
            </div>
        <?php endif ?>
    <?php else : ?>

        <div class="my-4 alert alert-info fw-bold fs-4 d-flex justify-content-around align-items-center">
            <p class=""><?= "Remplissez ce formulaire pour Ajouter une nouvelle élection" ?></p> <a href="./show-company-<?= $id ?>" class="btn btn-outline-success text-danger float-right">Retour</a>
        </div>

        <form action="./create-election-<?= $id ?>" class="rounded-3 p-5 d-flex justify-content-evenly align-items-center" method="POST">

            <div class="bg-info bg-opacity-10 rounded-3 w-50">
                <div class="form-group bg-secondary bg-opacity-25 mb-3 border border-1 border-secondary border-opacity-10 rounded-3">
                    <picture class="" style="width: 250px; height:250px">
                        <source srcset="..." type="image">
                        <img src="<?= $avatar ?>" alt="logo ..." width="100%" class="img-thumbnail" style="height: 200px;">
                    </picture>
                </div>
                <h1 class="fw-bold">Watellis company</h1>
                <p>située en <strong>Butembo</strong> rue... </p>
                <p>adresse mail: <strong class="text-primary">watellis@gmail.com</strong></p>
                <p> contact téléphonique : <strong>+243 977 865 237</strong></p>
            </div>

            <fieldset class="w-50 row mb-3 mr-2 d-flex flex-column align-items-center justify-content-center">
                <div class="form-group mb-3">
                    <input type="datetime-local" name="debutElection" class="form-control"
                        required>
                </div>
                <div class="form-group mb-3">
                    <input type="datetime-local" name="finElection" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <input type="text" name="typeElection" class="form-control" placeholder="election...">
                </div>
                <button type="submit" class="btn btn-primary fw-bold w-75">Enregistrer</button>
            </fieldset>

        </form>
    <?php endif ?>

</div>