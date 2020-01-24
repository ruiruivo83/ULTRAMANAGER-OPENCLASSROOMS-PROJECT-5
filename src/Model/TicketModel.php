<?php

declare(strict_types=1);

namespace App\Model;

use PDO;

class TicketModel
{
    // CONSTRUCT - 
    public function __construct($id, $author, $requester, $status, $creation_date, $title, $description, $group_id, $closed_date)
    {
        $this->id = $id;
        $this->author = $author;
        $this->requester = $requester;
        $this->status = $status;
        $this->creation_date = $creation_date;
        $this->description = $description;
        $this->group_id = $group_id;
        $this->closed_date = $closed_date;
    }

    public function getAllTickets(): array
    {
        $bdd = Database::getBdd();
        $req = $bdd->prepare("SELECT * FROM tickets ORDER BY creation_date DESC");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        // $Group = new Group(null, null, null, null, null, null);
        $result = $req->fetchall(PDO::FETCH_CLASS, 'App\Model' . '\\Ticket');
        return $result;
    }

    public function getMyTickets(): array
    {
        $bdd = Database::getBdd();
        $currentUser = $_SESSION['user']->getEmail();
        $req = $bdd->prepare("SELECT * FROM tickets WHERE author = '$currentUser' ORDER BY creation_date DESC");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        // $Group = new Group(null, null, null, null, null, null);
        $result = $req->fetchall(PDO::FETCH_CLASS, 'App\Model' . '\\Ticket');
        return $result;
    }
}
