<?php


class Invitations
{

    // GET SENT INVITATIONS
    public function getSentInvitationsFromDB()
    {
        $bdd = Database::getBdd();
        $currentUserEmail = $_SESSION['user']->getEmail();
        $req = $bdd->prepare("SELECT * FROM invitations WHERE invitation_from = '$currentUserEmail' ORDER BY invitation_date DESC");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        $result = $req->fetchall();
        return $result;
    }

    // GET SENT INVITATIONS
    public function getReceivedInvitationsFromDB()
    {
        $bdd = Database::getBdd();
        $currentUserEmail = $_SESSION['user']->getEmail();
        $req = $bdd->prepare("SELECT * FROM invitations WHERE invitation_to = '$currentUserEmail' ORDER BY invitation_date DESC");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        $result = $req->fetchall();
        return $result;
    }

    // GET INVITATION AUTHOR
    public function getInvitationAuthor($invitationId)
    {
        $bdd = Database::getBdd();
        $req = $bdd->prepare("SELECT invitation_from FROM invitations WHERE id = '$invitationId' ");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        $result = $req->fetchall();
        return $result;
    }

    // GET INVITATION DESTINATOR
    public function getInvitationDestinator($invitationId)
    {
        $bdd = Database::getBdd();
        $req = $bdd->prepare("SELECT invitation_to FROM invitations WHERE id = '$invitationId' ");
        $req->execute();
        $result = $req->fetchall();
        return $result;
    }

    // DELETE INVITATION
    public function deleteInvitation($invitationId)
    {
        $bdd = Database::getBdd();
        $req = $bdd->prepare("DELETE FROM invitations WHERE id = '$invitationId'");
        $req->execute();
    }

    //GET GROUP NAME
    public function getGroupName($invitationId)
    {
        $bdd = Database::getBdd();
        $req = $bdd->prepare("SELECT invitation_for_group_name FROM invitations WHERE id = '$invitationId' ");
        $req->execute();
        $result = $req->fetchall();
        return $result;
    }

    // GET GROUP ID WITH GROUP NAME
    public function getGroupID($GroupName)
    {
        $bdd = Database::getBdd();
        $req = $bdd->prepare("SELECT id FROM groups WHERE group_name = '$GroupName' ");
        $req->execute();
        $result = $req->fetchall();
        return $result;
    }

    // INSERT InsertDestinatorToGroup($GroupID)
    public function InsertDestinatorToGroup($GroupID,  $invitationDestinator)
    {     
        // Insert membert into the group
        $bdd = Database::getBdd();
        $req = $bdd->prepare("INSERT INTO group_members(group_id, member_email) values (?,?) ");        
        $req->execute(array($GroupID, $invitationDestinator));
     }
}
