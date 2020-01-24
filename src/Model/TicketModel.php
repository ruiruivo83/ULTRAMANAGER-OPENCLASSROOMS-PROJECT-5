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

    
    public function getTickets()
    {
        $bdd = Database::getBdd();
        $req = $bdd->prepare("SELECT * FROM tickets ORDER BY creation_date DESC");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        $Result = $req->fetchall();
        return $Result;
    }

    

    public function createNewTicket()
    {
        $bdd = Database::getBdd();
        $req = $bdd->prepare("INSERT INTO tickets( author, requester, status, creation_date, title, description, group_id ) values (?,?,?, NOW(), ?, ?, ?) ");
        $req->execute(array($this->author, $this->requester, $this->status, $this->title, $this->description, $this->group_id));
        // DEBUG
        // $req->debugDumpParams();
        // die;
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

    // IMPORT TO SESSION VARIABLE
    public function getTicketDetails($id)
    {
        $bdd = Database::getBdd();
        $req = $bdd->prepare("SELECT * FROM tickets WHERE id = '$id' ORDER BY creation_date DESC");
        $req->execute();       
        $numresult = $req->rowCount();        
        if ($numresult > 0) {       
            $result = $req->fetch();
            return new Ticket(
                (int) $result['id'],
                $result['author'],
                $result['requester'],
                $result['status'],
                $result['creation_date'],
                $result['title'],
                $result['description'],
                $result['group_id'],
                $result['close_date']
            );           
        } else {
            return null;
        }
        // DEBUG
        // $req->debugDumpParams();
        // die;
    }

}
