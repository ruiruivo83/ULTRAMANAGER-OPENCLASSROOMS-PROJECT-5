<?php

declare(strict_types=1);

namespace App\Model\Entity;

class Group
{

    // Variables en Private pour ne pas les modifier depuis l'exterieur de la class, seulement le "getter" peux les lir depuis l'exterieur.
    private $id;
    private $group_admin_id;
    private $creation_date;
    private $group_name;
    private $group_description;
    private $group_status;
    private $group_status_change_date;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getGroupAdminId()
    {
        return $this->group_admin_id;
    }

    /**
     * @param mixed $group_admin_id
     */
    public function setGroupAdminId($group_admin_id): void
    {
        $this->group_admin_id = $group_admin_id;
    }

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creation_date;
    }

    /**
     * @param mixed $creation_date
     */
    public function setCreationDate($creation_date): void
    {
        $this->creation_date = $creation_date;
    }

    /**
     * @return mixed
     */
    public function getGroupName()
    {
        return $this->group_name;
    }

    /**
     * @param mixed $group_name
     */
    public function setGroupName($group_name): void
    {
        $this->group_name = $group_name;
    }

    /**
     * @return mixed
     */
    public function getGroupDescription()
    {
        return $this->group_description;
    }

    /**
     * @param mixed $group_description
     */
    public function setGroupDescription($group_description): void
    {
        $this->group_description = $group_description;
    }

    /**
     * @return mixed
     */
    public function getGroupStatus()
    {
        return $this->group_status;
    }

    /**
     * @param mixed $group_status
     */
    public function setGroupStatus($group_status): void
    {
        $this->group_status = $group_status;
    }

    /**
     * @return mixed
     */
    public function getGroupStatusChangeDate()
    {
        return $this->group_status_change_date;
    }

    /**
     * @param mixed $group_status_change_date
     */
    public function setGroupStatusChangeDate($group_status_change_date): void
    {
        $this->group_status_change_date = $group_status_change_date;
    }



}
