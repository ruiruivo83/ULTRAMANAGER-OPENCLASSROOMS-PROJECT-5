<?php

declare(strict_types=1);

namespace App\Model;

use App\Tools\SuperGlobals;
use PDO;
use App\Tools\Database;
use App\Model\Entity\User;

class UserModel
{

    private $bdd;
    private $superGlobals;

    public function __construct()
    {
        $this->bdd = Database::getBdd();
        $this->superGlobals = new SuperGlobals();
    }

    // CREATE NEW USER
    public function createNewUser()
    {
        $req = $this->bdd->prepare("INSERT INTO users(firstname, lastname, email, psw, creation_date, country ) values (?, ?, ?, ?, NOW(), ?) ");
        $req->execute(array(
            $this->superGlobals->_POST("firstname"),
            $this->superGlobals->_POST("lastname"),
            $this->superGlobals->_POST("email"),
            password_hash($this->superGlobals->_POST("psw"),PASSWORD_DEFAULT),
            $this->superGlobals->_POST("country"))
        );
        // DEBUG
        // $req->debugDumpParams();
        // die;
    }

    // SEARCH USERS
    public function searchUsers(string $searchtext): array
    {
        $req = $this->bdd->prepare("SELECT * FROM users WHERE ( LOWER(firstname) Like  LOWER(?)) OR ( LOWER(lastname) like  LOWER(?)) OR  (LOWER(email) like  LOWER(?))");
        $req->execute(array("%" . $searchtext . "%", "%" . $searchtext . "%", "%" . $searchtext . "%"));
        // DEBUG
        // $req->debugDumpParams();
        // die;
        return $req->fetchall(PDO::FETCH_CLASS, User::class);
    }

    // FIND USER BY EMAIL
    public function getUserByEmail($email)
    {
        $req = $this->bdd->prepare("SELECT * FROM users WHERE email =  ?   ");
        $req->execute(array($email));
        // DEBUG
        // $req->debugDumpParams();
        // die;
        return $req->fetch(PDO::FETCH_CLASS, User::class);
    }

    // FIND USER BY EMAIL
    public function getUserById(int $id): User
    {
        $req = $this->bdd->prepare("SELECT * FROM users WHERE id =  ?   ");
        $req->execute(array($id));
        $req->setFetchMode(PDO::FETCH_CLASS, User::class);
        // DEBUG
        // $req->debugDumpParams();
        // die;
        return $req->fetch();
    }

    // VERIFY IF USER EMAIL EXISTS IN THE DATABASE
    public function getEmailCount($email)
    {
        $req = $this->bdd->prepare("SELECT * FROM users WHERE email =  ?");
        $req->execute(array($email));
        // DEBUG
        // $req->debugDumpParams();
        // die;
        return $req->rowCount();
    }

    // ATACH PHOTO FILE NAME TO USER
    public function atachPhotoFileNameToUser(int $userId,string $fileName): void
    {
        $req = $this->bdd->prepare("UPDATE users SET photo_filename=? WHERE id=?");
        $req->execute(array($fileName, $userId));
        // $req->debugDumpParams();
        // die;
    }


}