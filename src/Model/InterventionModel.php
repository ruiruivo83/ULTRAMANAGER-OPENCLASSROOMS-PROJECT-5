<?php

declare(strict_types=1);

namespace App\Model;

use App\Tools\SuperGlobals;
use PDO;
use App\Tools\Database;
use App\Model\Entity\Intervention;

class InterventionModel
{
    // CONSTRUCT - 

    private $bdd;
    private $superGlobals;

    public function __construct()
    {
        $this->bdd = Database::getBdd();
        $this->superGlobals = new SuperGlobals();
    }

    public function getAllInterventionsForTicketId(int $id): array
    {
        $req = $this->bdd->prepare("SELECT * FROM ticket_interventions WHERE ticket_id = ? ORDER BY intervention_date DESC");
        $req->execute(array($id));
        // DEBUG
        // $req->debugDumpParams();
        // die;
        return $req->fetchall(PDO::FETCH_CLASS, Intervention::class);
    }

    public function createNewIntervention()
    {
        $req = $this->bdd->prepare("INSERT INTO ticket_interventions(ticket_id, intervention_author_id, intervention_date, intervention_description, intervention_author_country, intervention_author_company) values (?, ?, NOW(), ?, ?, ?) ");
        $req->execute(array($this->superGlobals->_POST("ticketid"), $this->superGlobals->_SESSION("user")->getId(), $this->superGlobals->_POST("Description"), $this->superGlobals->_SESSION("user")->getCountry(), $this->superGlobals->_SESSION("user")->getCompany()));
        // DEBUG
        // $req->debugDumpParams();
        // die;
    }

    public function createClosingIntervention($ticketId, $interventionDescription)
    {
        $req = $this->bdd->prepare("INSERT INTO ticket_interventions(ticket_id, intervention_author_id, intervention_date, intervention_description, intervention_author_country, intervention_author_company) values (?, ?, NOW(), ?, ?, ?) ");
        $req->execute(array($ticketId, $this->superGlobals->_SESSION("user")->getId(), $interventionDescription, $this->superGlobals->_SESSION("user")->getCountry(), $this->superGlobals->_SESSION("user")->getCompany()));
        // DEBUG
        // $req->debugDumpParams();
        // die;
    }

    public function getInterventionForTicketId(int $id): array
    {
        $req = $this->bdd->prepare("SELECT * FROM ticket_interventions WHERE ticket_id = ? ORDER BY intervention_date DESC");
        $req->execute(array($id));
        // DEBUG
        // $req->debugDumpParams();
        // die;
        return $req->fetchall(PDO::FETCH_CLASS, Intervention::class);
    }

}
