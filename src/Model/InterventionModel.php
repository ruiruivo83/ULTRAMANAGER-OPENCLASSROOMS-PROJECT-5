<?php

declare(strict_types=1);

namespace App\Model;

use PDO;
use App\Model\Entity\Intervention;

class InterventionModel
{
    // CONSTRUCT - 

    private $bdd;

    public function __construct()
    {
        $this->bdd = Database::getBdd();
    }

    public function getAllInterventions(): array
    {
        $req = $this->bdd->prepare("SELECT * FROM ticket_interventions ORDER BY intervention_date DESC");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        $result = $req->fetchall(PDO::FETCH_CLASS, Intervention::class);
        return $result;
    }


}
