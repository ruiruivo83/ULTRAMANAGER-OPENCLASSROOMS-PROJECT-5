<?php

declare(strict_types=1);

namespace App\Model;

class Group
{

    // Variables en Private pour ne pas les modifier depuis l'exterieur de la class, seulement le "getter" peux les lir depuis l'exterieur.
    private $id;
    private $group_admin;
    private $creation_date;
    private $group_name;
    private $group_description;
    private $group_status;

    // CONSTRUCT
    public function __construct($parameters = null)
    {
        if ($parameters != null) {
            $this->id = $parameters->id;
            $this->group_admin = $parameters->group_admin;
            $this->creation_date = $parameters->creation_date;
            $this->group_name = $parameters->title;
            $this->group_description = $parameters->description;
            $this->group_status = $parameters->status;
        }
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of group_admin
     */
    public function getGroup_admin()
    {
        return $this->group_admin;
    }

    /**
     * Set the value of group_admin
     *
     * @return  self
     */
    public function setGroup_admin($group_admin)
    {
        $this->group_admin = $group_admin;

        return $this;
    }

    /**
     * Get the value of creation_date
     */
    public function getCreation_date()
    {
        return $this->creation_date;
    }

    /**
     * Set the value of creation_date
     *
     * @return  self
     */
    public function setCreation_date($creation_date)
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    /**
     * Get the value of title
     */
    public function getGroupname()
    {
        return $this->group_name;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setGroupname($group_name)
    {
        $this->group_name = $group_name;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getGroupDescription()
    {
        return $this->group_description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setGroupDescription($group_description)
    {
        $this->group_description = $group_description;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getGroupStatus()
    {
        return $this->group_status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setGroupStatus($group_status)
    {
        $this->group_status = $group_status;

        return $this;
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

    public function getMyGroups(): array
    {
        $bdd = Database::getBdd();
        $currentUser = $_SESSION['user']->getEmail();
        $req = $bdd->prepare("SELECT * FROM groups WHERE group_admin = '$currentUser' ORDER BY creation_date DESC");
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
        $numresult = $req->rowCount();
        if ($numresult > 0) {
            $result = $req->fetch();
            return new Group(
                (int) $result['id'],
                $result['group_admin'],
                $result['creation_date'],
                $result['group_name'],
                $result['group_description'],
                $result['group_status']
            );
        } else {
            return null;
        }
        // DEBUG
        // $req->debugDumpParams();
        // die;
    }
}
