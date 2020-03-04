<?php

declare(strict_types=1);

namespace App\Model;

use App\Tools\SuperGlobals;
use PDO;
use App\Tools\Database;
use App\Model\Entity\Intervention;

class InterventionModel
{

    private $bdd;
    private $superGlobals;

    public function __construct()
    {
        $this->bdd = Database::getBdd();
        $this->superGlobals = new SuperGlobals();
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

    public function getInterventionsForTicketIdAndAuthorDetails(int $ticketId): array
    {
        $req = $this->bdd->prepare("SELECT * FROM ticket_interventions tktinter INNER JOIN users usr on usr.id = tktinter.intervention_author_id WHERE tktinter.ticket_id = '$ticketId' ORDER BY intervention_date DESC");
        $req->execute(array($ticketId));
        // DEBUG
        // $req->debugDumpParams();
        // die;
        return $req->fetchall(PDO::FETCH_CLASS, Intervention::class);
    }

    public function createNewIntervention(): void
    {
        $req = $this->bdd->prepare("INSERT INTO ticket_interventions(ticket_id, intervention_author_id, intervention_date, intervention_description, intervention_author_country, intervention_author_company) values (?, ?, NOW(), ?, ?, ?) ");
        $req->execute(array($this->superGlobals->_POST("ticketid"), $this->superGlobals->_SESSION("user")['id'], $this->superGlobals->_POST("Description"), $this->superGlobals->_SESSION("user")['country'], $this->superGlobals->_SESSION("user")['company']));
        // DEBUG
        // $req->debugDumpParams();
        // die;
    }

    public function createClosingIntervention($ticketId, $interventionDescription): void
    {
        $req = $this->bdd->prepare("INSERT INTO ticket_interventions(ticket_id, intervention_author_id, intervention_date, intervention_description, intervention_author_country, intervention_author_company) values (?, ?, NOW(), ?, ?, ?) ");
        $req->execute(array($ticketId, $this->superGlobals->_SESSION("user")['id'], $interventionDescription, $this->superGlobals->_SESSION("user")['country'], $this->superGlobals->_SESSION("user")['company']));
        // DEBUG
        // $req->debugDumpParams();
        // die;
    }

    // GET ALL OPEN INTERVENTIONS THIS MONTH
    public function getMyInterventionsForYearAndMonth($CreationYear, $CreationMonth)
    {
        $currentUserId = $this->superGlobals->_SESSION("user")['id'];
        $req = $this->bdd->prepare("SELECT intervention_date FROM ticket_interventions WHERE YEAR(intervention_date) = '$CreationYear' AND MONTH(intervention_date) = '$CreationMonth' AND intervention_author_id = '$currentUserId' ORDER BY intervention_date DESC");
        $req->execute();
        // $req->debugDumpParams();
        // die;
        return $req->fetchall();
    }

    // GET ALL OPEN INTERVENTIONS THIS MONTH
    public function getMyInterventions(): array
    {
        $currentUserId = $this->superGlobals->_SESSION("user")['id'];
        $req = $this->bdd->prepare("SELECT * FROM ticket_interventions WHERE intervention_author_id = '$currentUserId' ORDER BY intervention_date DESC");
        $req->execute();
        // $req->debugDumpParams();
        // die;
        return $req->fetchall();
    }


}
