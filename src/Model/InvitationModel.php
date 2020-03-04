<?php

declare(strict_types=1);

namespace App\Model;

use App\Tools\SuperGlobals;
use PDO;
use App\Tools\Database;
use App\Model\Entity\Invitation;

class InvitationModel
{

    private $bdd;
    private $superGlobals;

    public function __construct()
    {
        $this->bdd = Database::getBdd();
        $this->superGlobals = new SuperGlobals();
    }

    // CREATE NEW INVITATION
    public function createInvitation(): void
    {
        $currentUser = $this->superGlobals->_SESSION("user")['id'];
        $req = $this->bdd->prepare("INSERT INTO invitations(invitation_from_user_id, invitation_to_user_id, invitation_date, invitation_for_group_id ) values (?, ?, NOW(), ?) ");
        $req->execute(array($currentUser, $this->superGlobals->_GET("memberid"), $this->superGlobals->_GET("groupid")));
        // DEBUG
        // $req->debugDumpParams();
        // die;
    }

    // DELETE INVITATION
    public function deleteInvitation()
    {
        $req = $this->bdd->prepare("DELETE FROM invitations where id = ?");
        $req->execute(array($this->superGlobals->_GET("invitationid")));
    }

    public function acceptInvitation(int $userId): void
    {
        // Add User to the group in the database
        $req = $this->bdd->prepare("INSERT INTO group_members(group_id, user_id) values (?, ?) ");
        $req->execute(array($this->superGlobals->_GET("groupid"), $userId));
        // DEBUG
        // $req->debugDumpParams();
        // die;
        // Delete invitation
        $req = $this->bdd->prepare("DELETE FROM invitations where id = ?");
        $req->execute(array($this->superGlobals->_GET("invitationid")));
    }

    public function getInvitationsFromMe(): array
    {
        $currentUserId = (int)$this->superGlobals->_SESSION("user")['id'];
        $req = $this->bdd->prepare("SELECT * FROM invitations WHERE invitation_from_user_id = ?");
        $req->execute(array($currentUserId));
        // DEBUG
        // $req->debugDumpParams();
        // die;
        return $req->fetchall(PDO::FETCH_CLASS, Invitation::class);
    }

    public function getInvitationsForMe(): array
    {
        $currentUserId = (int)$this->superGlobals->_SESSION("user")['id'];
        $req = $this->bdd->prepare("SELECT * FROM invitations WHERE invitation_to_user_id = ?");
        $req->execute(array($currentUserId));
        // DEBUG
        // $req->debugDumpParams();
        // die;
        return $req->fetchall(PDO::FETCH_CLASS, Invitation::class);
    }

    public function getUserCount(int $groupId, int $userId): int
    {
        $req = $this->bdd->prepare("SELECT * FROM group_members WHERE group_id = ? AND user_id = ?");
        $req->execute(array($groupId, $userId));
        // DEBUG
        // $req->debugDumpParams();
        // die;
        return $req->rowCount();
    }

}