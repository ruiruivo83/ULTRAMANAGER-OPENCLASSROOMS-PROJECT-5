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


    public function getInvitationsFromMe(): array
    {
        $currentUser = $_SESSION['user']->getEmail();
        $req = $this->bdd->prepare("SELECT * FROM invitations WHERE invitation_from = ?");
        $req->execute(array($currentUser));
        // DEBUG
        // $req->debugDumpParams();
        // die;
        return $req->fetchall(PDO::FETCH_CLASS, Invitation::class);
    }

    // CREATE NEW INVITATION
    public function createInvitation()
    {
        $currentUser = $_SESSION['user']->getEmail();
        $req = $this->bdd->prepare("INSERT INTO invitations(invitation_from, invitation_to, invitation_date, invitation_for_group_id ) values (?, ?, NOW(), ?) ");
        $req->execute(array($currentUser, $_GET['memberemail'], $_GET['groupid']));
        // DEBUG
        // $req->debugDumpParams();
        // die;
    }

    public function deleteInvitation()
    {
        $req = $this->bdd->prepare("DELETE FROM invitations where id = ?");
        $req->execute(array($_GET['invitationid']));
    }

    public function acceptInvitation(int $userId)
    {
        // Add User to the group in the database
        $req = $this->bdd->prepare("INSERT INTO group_members(group_id, user_id) values (?, ?) ");
        $req->execute(array($_GET['groupid'], $userId));
        // DEBUG
        // $req->debugDumpParams();
        // die;
        // Delete invitation
        $req = $this->bdd->prepare("DELETE FROM invitations where id = ?");
        $req->execute(array($_GET['invitationid']));
    }

    public function getInvitationsForMe(): array
    {
        $currentUser = $_SESSION['user']->getEmail();
        $req = $this->bdd->prepare("SELECT * FROM invitations WHERE invitation_to = ?");
        $req->execute(array($currentUser));
        // DEBUG
        // $req->debugDumpParams();
        // die;
        return $req->fetchall(PDO::FETCH_CLASS, Invitation::class);
    }


    public function getUserCount(int $groupId, string $userEmail): int
    {
        $req = $this->bdd->prepare("SELECT * FROM invitations WHERE invitation_for_group_id = ? AND invitation_to = ?");
        $req->execute(array($groupId, $userEmail));
        // DEBUG
        // $req->debugDumpParams();
        // die;
        return $req->rowCount();
    }

}