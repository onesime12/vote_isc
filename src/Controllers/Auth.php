<?php

namespace src\Controllers;

use PDO;

class Auth
{

    private static $pdo;

    public function __construct(?object $pdo = null)
    {
        self::$pdo = $pdo;
    }

    public function login()
    {
        $response = ["success" => false, "message" => ""];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                $email = $_POST['email'];
                $password = $_POST['password'];

                $query = self::$pdo->prepare("SELECT * FROM company WHERE email = :email LIMIT 1");
                $query->execute(['email' => $email]);
                $company = $query->fetch(PDO::FETCH_ASSOC);

                if ($company) {
                    if ($password == $company['password']) {
                        $response['success'] = true;
                        $response['message'] = 'connexion avec succès';

                        // Stocke l'email de l'utilisateur connecté
                        $_SESSION['company_id'] = $company['idCompany'];
                        $_SESSION['company_logo'] = $company['logo'];
                        $_SESSION['company_name'] = $company['nom'];
                        $_SESSION['company_email'] = $company['email'];
                        $_SESSION['message'] = $response['message'];
                        $_SESSION['is_logged_in'] = $response['success'];
                        require dirname(__DIR__) . "/Views/login/index.php";
                    } else {
                        $response['message'] = "Mot de passe incorrect.";
                        $_SESSION['message'] = $response['message'];
                    }
                } else {
                    $_SESSION['message'] = "Email non trouvé.";
                    
                }
                // dump($_SESSION);
            } catch (\Exception $e) {
                $response['message'] = "Erreur : " . $e->getMessage();
            }
        }
    }

    public function is_connect(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return !empty($_SESSION['is_logged_in']);
    }

    function require_connect(): void {
        if (!$this-> is_connect()) {
            header('Location: login.php');
        }
    }

}
