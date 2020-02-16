<?php

declare(strict_types=1);

namespace App\Model;

use PDO;
use App\Tools\Database;
use App\Model\Entity\Group;

class GroupModel
{
    // CONSTRUCT - 

    private $bdd;

    public function __construct()
    {
        $this->bdd = Database::getBdd();
    }

    public function getAllGroups(): array
    {
        $req = $this->bdd->prepare("SELECT * FROM groups ORDER BY creation_date DESC");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        return $req->fetchall(PDO::FETCH_CLASS, Group::class);
    }

    public function getMyGroups(): array
    {
        $currentUser = $_SESSION['user']->geteMail();
        $req = $this->bdd->prepare("SELECT * FROM groups WHERE group_admin = '$currentUser' ORDER BY creation_date DESC");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        return $req->fetchall(PDO::FETCH_CLASS, Group::class);
    }

    public function getSharedGroups(): array
    {
        $currentUser = $_SESSION['user']->getId();
        $req = $this->bdd->prepare("SELECT * FROM group_members WHERE user_id = '$currentUser'");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        return $req->fetchall();
    }

    public function getGroupDetails(int $id)
    {
        $req = $this->bdd->prepare("SELECT * FROM groups WHERE id = '$id' ORDER BY creation_date DESC");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        return $req->fetchall(PDO::FETCH_CLASS, Group::class);
    }

    public function removeMemberFromGroupfunction(int $groupId, int $userId): void
    {
        $req = $this->bdd->prepare("DELETE FROM group_members where group_id = ? AND user_id = ? ");
        // $req->execute(array($_GET['groupid'], $_GET['userid']));
        $req->execute(array($groupId, $userId));
        // DEBUG
        // $req->debugDumpParams();
        // die;
    }

    public function getGroupNameWithGroupId(int $id): array
    {
        $req = $this->bdd->prepare("SELECT group_name FROM groups WHERE id = '$id'");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        return $req->fetchall();
    }








    //
    //
    //
    //
    //
    //
    //
    //
    //
    //
    //


    public function createNewGroup()
    {
        $currentUser = $_SESSION['user']->getEmail();
        $req = $this->bdd->prepare("INSERT INTO groups(group_admin, creation_date, group_name, group_description, group_status) values (?, NOW(), ?, ?, ?) ");
        $req->execute(array($currentUser, $_POST["Title"], $_POST["Description"], "open"));
        // DEBUG
        // $req->debugDumpParams();
        // die;
    }

    public function getGroups(): array
    {
        $bdd = Database::getBdd();
        $req = $bdd->prepare("SELECT * FROM groups ORDER BY creation_date DESC");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        $result = $req->fetchall();
        return $result;
    }

    public function getGroupsWithStatus(string $status): array
    {
        $bdd = Database::getBdd();
        $req = $bdd->prepare("SELECT * FROM groups WHERE group_status = '$status' ORDER BY creation_date DESC");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        $result = $req->fetchall();
        return $result;
    }

    public function getMyGroupsWithStatus(string $status): array
    {
        $bdd = Database::getBdd();
        $currentUser = $_SESSION['user']->getEmail();
        $req = $bdd->prepare("SELECT * FROM groups WHERE group_admin = '$currentUser' AND group_status = '$status' ORDER BY creation_date DESC");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        $result = $req->fetchall();
        return $result;
    }

    public function getGroupIdWithGroupName(string $groupName): array
    {
        $bdd = Database::getBdd();
        $req = $bdd->prepare("SELECT id FROM groups WHERE group_name = '$groupName' ORDER BY creation_date DESC");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        $result = $req->fetchall();
        return $result;
    }

    /*
    public function getGroupNameWithGroupId(int $id): array
    {
        $bdd = Database::getBdd();
        $req = $bdd->prepare("SELECT group_name FROM groups WHERE id = '$id' ORDER BY creation_date DESC");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        $result = $req->fetchall();
        return $result;
    }
*/

}
