<?php

require 'model/Database.php';

class User
{
    // Variables en Private pour ne pas les modifier depuis l'exterieur de la class, seulement le "getter" peux les lir depuis l'exterieur.
    private $id;
    private $psw;
    private $email;
    private $lastname;
    private $firstname;
    private $country;
    private $company;

    // CONSTRUCT
    public function __construct($id, $psw, $email, $lastname, $firstname, $country, $company)
    {
        $this->id = $id;
        $this->psw = $psw;
        $this->email = $email;
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->country = $country;
        $this->company = $company;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @return mixed
     */
    public function getPsw()
    {
        return $this->psw;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getlastname()
    {
        return $this->lastname;
    }

    /**
     * @return mixed
     */
    public function getfirstname()
    {
        return $this->firstname;
    }

    // QUERY - GET ALL INFO ABOUT SPECIFIC USER
    public static function findByEmail($email)
    {
        $bdd = Database::getBdd();
        // GET DATA FROM DATABASE
        $req = $bdd->prepare("SELECT * FROM users WHERE email =  ?   ");
        $req->execute(array($email));
        $numresult = $req->rowCount();
        if ($numresult > 0) {
            # code...
            $result = $req->fetch();
            return new User(
                (int) $result['id'],
                $result['psw'],
                $result['email'],
                $result['lastname'],
                $result['firstname'],
                $result['country'],
                $result['company']
            );
        } else {
            return null;
        }
    }

    // QUERY - ADD USER TO DATABASE
    public function addUser()
    {
        $bdd = Database::getBdd();
        $req = $bdd->prepare("INSERT INTO users(firstname, lastname, email, psw, creation_date, country ) values (?, ?, ?, ?, NOW(), ?) ");
        var_dump($req->execute(array($this->firstname, $this->lastname, $this->email, $this->psw, $this->country)));
        // DEBUG
        // $req->debugDumpParams();
        // die;
    }

    // QUERY - VERIFY IF USER EMAIL EXISTS IN THE DATABASE
    public function getEmailCount()
    {
        $bdd = Database::getBdd($this->email);
        $req = $bdd->prepare("SELECT * FROM users WHERE email =  ?   ");
        $req->execute(array($this->email));
        // DEBUG
        // $req->debugDumpParams();
        // die;
        $emailCount = $req->rowCount();
        return $emailCount;
    }

    // ATACH PHOTO TO USER
    public function atachPhotoToUser($user_id, $filename)
    {
        $bdd = Database::getBdd();
        $req = $bdd->prepare("UPDATE users SET photo_filename=? WHERE id=?");
        $req->execute(array($filename, $user_id));
        // $req->debugDumpParams();
        // die;
    }

    // ATACH PHOTO TO USER
    public function getPhotoIfExist($user_id)
    {
        $bdd = Database::getBdd();
        // SELECT title, description FROM billets WHERE id = :id
        $req = $bdd->prepare("SELECT photo_filename FROM users WHERE id=?");
        $req->execute(array($user_id));
        $result = $req->fetchall();
        // $req->debugDumpParams();
        // die;
        return $result[0];
    }
}
