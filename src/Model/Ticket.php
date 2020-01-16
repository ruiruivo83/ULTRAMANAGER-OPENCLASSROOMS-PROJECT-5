<?php

declare(strict_types=1);

namespace App\Model;

// require 'model/database.php';

class Ticket
{

    // Variables en Private pour ne pas les modifier depuis l'exterieur de la class, seulement le "getter" peux les lir depuis l'exterieur.
    private $author;
    private $closed_date;
    private $creation_date;
    private $description;
    private $group_name;
    private $id;
    private $requester;
    private $status;
    private $title;

    // CONSTRUCT
    public function __construct($id, $author, $requester, $status, $creation_date, $title, $description, $group_name, $closed_date)
    {
        $this->author = $author;
        $this->closed_date = $closed_date;
        $this->creation_date = $creation_date;
        $this->description = $description;
        $this->group_name = $group_name;
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
     * Get the value of group_name
     */
    public function getGroup_name()
    {
        return $this->group_name;
    }

    /**
     * Set the value of group_name
     *
     * @return  self
     */
    public function setGroup_name($group_name)
    {
        $this->group_name = $group_name;

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

    public function getTickets($status)
    {
        $bdd = Database::getBdd();
        $currentUser = $_SESSION['user']->getEmail();
        $req = $bdd->prepare("SELECT * FROM tickets WHERE author = '$currentUser' AND status = '$status' ORDER BY creation_date DESC");
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
        $req = $bdd->prepare("INSERT INTO tickets( author, requester, status, creation_date, title, description ) values (?,?,?, NOW(), ?, ?) ");
        $req->execute(array($this->author, $this->requester, $this->status, $this->title, $this->description));
        // DEBUG
        // $req->debugDumpParams();
        // die;
    }

}
