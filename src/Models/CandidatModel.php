<?php 

namespace src\Models;

class CandidatModel extends VoteModel
{
    private $id;
    private $nom;
    private $postnom;
    private $prenom;
    private $genre;
    private $image;
    private $numero;
    private $slogat;
    private $phone;
    private $election;
    private $created_at;

    public function __construct(array $candidat)
    {
        $this->id = $candidat["idCandidat"];
        $this->nom = $candidat["nom"];
        $this->postnom = $candidat["postnom"];
        $this->prenom = $candidat["prenom"];
        $this->genre = $candidat["genre"];
        $this->image = $candidat["image"];
        $this->numero = $candidat["numero"];
        $this->slogat = $candidat["slogat"];
        $this->phone = $candidat["phone"];
        $this->election = $candidat["election"];
        $this->created_at = $candidat["created_at"];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNom()
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

    public function getNumero()
    {
        return $this->numero;
    }

    public function getSlogat()
    {
        return $this->slogat;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getElection()
    {
        return $this->election;
    }

    public function getcreated_at()
    {
        return $this->created_at;
    }
    
    public function getVote(array $vote)
    {
        return count($vote);
    }
}


?>