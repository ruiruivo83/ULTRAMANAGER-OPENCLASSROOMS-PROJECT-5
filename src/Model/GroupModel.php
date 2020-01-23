<?php

namespace App\Model;

use PDO;

class GroupModel
{

    public function getMyGroups(): array
    {
        $bdd = Database::getBdd();
        $req = $bdd->prepare("SELECT * FROM groups ORDER BY creation_date DESC");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        // $Group = new Group(null, null, null, null, null, null);
        $result = $req->fetchall(PDO::FETCH_CLASS, 'App\Model'.'\\Group');
       
        return $result;
    }














    /*
    public function getMyGroups(): ?array
    {
        $group_admin = $_SESSION['user']->getEmail();


        $bdd = Database::getBdd();
        $pdoConnection = new PDO($bdd);
        $query = $pdoConnection->prepare('SELECT * FROM groups WHERE group_admin = ?');
        $query->execute(array($group_admin));
        $result = $query->fetchall($pdoConnection::FETCH_CLASS, 'Group');

        echo count($result);
        die;

        return $result;
    }
    */










}
