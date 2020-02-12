<?php

declare(strict_types=1);

namespace App\Model;

use PDO;
use App\Model\Entity\Invitation;

class InvitationModel
{

    private $bdd;

    public function __construct()
    {
        $this->bdd = Database::getBdd();
    }


    public function getInvitationsFromMe()
    {
        $currentUser = $_SESSION['user']->getEmail();
        $req = $this->bdd->prepare("SELECT * FROM invitations WHERE invitation_from = ?");
        $req->execute(array($currentUser));
        // DEBUG
        // $req->debugDumpParams();
        // die;
        return $req->fetchall(PDO::FETCH_CLASS, Invitation::class);

    }

    public function getInvitationsForMe()
    {

    }

}