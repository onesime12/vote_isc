<?php
    namespace src\Models;

    class ElecteurModel
    {

        private $idElecteur;
        private $nom;
        private $postnom;
        private $prenom;
        private $genre;
        private $image;
        private $phone;
        private $election;
        private $has_voted;
        private $created_at;


        public function __construct(array $electeur)
        {
            $this->idElecteur = $electeur["idElecteur"];
            $this->nom = $electeur["nom"];
            $this->postnom = $electeur["postnom"];
            $this->genre = $electeur["genre"];
            $this->image = $electeur["image"];
            $this->phone = $electeur["phone"];
            $this->election = $electeur["election"];
            $this->has_voted = $electeur["has_voted"];
            $this->created_at = $electeur["created_at"];
        }

        public function getElecteurId()
        {
            return $this->idElecteur;
        }
        public function getnom()
        {
            return $this->nom;
        }
        public function getPostnom()
        {
            return $this->postnom;
        }
        public function getPrenom()
        {
            return $this->prenom;
        }
        public function getGenre()
        {
            return $this->genre;
        }
        public function getImage()
        {
            return $this->image;
        }
        public function getPhone()
        {
            return $this->phone;
        }
        public function getElection()
        {
            return $this->election;
        }
        public function getHas_voted()
        {
            return $this->has_voted;
        }
        public function getCreated_at()
        {
            return $this->created_at;
        }
    }
    
?>