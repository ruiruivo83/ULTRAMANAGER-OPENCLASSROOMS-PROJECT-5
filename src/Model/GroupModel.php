<?php

declare(strict_types=1);

namespace App\Model;

use PDO;

class GroupModel
{
    // CONSTRUCT - 
    public function __construct($id, $group_admin, $creation_date, $group_name, $group_description, $group_status)
    {
        $this->id = $id;
        $this->group_admin = $group_admin;
        $this->creation_date = $creation_date;
        $this->group_name = $group_name;
        $this->group_description = $group_description;
        $this->group_status = $group_status;
    }

    public function getAllGroups(): array
    {
        $bdd = Database::getBdd();
        $req = $bdd->prepare("SELECT * FROM groups ORDER BY creation_date DESC");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        // $Group = new Group(null, null, null, null, null, null);
        $result = $req->fetchall(PDO::FETCH_CLASS, 'App\Model' . '\\Group');
        return $result;
    }

    public function getMyGroups(): array
    {
        $bdd = Database::getBdd();
        $currentUser = $_SESSION['user']->geteMail();
        $req = $bdd->prepare("SELECT * FROM groups WHERE group_admin = '$currentUser' ORDER BY creation_date DESC");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        // $Group = new Group(null, null, null, null, null, null);
        $result = $req->fetchall(PDO::FETCH_CLASS, 'App\Model' . '\\Group');
        return $result;
    }













    public function createNewGroup()
    {
        $bdd = Database::getBdd();
        $req = $bdd->prepare("INSERT INTO groups(group_admin, creation_date, group_name, group_description, group_status) values (?, NOW(), ?, ?, ?) ");
        $req->execute(array($this->group_admin, $this->group_name, $this->group_description, $this->group_status));
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

    public function getGroupDetails(int $id)
    {
        $bdd = Database::getBdd();        
        $req = $bdd->prepare("SELECT * FROM groups WHERE id = '$id' ORDER BY creation_date DESC");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        // $Group = new Group(null, null, null, null, null, null);
        $result = $req->fetchall(PDO::FETCH_CLASS, 'App\Model' . '\\Group');
        return $result;
        // DEBUG
        // $req->debugDumpParams();
        // die;
    }
}
