<?php

declare(strict_types=1);

namespace App\Model;

use PDO;
use App\Tools\Database;
use App\Model\Entity\User;

class UserModel
{

    private $bdd;

    public function __construct()
    {
        $this->bdd = Database::getBdd();
    }

    // CREATE NEW USER
    public function createNewUser()
    {
        $req = $this->bdd->prepare("INSERT INTO users(firstname, lastname, email, psw, creation_date, country ) values (?, ?, ?, ?, NOW(), ?) ");
        $req->execute(array($_POST["firstname"], $_POST["lastname"], $_POST["email"], password_hash($_POST["psw"], PASSWORD_DEFAULT), $_POST["country"]));
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
        return $req->fetchall(PDO::FETCH_CLASS, User::class);
    }

    // FIND USER BY EMAIL
    public function getUserById(int $id): array
    {
        $req = $this->bdd->prepare("SELECT * FROM users WHERE id =  ?   ");
        $req->execute(array($id));
        // DEBUG
        // $req->debugDumpParams();
        // die;
        return $req->fetchall(PDO::FETCH_CLASS, User::class);
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





}