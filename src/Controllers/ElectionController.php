<?php

namespace src\Controllers;

use PDO;
use src\Models\ElectionModel;

class ElectionController extends CandidatController
{
    private static $pdo;
    public function __construct($pdo)
    {
        self::$pdo = $pdo;
    }

    public function getElection(?string $slug = null, ?int $id = null) : Array
    {
        $query = self::$pdo->prepare("SELECT * FROM election");
        $query->execute();
        $elections = [];

        while ($row = $query->fetchAll(PDO::FETCH_ASSOC)) {
            for ($i = 0; $i < count($row); $i++) {
                $elections[] =  new ElectionModel($row[$i]);
            }
        }

        // dump($elections);

        $companyElections = [];
        if ($id !== null) {
            foreach ($elections as $value) {
                if ($value->getCompany() == $id) {
                    $companyElections[] = $value;
                }
            }
            return $companyElections;
        } else {
            return $elections;
        }
    }

    public function createElection(?string $slug = null, ?int $id = null)
    {
        $response = [];
        try {
            $sql = "INSERT INTO election (type, debut, fin, company, created_at) VALUES (:type, :debut, :fin, :company, :created_at)";
            $query = self::$pdo->prepare($sql);
           $exec = $query->execute([
                ":type" => $_POST["typeElection"] !== "" ? $_POST["typeElection"] : null,
                ":debut" => $_POST["debutElection"] !== "" ? $_POST["debutElection"] : null,
                ":fin" => $_POST["finElection"] !== "" ? $_POST["finElection"] : null,
                ":company" => $id,
                ":created_at" => date('Y-m-dTH:i:s')
            ]);
            if ($exec) {
                $response["type"] = "success";
                $response["message"] = "Enregistrement fait avec succès";
            }
        } catch (\PDOException $e) {
            $response["type"] = "danger";
            $response["message"] = "Error => " . $e->getMessage();
        }
        require "../src/Views/election/new.php";
    }
}
