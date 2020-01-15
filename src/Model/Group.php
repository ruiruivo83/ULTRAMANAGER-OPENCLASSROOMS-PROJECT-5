<?php

namespace App\Model;

class Group
{

    // Variables en Private pour ne pas les modifier depuis l'exterieur de la class, seulement le "getter" peux les lir depuis l'exterieur.
    private $id;
    private $group_admin;
    private $creation_date;
    private $title;
    private $description;
    private $status;

    // CONSTRUCT
    public function __construct($id, $group_admin, $creation_date, $title, $description, $status)
    {
        $this->id = $id;
        $this->group_admin = $group_admin;
        $this->creation_date = $creation_date;
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
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
     * Get the value of group_admin
     */
    public function getGroup_admin()
    {
        return $this->group_admin;
    }

    /**
     * Set the value of group_admin
     *
     * @return  self
     */
    public function setGroup_admin($group_admin)
    {
        $this->group_admin = $group_admin;

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

    public function createNewGroup()
    {
        $bdd = Database::getBdd();
        $req = $bdd->prepare("INSERT INTO groups(group_admin, creation_date, title, description, status) values (?, NOW(), ?, ?, ?) ");
        $req->execute(array($this->group_admin, $this->title, $this->description, $this->status));
        // DEBUG
        // $req->debugDumpParams();
        // die;
    }

    public function getGroups($status)
    {
        $bdd = Database::getBdd();
        $currentUser = $_SESSION['user']->getEmail();
        $req = $bdd->prepare("SELECT * FROM groups WHERE group_admin = '$currentUser' AND status = '$status' ORDER BY creation_date DESC");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        $Result = $req->fetchall();
        return $Result;
    }
}
