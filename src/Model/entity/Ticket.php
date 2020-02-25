<?php

declare(strict_types=1);

namespace App\Model\Entity;

class Ticket
{

    // Variables en Private pour ne pas les modifier depuis l'exterieur de la class, seulement le "getter" peux les lir depuis l'exterieur.
    private $id;
    private $author_id;
    private $requester;
    private $creation_date;
    private $title;
    private $description;            
    private $status;
    private $closed_date;
    private $group_id;

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
     * Get the value of author
     */ 
    public function getAuthorId()
    {
        return $this->author_id;
    }

    /**
     * Set the value of author
     *
     * @return  self
     */ 
    public function setAuthorId($author_id)
    {
        $this->author_id = $author_id;

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
}
