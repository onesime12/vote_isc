<?php

namespace src\Controllers;

use DateTime;
use Exception;
use PDO;
use src\Models\CandidatModel;

class CandidatController
{
    private static $pdo;
    public function __construct($pdo)
    {
        self::$pdo = $pdo;
    }

    public function getCandidat(?string $slug = null, ?int $id = null)
    {
        try {
            $query = self::$pdo->prepare("SELECT * FROM candidat");
            $query->execute();
            $candidats = [];

            while ($rows = $query->fetch(PDO::FETCH_ASSOC)) {
                $candidats[] = new CandidatModel($rows);
            }

            $candidatsElection = [];
            if ($id !== null) {
                foreach ($candidats as $candidat) {
                    if ($candidat->getElection() == $id) {
                        $candidatsElection[] = $candidat;
                    }
                }
                return $candidatsElection;
            }else{
                return $candidats;
            }
            
        } catch (Exception $e) {
            echo "Error : " . $e;
        }
    }

    public function createCandidat(?string $slug = null, ?int $id = null)
    {
        $uploadDir = 'uploads/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $response = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                $imageFile = $_FILES["image"];
                if ($imageFile["error"] == 0) {
                    $imageFileName = basename($imageFile["name"]);
                    $uploadFileDir = $uploadDir . uniqid() . "-" . $imageFileName;

                    $is_uploadFileMove = move_uploaded_file($imageFile["tmp_name"], $uploadFileDir);

                    if ($is_uploadFileMove) {
                        $sql = "INSERT INTO candidat(nom, postnom, prenom, genre, numero, image, slogat, phone, election, created_at) VALUES(:nom, :postnom, :prenom, :genre, :numero, :image, :slogat, :phone, :election, :created_at)";
                        $query = self::$pdo->prepare($sql);
                        $exec = $query->execute([
                            ":nom" => $_POST["nom"],
                            ":postnom" => $_POST["postnom"],
                            ":prenom" => $_POST["prenom"],
                            ":genre" => $_POST["genre"],
                            ":numero" => $_POST["numero"],
                            ":image" => $uploadFileDir,
                            ":slogat" => $_POST["slogat"],
                            ":phone" => $_POST["phone"],
                            ":election" => $id,
                            ":created_at" => date('Y-m-dTH:i:s'),
                        ]);

                        if ($exec) {
                            $response["type"] = "success";
                            $response["message"] = "Enregistrement fait avec succès";
                        }
                    }
                }
            } catch (\Exception $e) {
                $response["type"] = "danger";
                $response["message"] = "Error => " . $e->getMessage();
            }
            require "../src/Views/candidat/new.php";
        }
    }
}
