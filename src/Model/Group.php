<?php

declare(strict_types=1);

namespace App\Model;

class Group
{

    // Variables en Private pour ne pas les modifier depuis l'exterieur de la class, seulement le "getter" peux les lir depuis l'exterieur.
    private $id;
    private $group_admin;
    private $creation_date;
    private $group_name;
    private $group_description;
    private $group_status;


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
     * Get the value of group_description
     */
    public function getGroup_description()
    {
        return $this->group_description;
    }

    /**
     * Set the value of group_description
     *
     * @return  self
     */
    public function setGroup_description($group_description)
    {
        $this->group_description = $group_description;

        return $this;
    }

    /**
     * Get the value of group_status
     */
    public function getGroup_status()
    {
        return $this->group_status;
    }

    /**
     * Set the value of group_status
     *
     * @return  self
     */
    public function setGroup_status($group_status)
    {
        $this->group_status = $group_status;

        return $this;
    }
}
