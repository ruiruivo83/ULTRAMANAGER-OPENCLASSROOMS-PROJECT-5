<?php

declare(strict_types=1);

namespace App\Model\Entity;

class Invitation
{

    // Variables en Private pour ne pas les modifier depuis l'exterieur de la class, seulement le "getter" peux les lir depuis l'exterieur.
    private $id;
    private $invitationFrom;
    private $invitationTo;
    private $invitationDate;
    private $invitationForGroupId;

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
        return $this->invitationFrom;
    }

    /**
     * @param mixed $invitationFrom
     */
    public function setInvitationFrom($invitationFrom): void
    {
        $this->invitationFrom = $invitationFrom;
    }

    /**
     * @return mixed
     */
    public function getInvitationTo()
    {
        return $this->invitationTo;
    }

    /**
     * @param mixed $invitationTo
     */
    public function setInvitationTo($invitationTo): void
    {
        $this->invitationTo = $invitationTo;
    }

    /**
     * @return mixed
     */
    public function getInvitationDate()
    {
        return $this->invitationDate;
    }

    /**
     * @param mixed $invitationDate
     */
    public function setInvitationDate($invitationDate): void
    {
        $this->invitationDate = $invitationDate;
    }

    /**
     * @return mixed
     */
    public function getInvitationForGroupId()
    {
        return $this->invitationForGroupId;
    }

    /**
     * @param mixed $invitationForGroupId
     */
    public function setInvitationForGroupId($invitationForGroupId): void
    {
        $this->invitationForGroupId = $invitationForGroupId;
    }


}
