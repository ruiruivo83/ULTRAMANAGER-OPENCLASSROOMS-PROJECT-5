<?php

declare(strict_types=1);

namespace App\Model;

class User
{
    // Variables en Private pour ne pas les modifier depuis l'exterieur de la class, seulement le "getter" peux les lir depuis l'exterieur.
    private $firstname;
    private $lastname;
    private $email;
    private $psw;
    private $creation_date;
    private $id;
    private $country;
    private $company;
    private $photo_filename;

    // CONSTRUCT
    public function __construct($firstname, $lastname, $email, $psw, $creation_date, $id, $country, $company, $photo_filename)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->psw = $psw;
        $this->creation_date = $creation_date;
        $this->id = $id;
        $this->country = $country;
        $this->company = $company;
        $this->photo_filename = $photo_filename;
    }

    /**
     * Get the value of firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of psw
     */
    public function getPsw()
    {
        return $this->psw;
    }

    /**
     * Set the value of psw
     *
     * @return  self
     */
    public function setPsw($psw)
    {
        $this->psw = $psw;

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
     * Get the value of country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of country
     *
     * @return  self
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get the value of company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set the value of company
     *
     * @return  self
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get the value of photo_filename
     */
    public function getPhoto_filename()
    {
        return $this->photo_filename;
    }

    /**
     * Set the value of photo_filename
     *
     * @return  self
     */
    public function setPhoto_filename($photo_filename)
    {
        $this->photo_filename = $photo_filename;

        return $this;
    }




    // CREATE NEW USER
    public function createNewUser()
    {
        $bdd = new Database;
        $bdd = $bdd->getBdd();
        $req = $bdd->prepare("INSERT INTO users(firstname, lastname, email, psw, creation_date, country ) values (?, ?, ?, ?, NOW(), ?) ");
        $req->execute(array($this->firstname, $this->lastname, $this->email, $this->psw, $this->country));
        // DEBUG
        // $req->debugDumpParams();
        // die;
    }


    // FIND USER BY EMAIL
    public static function getUserByEmail($email)
    {
        $bdd = new Database;
        $bdd = $bdd->getBdd();
        // GET DATA FROM DATABASE
        $req = $bdd->prepare("SELECT * FROM users WHERE email =  ?   ");
        $req->execute(array($email));
        $numresult = $req->rowCount();
        if ($numresult > 0) {
            # code...
            $result = $req->fetch();
            return new User(
                $result['firstname'],
                $result['lastname'],
                $result['email'],
                $result['psw'],
                $result['creation_date'],
                (int) $result['id'],
                $result['country'],
                $result['company'],
                $result['photo_filename'],
            );
        } else {
            return null;
        }
    }


    // VERIFY IF USER EMAIL EXISTS IN THE DATABASE
    public function getEmailCount()
    {
        $bdd = new Database;
        $bdd = $bdd->getBdd($this->email);
        $req = $bdd->prepare("SELECT * FROM users WHERE email =  ?   ");
        $req->execute(array($this->email));
        // DEBUG
        // $req->debugDumpParams();
        // die;
        $emailCount = $req->rowCount();
        return $emailCount;
    }
}
