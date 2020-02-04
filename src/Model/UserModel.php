<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\Entity\Group;
use PDO;
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

    // FIND USER BY EMAIL
    public function getUserByEmail($email)
    {
        $req = $this->bdd->prepare("SELECT * FROM users WHERE email =  ?   ");
        $req->execute(array($email));
        return $req->fetchall(PDO::FETCH_CLASS, User::class);
        // DEBUG
        // $req->debugDumpParams();
        // die;
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