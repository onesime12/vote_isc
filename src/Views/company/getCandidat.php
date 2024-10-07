<?php

use src\Controllers\CandidatController;
use src\Controllers\ElecteurController;
use src\Controllers\VoteController;

require dirname(__DIR__) . "../../../public/config/dbConnect.php";

$candidatController = new CandidatController($pdo);
$voteController = new VoteController($pdo);
$electeurController = new ElecteurController($pdo);

if (isset($_POST['electionId'])) {
    $electionId = intval($_POST['electionId']);
    $candidats = $candidatController->getCandidat(null, $electionId);
    $electeurs = $electeurController->getElecteur(null, $electionId);
}

?>


<?php if (empty($candidats)) : ?>
    <div class="d-flex justify-content-center align-items-center my-2 p-1 bg-danger bg-opacity-10 rounded-3" style="width:99%; height:250px">
        <h1 class="fs-5 text-center fw-bold w-50">Cette élection n'a pas encore eu de candidats</h1>
    </div>
    <?php else :
    foreach ($candidats as $candidat) : ?>
        <ul class="list-unstyled" style="width:99%">
            <li class="d-flex justify-content-between my-2 p-1 bg-secondary bg-opacity-10 rounded-3" id="canidat-<?= $candidat->getId() ?>">
                <div class=" my-0 py-0">
                    <div class="d-flex">
                        <img src="<?= $candidat->getImage() ?>" width="50" height="50" alt="img..." sizes="" srcset="" class="rounded-circle bg-dark text-white">
                        <div class="px-2">
                            <p class="my-0"><strong> <?= $candidat->getNom() . " " . $candidat->getPostnom() ?></strong></p>
                            <p class="my-0"><strong class=""><?= $candidat->getPrenom() ?></strong></p>
                        </div>
                    </div>
                    <p class="my-0 " style="font-size: smaller;"><strong class="">Slogat : </strong><?= $candidat->getSlogat() ?></p>
                    <p class="my-0 " style="font-size: smaller;">contactez-nous au <span class="text-danger"><?= $candidat->getPhone() ?></span></p>
                    <p class="my-0 " style="font-size: smaller;"> Nombre de votes jusque là miantenant <span class="text-info fs-6 fw-bold"> <?= $candidat->getVote($voteController->getVotes($candidat->getId())) ?> voix ... </span></p>
                </div>
                <div class="text-dark d-flex flex-column justify-content-between">
                    <p class="fs-2 fw-bolder bg-info bg-opacity-10 text-dark rounded-3 px-1"><span class="fw-lighter fs-4">N°_</span><?= $candidat->getNumero() ?> </p>
                    <button class="btn btn-small p-0 fw-bold text-success" data-bs-toggle="modal" data-bs-target="#voteModal" onclick="selectCandidat(<?= $candidat->getId() ?>)">... votez</button>
                </div>
            </li>
        </ul>
<?php
    endforeach;
endif; ?>
<div class="modal fade" id="voteModal" tabindex="-1" aria-labelledby="voteModalLabel" aria-hidden="true">
    <div class="modal-dialog " style="width: 900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Connexion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-unstyled" style="width: 99%;">
                    <?php if (!empty($electeurs)): foreach ($electeurs as $electeur) : ?>
                            <li class="d-flex justify-content-between my-2 p-1 bg-dark text-white rounded-3" id="electeur-<?= $electeur->getElecteurId() ?>">
                                <div class="my-0 py-0">
                                    <img src="<?= $electeur->getImage() ?>" width="50" height="50" alt="img..." class="rounded-3 bg-white">
                                    <p class="my-0" style="font-size: smaller "><strong><?= $electeur->getNom() . " " . $electeur->getPostnom() ?></strong></p>
                                    <p class="my-0" style="font-size: smaller "><strong><?= $electeur->getPrenom() ?></strong></p>
                                    <p class="my-0" style="font-size: smaller ">Phone number : <span class="text-danger"><?= $electeur->getPhone() ?></span></p>
                                </div>
                                <div class="text-white d-flex flex-column justify-content-between align-items-end" style="width: 200px;">
                                    <?php if ($electeur->getHas_voted() == false) : ?>
                                        <span class="badge text-bg-warning fs-6"> Pas encore <br>voté</span>
                                        <button class="btn btn-small p-0 text-primary mt-3" id="btn-<?= $electeur->getElecteurId() ?>" onclick="showForm(<?= $electeur->getElecteurId() ?>)">C'est moi...</button>
                                    <?php else : ?>
                                        <span class="badge text-bg-success fs-6"> J'ai déjà .. <br>voté</span>
                                    <?php endif ?>
                                    
                                    <form method="POST" id="form-<?= $electeur->getElecteurId() ?>" style="display: none" class="mt-2 w-75 ">
                                        <div class="input-group w-100">
                                            <input type="hidden" name="candidatId" id="candidatId-<?= $electeur->getElecteurId() ?>" value="">
                                            <input type="hidden" name="electeurId" value="<?= $electeur->getElecteurId() ?>">
                                            <input type="text" class="form-control" name="codeId" placeholder="Id...">
                                            <button type="submit" class="btn btn-outline-primary">Votez</button>
                                        </div>
                                    </form>
                                </div>
                            </li>
                        <?php endforeach;
                    else : ?>
                        <div class="alert alert-danger text-center">
                            <p>Il n'y a pas encore eu des électeurs pour cette élection</p>
                        </div>
                    <?php endif ?>
                </ul>
            </div>
            <div class="modal-footer">
                <button class="btn btn-small w-25 p-0 fw-bold btn-outline-danger mt-3" data-bs-toggle="modal" data-bs-target="#voteModal">Exit</button>
            </div>
        </div>
    </div>
</div>