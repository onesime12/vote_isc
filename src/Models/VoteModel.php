<?php
namespace src\Models;
class VoteModel 
{
    private $id;
    private $electeur;
    private $candidat;
    private $created_at;

    public function __construct(array $votes)
    {
        $this->id = $votes["idVote"];
        $this->electeur = $votes["electeur"];
        $this->candidat = $votes["candidat"];
        $this->created_at = $votes["created_at"];
    }

    public function getVoteId()
    {
        return $this->id;
    }
    public function getIdElecteur()
    {
        return $this->electeur;
    }
    public function getIdCandidat()
    {
        return $this->candidat;
    }
    public function getVoteCreated_at()
    {
        return $this->created_at;
    }
}
