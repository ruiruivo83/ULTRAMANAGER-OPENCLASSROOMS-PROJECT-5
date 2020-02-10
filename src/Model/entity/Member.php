<?php

declare(strict_types=1);

namespace App\Model\Entity;

class Member
{

    // Variables en Private pour ne pas les modifier depuis l'exterieur de la class, seulement le "getter" peux les lir depuis l'exterieur.
    private $id;
    private $group_id;
    private $member_email;

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
     * Get the value of member_email
     */
    public function getMember_email()
    {
        return $this->member_email;
    }

    /**
     * Set the value of member_email
     *
     * @return  self
     */
    public function setMember_email($member_email)
    {
        $this->member_email = $member_email;

        return $this;
    }
}
