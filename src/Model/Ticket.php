<?php

declare(strict_types=1);

namespace App\Model;

class Ticket
{

    // Variables en Private pour ne pas les modifier depuis l'exterieur de la class, seulement le "getter" peux les lir depuis l'exterieur.
    private $author;
    private $closed_date;
    private $creation_date;
    private $description;
    private $group_id;
    private $id;
    private $requester;
    private $status;
    private $title;

    // CONSTRUCT
    public function __construct($id, $author, $requester, $status, $creation_date, $title, $description, $group_id, $closed_date)
    {
        $this->author = $author;
        $this->closed_date = $closed_date;
        $this->creation_date = $creation_date;
        $this->description = $description;
        $this->group_id = $group_id;
        $this->id = $id;
        $this->requester = $requester;
        $this->status = $status;
        $this->title = $title;
    }

    /**
     * Get the value of author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set the value of author
     *
     * @return  self
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get the value of closed_date
     */
    public function getClosed_date()
    {
        return $this->closed_date;
    }

    /**
     * Set the value of closed_date
     *
     * @return  self
     */
    public function setClosed_date($closed_date)
    {
        $this->closed_date = $closed_date;

        return $this;
    }

    /**
     * Get the value of creation_date
     */
    public function getCreation_date()
    {
        return $this->creation_date;
    }

    /**
     * Set the value of creation_date
     *
     * @return  self
     */
    public function setCreation_date($creation_date)
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of group_id
     */
    public function getGroup_id()
    {
        return $this->group_id;
    }

    /**
     * Set the value of group_id
     *
     * @return  self
     */
    public function setGroup_id($group_id)
    {
        $this->group_id = $group_id;

        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of requester
     */
    public function getRequester()
    {
        return $this->requester;
    }

    /**
     * Set the value of requester
     *
     * @return  self
     */
    public function setRequester($requester)
    {
        $this->requester = $requester;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
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

    public function getMyTickets(): array
    {
        $bdd = Database::getBdd();
        $currentUser = $_SESSION['user']->getEmail();
        $req = $bdd->prepare("SELECT * FROM tickets WHERE author = '$currentUser' ORDER BY creation_date DESC");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        $result = $req->fetchall();
        return $result;
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
