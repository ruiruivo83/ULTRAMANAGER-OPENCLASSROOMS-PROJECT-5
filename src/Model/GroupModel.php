<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Entity\User;
use App\Tools\SuperGlobals;
use PDO;
use App\Tools\Database;
use App\Model\Entity\Group;

class GroupModel
{
    // CONSTRUCT - 

    private $bdd;
    private $superGlobals;

    public function __construct()
    {
        $this->bdd = Database::getBdd();
        $this->superGlobals = new SuperGlobals();
    }

    public function getMyGroups(): array
    {
        $currentUser = $this->superGlobals->_SESSION("user")['id'];
        $req = $this->bdd->prepare("SELECT * FROM groups WHERE group_admin_id = '$currentUser' ORDER BY creation_date DESC");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        return $req->fetchall(PDO::FETCH_CLASS, Group::class);
    }

    public function getSharedGroupsAndDetails(): array
    {
        $currentUserId = (int)$this->superGlobals->_SESSION("user")['id'];
        $req = $this->bdd->prepare("SELECT * FROM group_members grpmembers INNER JOIN groups grp on grp.id = grpmembers.group_id INNER JOIN users usr on usr.id = grp.group_admin_id WHERE grpmembers.user_id = '$currentUserId' AND grp.group_status = 'open'");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        return $req->fetchall();
    }

    public function getGroupDetails(int $groupId): Group
    {
        $req = $this->bdd->prepare("SELECT * FROM groups WHERE id = '$groupId' ORDER BY creation_date DESC");
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS, Group::class);
        // DEBUG
        // $req->debugDumpParams();
        // die;
        return $req->fetch();
    }

    public function getGroupMembersCount(int $groupId): int
    {
        $req = $this->bdd->prepare("SELECT * FROM group_members WHERE group_id = '$groupId' ");
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS, Group::class);
        // DEBUG
        // $req->debugDumpParams();
        // die;
        return $req->rowCount();
    }


    public function testGroupMemberForCurrentUser(int $groupId): int
    {
        $currentUser = $this->superGlobals->_SESSION("user")['id'];
        $req = $this->bdd->prepare("SELECT * FROM group_members WHERE group_id = '$groupId' AND user_id = '$currentUser'");
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS, Group::class);
        // DEBUG
        // $req->debugDumpParams();
        // die;
        return $req->rowCount();
    }

    public function testGroupAdminForCurrentUser(int $groupId): int
    {
        $currentUser = $this->superGlobals->_SESSION("user")['id'];
        $req = $this->bdd->prepare("SELECT * FROM groups WHERE id = '$groupId' AND group_admin_id = '$currentUser'");
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS, Group::class);
        // DEBUG
        // $req->debugDumpParams();
        // die;
        return $req->rowCount();
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

    public function createNewGroup()
    {
        $currentUser = $_SESSION['user']['id'];
        $req = $this->bdd->prepare("INSERT INTO groups(group_admin_id, creation_date, group_name, group_description, group_status) values(?, NOW(), ?, ?, ?) ");
        $req->execute(array($currentUser, $this->superGlobals->_POST("Title"), $this->superGlobals->_POST("Description"), "open"));
        // DEBUG
        // $req->debugDumpParams();
        // die;
    }

}
