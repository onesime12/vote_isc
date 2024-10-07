<?php

namespace src\Controllers;

use PDO;
use src\Models\ElecteurModel;

class ElecteurController
{
    private static $pdo;
    public function __construct($pdo)
    {
        self::$pdo = $pdo;
    }

    public function getElecteur(?string $slug = null, ?int $id = null)
    {
        $response = ["type" => "", "message" => ""];
        try {
            $sql = "SELECT * FROM electeur";
            $query = self::$pdo->prepare($sql);
            $query->execute();
            $electeurs = [];

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $electeurs[] = new ElecteurModel($row);
            }

            if($id != null){
                $electeurElections = [];
                foreach ($electeurs as $electeur) {
                    if ($electeur->getElection() == $id ) {
                        $electeurElections[] = $electeur;
                    }
                }
                return $electeurElections;
            }
            return $electeurs;

        } catch (\Exception $e) {
            $response["type"] = "danger";
            $response["message"] = $e->getMessage();
        }
    }

    public function createElecteur()
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

                        $sql = "INSERT INTO electeur(nom, postnom, prenom, genre, image, phone, election, created_at) VALUES(:nom, :postnom, :prenom, :genre, :image, :phone, :election, :created_at)";
                        dump($_SESSION["company_id"]);
                        $query = self::$pdo->prepare($sql);
                        if (!empty($_SESSION["company_id"])) {
                            $exec = $query->execute([
                                ":nom" => $_POST["nom"],
                                ":postnom" => $_POST["postnom"],
                                ":prenom" => $_POST["prenom"],
                                ":genre" => $_POST["genre"],
                                ":image" => $uploadFileDir,
                                ":phone" => $_POST["phone"],
                                ":election" => $_POST["election"],
                                ":created_at" => date('Y-m-dTH:i:s')
                            ]);
                            if ($exec) {
                                $response["type"] = "success";
                                $response["message"] = "Enregistrement fait avec succès";
                            }
                        } else {
                            $response["type"] = "danger";
                            $response["message"] = "Veuillez d'abord vous connecter";
                        }
                    }
                }
            } catch (\Exception $e) {
                $response["type"] = "danger";
                $response["message"] = "Error => " . $e->getMessage();
            }
            require "../src/Views/election/new.php";
        }
    }
}
