<?php

declare(strict_types=1);

namespace App\Model;

use App\Tools\SuperGlobals;
use PDO;
use App\Tools\Database;
use App\Model\Entity\Ticket;

class TicketModel
{
    // CONSTRUCT - 

    private $bdd;
    private $superGlobals;

    public function __construct()
    {
        $this->bdd = Database::getBdd();
        $this->superGlobals = new SuperGlobals();
    }

    public function getAllTickets(): array
    {
        $req = $this->bdd->prepare("SELECT * FROM tickets ORDER BY creation_date DESC");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        // $Group = new Group(null, null, null, null, null, null);
        return $req->fetchall(PDO::FETCH_CLASS, Ticket::class);
    }

    public function getMyTickets(): array
    {
        $currentUser = $this->superGlobals->_SESSION("user")->getEmail();
        $req = $this->bdd->prepare("SELECT * FROM tickets WHERE author = '$currentUser' ORDER BY creation_date DESC");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        // $Group = new Group(null, null, null, null, null, null);
        return $req->fetchall(PDO::FETCH_CLASS, Ticket::class);
    }

    public function createNewTicket()
    {
        $currentUser = $this->superGlobals->_SESSION("user")->getEmail();
        $req = $this->bdd->prepare("INSERT INTO tickets( author, requester, status, creation_date, title, description, group_id ) values (?,?,?, NOW(), ?, ?, ?) ");
        $req->execute(array($currentUser, $this->superGlobals->_POST("Requester"), "open", $this->superGlobals->_POST("Title"), $this->superGlobals->_POST("Description"), $this->superGlobals->_GET("groupid")));
        // DEBUG
        // $req->debugDumpParams();
        // die;
    }

    public function getTicketDetails(int $id)
    {
        $req = $this->bdd->prepare("SELECT * FROM tickets WHERE id = '$id' ORDER BY creation_date DESC");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        return $req->fetchall(PDO::FETCH_CLASS, Ticket::class);
    }

    // GET TICKET WITH GROUP ID
    public function getTicketsWithGroupId($groupId)
    {
        $bdd = Database::getBdd();
        $req = $bdd->prepare("SELECT * FROM tickets WHERE group_id = '$groupId' ORDER BY creation_date DESC");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        return $req->fetchall();
    }
}
