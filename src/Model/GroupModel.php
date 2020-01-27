<?php

declare(strict_types=1);

namespace App\Model;

use PDO;
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
        $result = $req->fetchall(PDO::FETCH_CLASS, Group::class);
        return $result;
    }

    public function getMyGroups(): array
    {      
        $currentUser = $_SESSION['user']->geteMail();
        $req = $this->bdd->prepare("SELECT * FROM groups WHERE group_admin = '$currentUser' ORDER BY creation_date DESC");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;      
        $result = $req->fetchall(PDO::FETCH_CLASS, Group::class);
        return $result;
    }

    public function getGroupDetails(int $id)
    {      
        $req = $this->bdd->prepare("SELECT * FROM groups WHERE id = '$id' ORDER BY creation_date DESC");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;        
        $result = $req->fetchall(PDO::FETCH_CLASS, Group::class);
        return $result;        
    }

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
}
