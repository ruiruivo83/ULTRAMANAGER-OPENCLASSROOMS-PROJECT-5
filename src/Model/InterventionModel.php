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
        $req = $this->bdd->prepare("INSERT INTO ticket_interventions(ticket_id, intervention_author, intervention_date, intervention_description, intervention_author_country, intervention_author_company) values (?, ?, NOW(), ?, ?, ?) ");
        $req->execute(array($_POST["ticketid"], $_SESSION['user']->getEmail(), $_POST["Description"], $_SESSION['user']->getCountry(), $_SESSION['user']->getCompany()));
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
