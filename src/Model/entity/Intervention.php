<?php

declare(strict_types=1);

namespace App\Model\Entity;

class Intervention
{

    // Variables en Private pour ne pas les modifier depuis l'exterieur de la class, seulement le "getter" peux les lir depuis l'exterieur.
    private $id;
    private $ticket_id;
    private $intervention_author_id;
    private $intervention_date;
    private $intervention_description;
    private $intervention_author_country;
    private $intervention_author_company;



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
     * Get the value of intervention_author
     */ 
    public function getIntervention_authorId()
    {
        return $this->intervention_author_id;
    }

    /**
     * Set the value of intervention_author
     *
     * @return  self
     */ 
    public function setIntervention_authorId($intervention_author_id)
    {
        $this->intervention_author_id = $intervention_author_id;

        return $this;
    }

    /**
     * Get the value of intervention_date
     */ 
    public function getIntervention_date()
    {
        return $this->intervention_date;
    }

    /**
     * Set the value of intervention_date
     *
     * @return  self
     */ 
    public function setIntervention_date($intervention_date)
    {
        $this->intervention_date = $intervention_date;

        return $this;
    }

    /**
     * Get the value of intervention_description
     */ 
    public function getIntervention_description()
    {
        return $this->intervention_description;
    }

    /**
     * Set the value of intervention_description
     *
     * @return  self
     */ 
    public function setIntervention_description($intervention_description)
    {
        $this->intervention_description = $intervention_description;

        return $this;
    }

    /**
     * Get the value of intervention_author_country
     */ 
    public function getIntervention_author_country()
    {
        return $this->intervention_author_country;
    }

    /**
     * Set the value of intervention_author_country
     *
     * @return  self
     */ 
    public function setIntervention_author_country($intervention_author_country)
    {
        $this->intervention_author_country = $intervention_author_country;

        return $this;
    }

    /**
     * Get the value of intervention_author_company
     */ 
    public function getIntervention_author_company()
    {
        return $this->intervention_author_company;
    }

    /**
     * Set the value of intervention_author_company
     *
     * @return  self
     */ 
    public function setIntervention_author_company($intervention_author_company)
    {
        $this->intervention_author_company = $intervention_author_company;

        return $this;
    }
}
