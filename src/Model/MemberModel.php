<?php

declare(strict_types=1);

namespace App\Model;

use PDO;
use App\Tools\Database;
use App\Model\Entity\Member;

class MemberModel
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = Database::getBdd();
    }

    public function getGroupMembersAndDetails(int $groupid): array
    {
        $req = $this->bdd->prepare("SELECT * FROM group_members grp INNER JOIN users usr on usr.id = grp.user_id WHERE group_id = $groupid");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        return $req->fetchall(PDO::FETCH_CLASS, Member::class);
    }

}
