<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Entity\Group;
use App\Tools\SuperGlobals;
use PDO;
use App\Tools\Database;
use App\Model\Entity\Ticket;

class TicketModel
{

    private $bdd;
    private $superGlobals;

    public function __construct()
    {
        $this->bdd = Database::getBdd();
        $this->superGlobals = new SuperGlobals();
    }

    public function createNewTicket(): void
    {
        $currentUser = $this->superGlobals->_SESSION("user")->getId();
        $req = $this->bdd->prepare("INSERT INTO tickets( author_id, requester, status, creation_date, title, description, group_id ) values (?,?,?, NOW(), ?, ?, ?) ");
        $req->execute(array($currentUser, $this->superGlobals->_POST("Requester"), "open", $this->superGlobals->_POST("Title"), $this->superGlobals->_POST("Description"), $this->superGlobals->_GET("groupid")));
        // DEBUG
        // $req->debugDumpParams();
        // die;
    }

    public function getTicketDetails(int $id): Ticket
    {
        $req = $this->bdd->prepare("SELECT * FROM tickets WHERE id = '$id' ORDER BY creation_date DESC");
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS, Ticket::class);
        // DEBUG
        // $req->debugDumpParams();
        // die;
        return $req->fetch();
    }

    // GET OPEN TICKET WITH GROUP ID
    public function getOpenTicketsWithGroupId(int $groupId): array
    {
        $bdd = Database::getBdd();
        $req = $bdd->prepare("SELECT * FROM tickets WHERE group_id = '$groupId' AND status = 'open' ORDER BY creation_date DESC");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        return $req->fetchall();
    }

    // GET CLOSED TICKET WITH GROUP ID
    public function getClosedTicketsWithGroupId(int $groupId): array
    {
        $bdd = Database::getBdd();
        $req = $bdd->prepare("SELECT * FROM tickets WHERE group_id = '$groupId' AND status = 'closed' ORDER BY creation_date DESC");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        return $req->fetchall();
    }


    // CLOSE TICKET
    public function closeTicket(): void
    {
        $status = "closed";
        $req = $this->bdd->prepare("UPDATE tickets SET status = ?, ticket_status_change_date = NOW() where id = ?");
        $req->execute(array($status, $this->superGlobals->_GET("ticketid")));
        // DEBUG
        // $req->debugDumpParams();
        // die;
    }

}
