<?php 

namespace src\Models;

class CompanyModel
{
    private $id;
    private $nom;
    private $siege;
    private $email;
    private $logo;
    private $password;
    private $created_at;

    public function __construct(array $company)
    {
        $this -> id = $company['idCompany'];
        $this -> nom = $company['nom'];
        $this -> siege = $company['siege'];
        $this -> email = $company['email'];
        $this -> logo = $company['logo'];
        $this -> password = $company['password'];
        $this -> created_at = $company['created_at'];
    }

    public function getId() {
        return $this -> id;
    }
    public function getNom() {
        return $this -> nom;
    }
    public function getSiege() {
        return $this -> siege;
    }
    public function getEmail() {
        return $this -> email;
    }
    public function getLogo() {
        return $this -> logo;
    }
    public function getPassword() {
        return $this -> password;
    }
    public function getCreated_at() {
        return $this -> created_at;
    }
}
