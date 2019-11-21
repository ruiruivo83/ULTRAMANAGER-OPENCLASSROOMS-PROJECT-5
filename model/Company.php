<?php
class Company
{
    private $CompanyName;
    private $CompanyOwner;

    public function __construct($id, $CompanyName, $CompanyOwner)
    {
        $this->setId($id);
        $this->setCompanyOwner($CompanyOwner);
        $this->setCompanyName($CompanyName);
    }

       /**
     * @param mixed $id
     */
    public function getId($id)
    {
        $this->id = $id;
    }

      /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCompanyName()
    {
        return $this->CompanyName;
    }

    /**
     * @param mixed $CompanyName
     */
    public function setCompanyName($CompanyName)
    {
        $this->CompanyName = $CompanyName;
    }

    /**
     * @return mixed
     */
    public function getCompanyOwner()
    {
        return $this->CompanyOwner;
    }

    /**
     * @param mixed $CompanyOwner
     */
    public function setCompanyOwner($CompanyOwner)
    {
        $this->CompanyOwner = $CompanyOwner;
    }

    // ADD TICKET TO DATABASE
    public function addCompany($id, $CompanyName, $CompanyOwner)
    {
        $bdd = Database::getBdd();
        $req = $bdd->prepare("INSERT INTO company(company_name, company_owner, creation_date) values (?,?, NOW()) ");       
        $req->execute(array($CompanyName, $CompanyOwner));        
    }


    
    // GET ALL TICKETS FROM DATABASE, ORDER BY DESC DATE
    public function getMyCompany()
    {
        $bdd = Database::getBdd();        
        $currentUserEmail = $_SESSION['user']->getEmail();
        $req = $bdd->prepare("SELECT * FROM company WHERE company_owner = '$currentUserEmail'  ORDER BY creation_date DESC");
        $req->execute();        
        $result = $req->fetchall();       
        return $result;
    }

      
   


}
