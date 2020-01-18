<?php

declare(strict_types=1);

namespace App\Model;

class Intervention
{

    // Variables en Private pour ne pas les modifier depuis l'exterieur de la class, seulement le "getter" peux les lir depuis l'exterieur.
    private $id;
    private $ticket_id;
    private $author;
    private $creation_date;
    private $description;
    private $author_country;
    private $author_company;

    // CONSTRUCT
    public function __construct($id, $ticket_id, $author, $creation_date, $description, $author_country, $author_company)
    {
        $this->id = $id;
        $this->ticket_id = $ticket_id;
        $this->author = $author;
        $this->creation_date = $creation_date;
        $this->description = $description;
        $this->author_country = $author_country;
        $this->author_company = $author_company;
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
     * Get the value of ticket_id
     */
    public function getTicket_id()
    {
        return $this->ticket_id;
    }

    /**
     * Set the value of ticket_id
     *
     * @return  self
     */
    public function setTicket_id($ticket_id)
    {
        $this->ticket_id = $ticket_id;

        return $this;
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
     * Get the value of author_country
     */
    public function getAuthor_country()
    {
        return $this->author_country;
    }

    /**
     * Set the value of author_country
     *
     * @return  self
     */
    public function setAuthor_country($author_country)
    {
        $this->author_country = $author_country;

        return $this;
    }

    /**
     * Get the value of author_company
     */
    public function getAuthor_company()
    {
        return $this->author_company;
    }

    /**
     * Set the value of author_company
     *
     * @return  self
     */
    public function setAuthor_company($author_company)
    {
        $this->author_company = $author_company;

        return $this;
    }

    public function getinterventions($status)
    {
        $bdd = Database::getBdd();
        $currentUser = $_SESSION['user']->getEmail();
        $req = $bdd->prepare("SELECT * FROM ticket_interventions WHERE intervention_author = '$currentUser' ORDER BY intervention_date DESC");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        $Result = $req->fetchall();
        return $Result;
    }
}
