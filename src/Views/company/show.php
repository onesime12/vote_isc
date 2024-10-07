<?php

use src\Controllers\CandidatController;
use src\Controllers\ElectionController;

require dirname(__DIR__) . "../../../public/config/dbConnect.php";

new CandidatController($pdo);
$electionController = new ElectionController($pdo);
$companyElections = $electionController->getElection($slug, $id);
// $companyCandidats = $electionController->getCandidat();


?>

<div class="container p-3 mt-5 text-center">
    <div class="row bg-secondary text-dark rounded-3 bg-opacity-10 py-4 my-3">
        <div class="col-md-2">
            <img src="<?= $selectCompany->getLogo() ?>" alt="company logo" class="rounded-4" width="100%" height="100">
        </div>
        <div class="col-md-8 d-flex flex-column text-start justify-content-center">
            <h1 class="fw-bolder"><?= $selectCompany->getNom() . " Company" ?></h1>
            <p class="my-0">Siege social: <strong><?= $selectCompany->getSiege() ?></strong></p>
            <p class="my-0">Adresse Mail: <strong class="text-primary"><?= $selectCompany->getEmail() ?></strong></p>
        </div>
        <?php if (isset($_SESSION["is_logged_in"]) && $_SESSION["is_logged_in"] === true && $_SESSION["company_id"] === $id): ?>
            <div class="col-md-2">
                <a href="./new-electeur" class="btn btn-primary">+ Electeurs</a>
            </div>
        <?php endif ?>
    </div>

    <?php //dump($_SESSION) 
    ?>
    <?php //dump($id) 
    ?>
    <?php //dump($companyCandidats) 
    ?>
    <?php //$vote->getVote() 
    ?>


    <div class="row">

        <!-- Colonne gauche : Liste des elections -->
        <div class="col-md-4 vote-list mx-auto px-0">
            <div class="d-flex justify-content-around align-items-center bg-dark py-1 text-white">
                <h6 class="my-2">Liste des élections</h6>
                <?php if (isset($_SESSION["is_logged_in"]) && $_SESSION["is_logged_in"] === true && $_SESSION["company_id"] === $id): ?>
                    <a class="p-1 rounded-3 btn btn-outline-primary" href="/new-election-<?= $id ?>">+ nouvelle</a>
                <?php endif ?>
            </div>
            <ul class="list-group p-2">
                <?php foreach ($companyElections as $value) : ?>
                    <li class="card list-group-item election-item my-2 p-1 border-0 <?= 'election-' . $value->getElectionId() ?> " data-type="<?= $value->getType() ?>">

                        <div class="card-header d-flex justify-content-between p-0 m-0 border-0 bg-white border-">
                            <p class="card-title fw-bold text-center"><?= $value->getType() ?></p>
                            <button type="button" class="btn btn-sm p-1 btn-outline-secondary" onclick="loadCandidats(<?= $value->getElectionId() ?>)">Candidats <span class="bg-info bg-opacity-10 fw-bold px-1 rounded-circle mx-1"><?= count($electionController->getCandidat(null, $value->getElectionId())) ?></span></button>
                        </div>

                        <div class="text-start py-0">
                            <p class="my-1" style="font-size: small;"><strong>Début : </strong><?= $value->getDebut() ?></p>
                            <p class="my-1" style="font-size: small;"><strong>Fin : </strong><?= $value->getFin() ?></p>
                        </div>

                        <div class="d-flex justify-content-between p-0 bg-white">
                            <a class="" href="#">Editer</a>
                        </div>

                    </li>
                <?php endforeach ?>
                <!-- Ajouter d'autres élections ici -->
            </ul>
        </div>

        <!-- Colonne droite : Détails des votes -->
        <div class="col-md-7 vote-details mx-auto card p-0 border-0">
            <div class="card-header text-center border-0 d-flex justify-content-between align-items-center">
                <h1 class="fs-5 fw-bold text-info float-center">Candidats aux élelctions <span id="electionType"></span></h1>
                <?php if (isset($_SESSION["is_logged_in"]) && $_SESSION["is_logged_in"] == true && $_SESSION["company_id"] == $id):
                ?>
                    <a id="nouveau-candidat" href="" class="btn btn-outline-info btn-sm">+ candidat</a>
                <?php endif
                ?>
            </div>
            <div class="card-body text-start p-1">
                <div id="candidatsList">
                    <p class="fs-4 fw-bold text-center">faites un clic sur une élection à gauche, pour afficher ses candidats ici !</p>
                </div>
            </div>
        </div>
    </div>
</div>