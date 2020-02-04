<?php

declare(strict_types=1);

namespace App\Model;

use PDO;
use App\Model\Entity\Ticket;

class TicketModel
{
    // CONSTRUCT - 

    private $bdd;

    public function __construct()
    {
        $this->bdd = Database::getBdd();
    }

    public function getAllTickets(): array
    {

        $req = $this->bdd->prepare("SELECT * FROM tickets ORDER BY creation_date DESC");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        // $Group = new Group(null, null, null, null, null, null);
        $result = $req->fetchall(PDO::FETCH_CLASS, Ticket::class);
        return $result;
    }


    public function getMyTickets(): array
    {
        $currentUser = $_SESSION['user']->getEmail();
        $req = $this->bdd->prepare("SELECT * FROM tickets WHERE author = '$currentUser' ORDER BY creation_date DESC");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        // $Group = new Group(null, null, null, null, null, null);
        $result = $req->fetchall(PDO::FETCH_CLASS, Ticket::class);
        return $result;
    }

    public function createNewTicket()
    {
        $currentUser = $_SESSION['user']->getEmail();
        $req = $this->bdd->prepare("INSERT INTO tickets( author, requester, status, creation_date, title, description, group_id ) values (?,?,?, NOW(), ?, ?, ?) ");
        $req->execute(array($currentUser, $_POST['Requester'], "open", $_POST['Title'], $_POST['Description'], $_POST['GroupId']));
        // DEBUG
        // $req->debugDumpParams();
        // die;
    }

    public function getTicketDetails(int $id)
    {
        $req = $this->bdd->prepare("SELECT * FROM tickets WHERE id = '$id' ORDER BY creation_date DESC");
        $req->execute();
        $result = $req->fetchall(PDO::FETCH_CLASS, Ticket::class);
        // DEBUG
        // $req->debugDumpParams();
        // die;
        return $result;
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
        $Result = $req->fetchall();
        return $Result;
    }
}
