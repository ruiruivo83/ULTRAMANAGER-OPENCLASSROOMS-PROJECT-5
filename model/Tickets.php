<?php


class Tickets
{

    private $bdd;
    private $id;
    private $Title;
    private $Description;
    private $Author;
    private $Requester;

    public function __construct($id, $Title, $Description, $Author, $Requester)
    {
        $this->setId($id);
        $this->setDescription($Description);
        $this->setTitle($Title);
        $this->setAuthor($Author);
        $this->setRequester($Requester);
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->Author;
    }

    /**
     * @param mixed $Author
     */
    public function setAuthor($Author)
    {
        $this->Author = $Author;
    }

    /**
     * @return mixed
     */
    public function getRequester()
    {
        return $this->Requester;
    }

    /**
     * @param mixed $Requester
     */
    public function setRequester($Requester)
    {
        $this->Requester = $Requester;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($Title)
    {
        $this->Title = $Title;
    }

    /**
     * @param mixed $Description
     */
    public function setDescription($Description)
    {
        $this->Description = $Description;
    }

    // GET ALL TICKETS FROM DATABASE, ORDER BY DESC DATE
    public function getMyTickets()
    {
        $bdd = Database::getBdd();
        // PREPARE QUERY - utilise prepare pour les accents sur les lettres
        $currentUserEmail = $_SESSION['user']->getEmail();
        $req = $bdd->prepare("SELECT * FROM ticket WHERE author = '$currentUserEmail' AND status = 'open' ORDER BY creation_date DESC");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        $result = $req->fetchall();
        return $result;
    }

    // GET ALL TICKETS FROM DATABASE, ORDER BY DESC DATE
    public function getMyTicketsOpen()
    {
        $bdd = Database::getBdd();
        // PREPARE QUERY - utilise prepare pour les accents sur les lettres
        $currentUserEmail = $_SESSION['user']->getEmail();
        $req = $bdd->prepare("SELECT * FROM ticket WHERE author = '$currentUserEmail' AND status = 'open' ORDER BY creation_date DESC");
        $req->execute();
        // DEBUG
        // $req->debugDumpParams();
        // die;
        $result = $req->fetchall();
        return $result;
    }



    // GET ALL INTERVENTIONS FROM DATABASE FOR SPECIFIC TICKET, ORDER BY DESC DATE
    public function getTicketInterventions($ticket_id)
    {
        $bdd = Database::getBdd();
        // SELECT * FROM comments WHERE post_id = '$post_id' AND valide = 1 AND signale = 0 ORDER BY date_creation DESC
        $req = $bdd->prepare("SELECT * FROM ticket_interventions WHERE ticket_id = '$ticket_id' ORDER BY intervention_date DESC");
        $req->execute();
        $result = $req->fetchall();
        return $result;
    }


    // ADD TICKET TO DATABASE
    public function addTicket($Title, $Description, $Author, $Requester)
    {
        $bdd = Database::getBdd();
        $req = $bdd->prepare("INSERT INTO ticket( title, description, creation_date, status, author, requester) values (?,?, NOW(), ?, ?, ?) ");
        $Status = "open";
        $req->execute(array($Title, $Description, $Status, $Author, $Requester));
    }

    // CLOSE TICKET ID
    public function closeTicket($ticketid)
    {
        $bdd = Database::getBdd();
        $req = $bdd->prepare("UPDATE ticket SET status='close' WHERE id=?");
        $req->execute(array($ticketid));
        // DEBUG
        // $req->debugDumpParams();
        // die;
    }


    public function addTicketIntervention($Ticket_id, $Intervention_Description, $Intervention_Author)
    {
        $Intervention_Author_Country = $_SESSION['user']->getCountry();
        $Intervention_Author_Company = $_SESSION['user']->getCompany();
        $bdd = Database::getBdd();
        $req = $bdd->prepare("INSERT INTO ticket_interventions(ticket_id, intervention_author, intervention_date, intervention_description, intervention_author_country, intervention_author_company ) values (?,  ?,NOW(), ?, ?, ?) ");
        $req->execute(array($Ticket_id, $Intervention_Author, $Intervention_Description, $Intervention_Author_Country, $Intervention_Author_Company));
    }

    // EDIT TICKET*
    /*
    public function edit_post_query($id)
    {
        $bdd = Database::getBdd();
        $req = $bdd->prepare('SELECT title, description FROM billets WHERE id = :id');
        $req->bindParam(':id', $id);
        $req->execute();
        $result = $req->fetchall();
        return $result;
    }
    */

    // UPDATE TICKET
    /*
    public function update()
    {
        $bdd = Database::getBdd();
        $req = $bdd->prepare("UPDATE ticket SET title=? , description=? WHERE id=?");
        $req->execute(array($this->title, $this->Description, $this->id));
    }
    */

    // DELETE TICKET
    /*
    public function delete()
    {
        $bdd = Database::getBdd();
        // DELETE POST ID
        $req = $bdd->prepare('DELETE FROM billets WHERE id = :id');
        $req->bindParam(':id', $_GET['id']);
        $req->execute();
        // DELETE COMMENTS FOR POST ID
        $req = $bdd->prepare('DELETE FROM comments WHERE post_id = :id');
        $req->bindParam(':id', $_GET['id']);
        $req->execute();
    }
    */
}
