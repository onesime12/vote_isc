<?php

namespace src\Controllers;

use PDO;
use src\Models\VoteModel;

class VoteController
{
    private static $pdo;

    public function __construct($pdo)
    {
        self::$pdo = $pdo;
    }

    public function getVotes(?int $id = null)
    {
        $response = [];
        try {
            $sql = "SELECT * FROM vote";
            $query = self::$pdo->prepare($sql);
            $query->execute();

            $votes = [];
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $votes[] = new VoteModel($row);
            }

            // dump($votes);

            // dump($id);

            if ($id !== null) {
                $candidatVote = [];
                foreach ($votes as $value) {
                    if($value->getIdCandidat() == $id){
                        $candidatVote[] = $value;
                    }
                }
                return $candidatVote;
            } else {
                return $votes;
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function createVote($candidatId, $electeurId)
    {
        $response = [];
        try {
            $sql = "INSERT INTO vote(electeur, candidat, created_at) VALUES(:electeur, :candidat, :created_at)";
            $query = self::$pdo->prepare($sql);
            if ($_POST["electeurId"] == $_POST["codeId"]) {
                $exec = $query->execute([
                    ":electeur" => $electeurId,
                    ":candidat" => $candidatId,
                    ":created_at" => date('Y-m-dTH:i:s')
                ]);
                if ($exec) {
                    $sql1 = "UPDATE electeur SET has_voted = TRUE WHERE idElecteur = :id";
                    $query1 = self::$pdo->prepare($sql1);
                    $query1->bindParam(":id", $electeurId, PDO::PARAM_INT);
                    $query1->execute();
                    $response["type"] = "success";
                    $response["message"] = "Vote enregistré avec succès !";
                } else {
                    $response["type"] = "danger";
                    $response["message"] = "Erreur lors de l'enregistrement du vote.";
                }
            } else {
                $response["type"] = "danger";
                $response["message"] = "Code de vote incorrect... Veuillez saisir le code valide ! ";
            }
            require "../src/Views/election/new.php";
        } catch (\Exception $e) {
            $response["type"] = "danger";
            $response["message"] = $e->getMessage();
        }
        return $response;
    }
}
