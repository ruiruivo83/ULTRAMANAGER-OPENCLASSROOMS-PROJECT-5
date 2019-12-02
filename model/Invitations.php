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
}
