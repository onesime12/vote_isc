<?php

namespace src\Controllers;

use Exception;
use PDO;
use PDOException;
use src\Models\CompanyModel;

class CompanyController
{
    private static $pdo;

    public function __construct($pdo)
    {
        self::$pdo = $pdo;
    }

    public function getCompany(?string $slug = null, ?int $id = null)
    {
        try {
            $query = self::$pdo->prepare("SELECT * FROM company");
            $query->execute();
            $company = [];

            while ($row = $query->fetchAll(PDO::FETCH_ASSOC)) {
                for ($i = 0; $i < count($row); $i++) {
                    $company[] =  new CompanyModel($row[$i]);
                }
            }

            if ($id !== null) {
                $selectCompany = null;
                $slug = $slug;
                foreach ($company as $value) {
                    if ($value->getId() == $id) {
                        $selectCompany = $value;
                    }
                }
                $avatar = "../../public/images/avatar.png";
                require dirname(__DIR__) . "/Views/company/show.php";
            } else {
                require dirname(__DIR__) . "/Views/index.php";
            }
        } catch (\PDOException $e) {
            die("Error : " . $e->getMessage());
        }
    }

    public function createCompany()
    {
        $uploadDir = 'uploads/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $response = ["success" => false, "message" => ""];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                $logoFile = $_FILES["companyLogo"];
                if ($logoFile["error"] == 0) {
                    $logoFileName = basename($logoFile["name"]);
                    $uploadFileDir = $uploadDir . uniqid() . "-" . $logoFileName;

                    $is_uploadFileMove = move_uploaded_file($logoFile["tmp_name"], $uploadFileDir);

                    if ($is_uploadFileMove) {

                        $query = self::$pdo->prepare("INSERT INTO company(nom, siege, email, password, logo, created_at) VALUES(:nom, :siege, :email, :password, :logo, :created_at)");

                        $exec = $query->execute([
                            "nom" => $_POST["nom"],
                            "siege" => $_POST["siege"],
                            "email" => $_POST["email"],
                            "password" => $_POST["password"],
                            "logo" => $uploadFileDir,
                            "created_at" => date('Y-m-dTH:i:s')
                        ]);

                        if ($exec) {
                            $response["type"] = "success";
                            $response["message"] = "Enregistrement fait avec succès";
                        } 
                    }
                }
            } catch (PDOException $e) {
                $response["type"] = "danger";
                $response["message"] = $e->getMessage();
            }
            require "../src/Views/company/new.php";
        }
    }
}
