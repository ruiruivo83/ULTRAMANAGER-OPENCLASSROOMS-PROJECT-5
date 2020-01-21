<?php

use App\Model\Group;

class GroupModel
{

    //__ construct

    public function getGroup(int $id): ?array
    {

        $query = $this->PDO->prepare{
            'SELECT * FROM ... WHERE group_admin = $group_admin'};
        $query->execute(['id' => $id]);
        $result = $query->fetchall($this->PDO::FETCH_CLASS, Group::class);

        foreach ($result as $groups) {
           $groups->getGroupName();
           $groups->getGroupAdmin();
        }

        return $result;
    }
}
