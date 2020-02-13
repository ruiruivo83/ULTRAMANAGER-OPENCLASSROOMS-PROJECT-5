<?php

declare(strict_types=1);

namespace App\Model;

use PDO;
use App\Model\Entity\Member;

class MemberModel
{

    // CONSTRUCT

    private $bdd;

    public function __construct()
    {
        $this->bdd = Database::getBdd();
    }

    public function getGroupMembers(int $groupid): array
    {
        $req = $this->bdd->prepare("SELECT * FROM group_members WHERE group_id = '$groupid' ");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        return $req->fetchall(PDO::FETCH_CLASS, Member::class);
    }

}
