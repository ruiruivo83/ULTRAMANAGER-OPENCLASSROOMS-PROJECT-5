<?php

declare(strict_types=1);

namespace App\Controller;

use App\View\View;
use App\Model\InterventionModel;

class InterventionsController
{

    private $view;
    private $interventionModel;
    private $var_dump;

    public function __construct()
    {
        $this->view = new View();
        $this->interventionModel = new InterventionModel();
    }

    public function myInterventionsPage()
    {

    }


    public function globalInterventionsPage()
    {
        $result = $this->interventionModel->getAllInterventions();
        $this->view->render("globalinterventions", ['interventions' => $result]);
    }

    public function interventionDetailsPage()
    {

    }

    public function sharedInterventionsPage()
    {

    }

    public function sharedInterventionDetailsPage()
    {

    }


    public function createInterventionPage()
    {
        $result = $this->interventionModel->getAllInterventions();
        $ticketId = $_GET["ticketid"];
        $this->view->render("createintervention", ['interventions' => $result, 'ticketid' => $ticketId]);
    }

    public function createInterventionFunction()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["Title"]) and isset($_POST["Description"]) and isset($_POST["ticketid"])) {
            // Add Intervention to Database
            $this->interventionModel->createNewIntervention();
            header('Location: ../index.php?action=ticketdetails&id=' . $_POST["ticketid"]);
            exit();
        }
    }


}
