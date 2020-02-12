<?php

declare(strict_types=1);

namespace App\Model\Entity;

class Invitation
{

    // Variables en Private pour ne pas les modifier depuis l'exterieur de la class, seulement le "getter" peux les lir depuis l'exterieur.
    private $id;
    private $invitation_from;
    private $invitation_to;
    private $invitation_date;
    private $invitation_for_group_id;

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
    public function getInvitationFrom()
    {
        return $this->invitation_from;
    }

    /**
     * @param mixed $invitation_from
     */
    public function setInvitationFrom($invitation_from): void
    {
        $this->invitation_from = $invitation_from;
    }

    /**
     * @return mixed
     */
    public function getInvitationTo()
    {
        return $this->invitation_to;
    }

    /**
     * @param mixed $invitation_to
     */
    public function setInvitationTo($invitation_to): void
    {
        $this->invitation_to = $invitation_to;
    }

    /**
     * @return mixed
     */
    public function getInvitationDate()
    {
        return $this->invitation_date;
    }

    /**
     * @param mixed $invitation_date
     */
    public function setInvitationDate($invitation_date): void
    {
        $this->invitation_date = $invitation_date;
    }

    /**
     * @return mixed
     */
    public function getInvitationForGroupId()
    {
        return $this->invitation_for_group_id;
    }

    /**
     * @param mixed $invitation_for_group_id
     */
    public function setInvitationForGroupId($invitation_for_group_id): void
    {
        $this->invitation_for_group_id = $invitation_for_group_id;
    }



}
