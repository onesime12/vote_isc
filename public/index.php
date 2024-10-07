<?php

use src\Controllers\CompanyController;
use src\Controllers\Auth;
use src\Controllers\CandidatController;
use src\Controllers\ElecteurController;
use src\Controllers\ElectionController;
use src\Controllers\VoteController;

require_once __DIR__."/../vendor/autoload.php";
$router = new AltoRouter();


$router->map("GET", "/", function(){
    require "./config/dbConnect.php";
    $companyController = new CompanyController($pdo);
    $companyController->getCompany();
}, "home page");

$router->map("POST", "/login", function(){
    require "./config/dbConnect.php";
    $companyController = new Auth($pdo);
    $companyController->login(); // Traite la connexion via AJAX
}, "login");

$router->map("GET", "/logout", function() {
    session_start();
    session_destroy(); // Détruit toutes les variables de session
    header("Location: /"); // Redirige vers la page d'accueil ou de connexion
    exit;
}, "logout");

$router->map("POST", "/new-company", function(){
    require "./config/dbConnect.php";
    $companyController = new CompanyController($pdo);
    $companyController->createCompany();
}, "create company");

$router->map("GET", "/new-company", function(){
    $avatar = "./images/avatar.png";
    require "../src/Views/company/new.php";
}, "new Campany");

$router->map("GET", "/[show-company:slug]-[i:id]", function($slug, $id){
    require "./config/dbConnect.php";
    $companyController = new CompanyController($pdo);
    $companyController->getCompany($slug, $id);
} , "Detail company");

$router->map("GET", "/[new-election:slug]-[i:id]", function($slug, $id){
    require "../src/Views/election/new.php";
}, "Affichage election");

$router->map("POST", "/[create-election:slug]-[i:id]", function($slug, $id){
    require "./config/dbConnect.php";
    $electionController = new ElectionController($pdo);
    $electionController->createElection($slug, $id);
}, "creation election");

$router->map("GET", "/[new-candidat:slug]-[i:id]", function($slug, $id){
    $avatar = "./images/avatar.png";
    require "../src/Views/candidat/new.php";
}, "Nouveau candidat");

$router->map("POST", "/[create-candidat:slug]-[i:id]", function($slug, $id){
    require "./config/dbConnect.php";
    $candidatController = new CandidatController($pdo);
    $candidatController->createCandidat($slug, $id);
}, "creation candidat");

$router->map("POST", "/getCandidats", function(){
    $logo = "./images/image.png";
    require "../src/Views/company/getCandidat.php";
}, "voire le candidats");

$router->map("GET", "/new-electeur", function(){
    $avatar = "./images/avatar.png";
    require "../src/Views/electeur/new.php";
}, "Nouveau electeur");

$router->map("POST", "/new-electeur", function(){
    require "./config/dbConnect.php";
    $electeurController = new ElecteurController($pdo);
    $electeurController->createElecteur();
}, "creation d'electeur");

$router->map("POST", "/vote/[*:candidatId]-[i:electeurId]", function($candidatId, $electeurId){
    require "./config/dbConnect.php";
    $voteController = new VoteController($pdo);
    $voteController->createVote($candidatId, $electeurId);
}, "vote candidat");

$router->map("GET", "/result", function(){
    $logo = "./images/image.png";
    require "../src/Views/result/new.php";
}, "Resultat des elections");

$match = $router->match();

require "./includes/header.php";

// dump($match);

if ($match) {
    call_user_func_array($match["target"], $match['params']);
} else {
    require "../src/Views/errors/404.php";
}

require "./includes/footer.php";
