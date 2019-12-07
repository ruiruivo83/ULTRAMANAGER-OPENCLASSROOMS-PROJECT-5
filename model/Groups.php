<?php


class Groups
{

    private $bdd;
    private $id;
    private $Title;
    private $Description;
    private $Author;
    private $Requester;

    public function __construct($id, $Title, $Description, $Admin)
    {
        $this->setId($id);
        $this->setDescription($Description);
        $this->setTitle($Title);
        $this->setAdmin($Admin);
        // $this->setRequester($Requester);
    }

    /**
     * @return mixed
     */
    public function getAdmin()
    {
        return $this->Admin;
    }

    /**
     * @param mixed $Author
     */
    public function setAdmin($Admin)
    {
        $this->Author = $Admin;
    }

    /**
     * @return mixed
     */
    public function getRequester()
    {
        return $this->Requester;
    }

    /**
     * @param mixed $Requester
     */
    public function setRequester($Requester)
    {
        $this->Requester = $Requester;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($Title)
    {
        $this->Title = $Title;
    }

    /**
     * @param mixed $Description
     */
    public function setDescription($Description)
    {
        $this->Description = $Description;
    }

    // GET ALL TICKETS FROM DATABASE, ORDER BY DESC DATE
    public function getMyGroups($status)
    {
        $bdd = Database::getBdd();
        // PREPARE QUERY - utilise prepare pour les accents sur les lettres
        $currentUserEmail = $_SESSION['user']->getEmail();
        $req = $bdd->prepare("SELECT * FROM groups WHERE group_admin = '$currentUserEmail' AND group_status = '$status' ORDER BY creation_date DESC");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        $Result = $req->fetchall();
        return $Result;
    }

    // ADD TICKET TO DATABASE
    public function addGroup($GroupName, $GroupDescription, $Admin)
    {
        $bdd = Database::getBdd();
        $Admin = $_SESSION['user']->getEmail();
        $req = $bdd->prepare("INSERT INTO groups( group_name, group_description, creation_date, group_admin) values (?,?, NOW(), ?) ");
        $req->execute(array($GroupName, $GroupDescription, $Admin));
        // $req->debugDumpParams();
        // die;
    }

    // CLOSE TICKET ID
    public function closeGroup($groupid)
    {
        $bdd = Database::getBdd();
        $req = $bdd->prepare("UPDATE groups SET group_status='close' WHERE id=?");
        $req->execute(array($groupid));
        // DEBUG
        // $req->debugDumpParams();
        // die;
    }

    public function getMembers($GroupId)
    {
        $bdd = Database::getBdd();

        $req = $bdd->prepare("SELECT * FROM group_members WHERE group_id = '$GroupId' ORDER BY member_email DESC");
        $req->execute();
        // $req->debugDumpParams();
        // die;
        $Result = $req->fetchall();
        return $Result;
    }

    public function GetDestinatorTotalCountsInGroup($GroupID,  $invitationDestinator)
    {
        $bdd = Database::getBdd();
        $req = $bdd->prepare("SELECT * FROM group_members WHERE group_id = '$GroupID' AND member_email = '$invitationDestinator' ORDER BY member_email DESC");
        $req->execute();
        // $req->debugDumpParams();
        // die;
        $Result = $req->rowCount();
        return $Result;
    }

    public function GetGroupIdListWhereMemberIsCurrentUser()
    {
        $bdd = Database::getBdd();
        $CurrentUser = $_SESSION['user']->getEmail();
        $req = $bdd->prepare("SELECT group_id FROM group_members WHERE member_email = '$CurrentUser' ORDER BY group_id DESC");
        $req->execute();
        $Result = $req->fetchall();
        return $Result;
    }

    public function GetGroupCountWithAdmin($Admin)
    {
        $bdd = Database::getBdd();
        $CurrentUser = $_SESSION['user']->getEmail();
        $req = $bdd->prepare("SELECT * FROM groups WHERE group_admin = '$Admin' ORDER BY group_name ASC");
        $req->execute();
        $Result = $req->rowCount();
        return $Result;
    }

    public function GetAdminForGroupId($GroupId)
    {
        $bdd = Database::getBdd();
        $req = $bdd->prepare("SELECT group_admin FROM groups WHERE id = '$GroupId' ");
        $req->execute();
        $Result = $req->fetchall();

        return $Result;
    }

    public function GetGroupNameForGroupId($CurrentGroupId)
    {
        $bdd = Database::getBdd();
        $req = $bdd->prepare("SELECT * FROM groups WHERE id = '$CurrentGroupId' ");
        $req->execute();
        $Result = $req->fetchall();

        return $Result;
    }

    public function GetGroupAdminWithGroupName($GroupName)
    {
        $bdd = Database::getBdd();
        $req = $bdd->prepare("SELECT group_admin FROM groups WHERE group_name = '$GroupName' ");
        $req->execute();
        $Result = $req->fetchall();
        return $Result;
    }

    public function RemoveMemberFromGroup($GroupId, $MemberEmail)
    {
        $bdd = Database::getBdd();
        // DELETE FROM table_name WHERE condition;
        $req = $bdd->prepare("DELETE FROM group_members WHERE group_id = '$GroupId' AND member_email = '$MemberEmail'");
        $req->execute();
        // $req->debugDumpParams();
        // die;
    }

    public function GetGroupWithGroupName($GroupName)
    {
        $bdd = Database::getBdd();
        $req = $bdd->prepare("SELECT * FROM groups WHERE group_name = '$GroupName' ");
        $req->execute();
        $Result = $req->fetchall();
        return $Result;
    }

    public function GetGroupWithGroupId($GroupId)
    {
        $bdd = Database::getBdd();
        $req = $bdd->prepare("SELECT * FROM groups WHERE id = '$GroupId' ");
        $req->execute();
        $Result = $req->fetchall();
        return $Result;
    }

    public function GetGroupMembersCount($GroupId)
    {
        $bdd = Database::getBdd();
        $req = $bdd->prepare("SELECT * FROM group_members WHERE group_id = '$GroupId' ");
        $req->execute();
        $Result = $req->rowCount();
        return $Result;
    }
}
