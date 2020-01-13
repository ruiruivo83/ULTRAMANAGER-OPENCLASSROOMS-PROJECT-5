<?php
require 'model/database.php';

class Invitation
{

    // Variables en Private pour ne pas les modifier depuis l'exterieur de la class, seulement le "getter" peux les lir depuis l'exterieur.
    private $id;
    private $from;
    private $to;
    private $creation_date;
    private $join_group_name;


    // CONSTRUCT
    public function __construct($id, $from, $to, $creation_date, $join_group_name)
    {
        $this->id = $id;
        $this->from = $from;
        $this->to = $to;
        $this->creation_date = $creation_date;        
        $this->join_group_name = $join_group_name;
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
     * Get the value of from
     */ 
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Set the value of from
     *
     * @return  self
     */ 
    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Get the value of to
     */ 
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Set the value of to
     *
     * @return  self
     */ 
    public function setTo($to)
    {
        $this->to = $to;

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
     * Get the value of join_group_name
     */ 
    public function getJoin_group_name()
    {
        return $this->join_group_name;
    }

    /**
     * Set the value of join_group_name
     *
     * @return  self
     */ 
    public function setJoin_group_name($join_group_name)
    {
        $this->join_group_name = $join_group_name;

        return $this;
    }
}
