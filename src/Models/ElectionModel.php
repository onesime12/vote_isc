<?php

namespace src\Models;

use DateTime;

class ElectionModel
{
    private $id;
    private $debut;
    private $fin;
    private $type;
    private $company;
    private $created_at;

    public function __construct(array $election)
    {
        $this->id = $election["idElection"];
        $this->debut = $election["debut"];
        $this->fin = $election["fin"];
        $this->type = $election["type"];
        $this->company = $election["company"];
        $this->created_at = $election["created_at"];

        if (is_int($this->debut)) {
            $this->debut = new DateTime('@' . $this->debut);
            $this->debut = $this->debut->format('d/m/Y H:i:s');
        }

        if (is_int($this->fin)) {
            $this->fin = new DateTime('@' . $this->fin);
            $this->fin = $this->fin->format('d/m/Y H:i:s');
        }

        if (is_int($this->created_at)) {
            $this->created_at = new DateTime('@' . $this->created_at);
            $this->created_at = $this->created_at->format('d/m/Y H:i:s');
        }
    }

    public function getElectionId()
    {
        return $this->id;
    }
    public function getDebut()
    {
        return $this->debut;
    }
    public function getFin()
    {
        return $this->fin;
    }
    public function getType()
    {
        return $this->type;
    }
    public function getCompany()
    {
        return $this->company;
    }
    public function getElectionCreated_at()
    {
        return $this->created_at;
    }
}
