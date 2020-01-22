<?php

namespace App\Model;

use App\Model\Group;
use PDO;

class GroupModel
{

    private $PDO;

    //__ construct

    public function getMyGroups(): ?array
    {

        $group_admin = $_SESSION['user']->getEmail();

        $query = $this->PDO->prepare('SELECT * FROM groups WHERE group_admin = ?');
        $query->execute(array($group_admin));
        $result = $query->fetchall($this->PDO::FETCH_CLASS, 'Group');

        echo count($result);
        die;

        return $result;
    }
}
