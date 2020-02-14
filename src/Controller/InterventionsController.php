<?php

declare(strict_types=1);

namespace App\Controller;

use App\View\View;
use App\Model\GroupModel;
use App\Model\TicketModel;
use App\Model\InterventionModel;

class InterventionsController
{

    private $view;
    private $interventionModel;
    private $groupModel;
    private $ticketModel;

    public function __construct()
    {
        $this->view = new View();
        $this->interventionModel = new InterventionModel();
        $this->groupModel = new GroupModel();
        $this->ticketModel = new TicketModel();
    }


    // DISPLAY PAGE - Shared Interventions
    // TODO

    public function sharedInterventionsPage()
    {
        // GET SHARED GROUPS
        $result = $this->groupModel->getSharedGroups();
        // GET TICKETS FOR SHARED GROUPS
        $finalArray = array();
        foreach ($result as $key) {
            $ticketList = $this->ticketModel->getTicketsWithGroupId(intval($key['group_id']));
            foreach ($ticketList as $ticket) {
                $finalArray = array_merge($finalArray, $this->interventionModel->getInterventionForTicketId(intval($ticket['id'])));
            }
        }

        $this->view->render("sharedinterventions", ['results' => $finalArray]);
    }

    public function myInterventionsPage()
    {
        // GET SHARED GROUPS
        $result = $this->groupModel->getMyGroups();
        // GET TICKETS FOR SHARED GROUPS
        $finalArray = array();
        foreach ($result as $key) {
            $ticketList = $this->ticketModel->getTicketsWithGroupId(intval($key->getId()));
            foreach ($ticketList as $ticket) {
                $finalArray = array_merge($finalArray, $this->interventionModel->getInterventionForTicketId(intval($ticket['id'])));
            }
        }
        $this->view->render("myinterventions", ['results' => $finalArray]);
    }

    // DISPLAY PAGE - Global Interventions Page
    public function globalInterventionsPage()
    {
        $result = $this->interventionModel->getAllInterventions();
        $this->view->render("globalinterventions", ['interventions' => $result]);
    }

    // DISPLAY PAGE - Create Interventions Page
    public function createInterventionPage()
    {
        // $result = $this->interventionModel->getAllInterventions();
        $ticketId = $_GET["ticketid"];
        $this->view->render("createintervention", ['ticketid' => $ticketId]);
    }

    // Create Intervention Function
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
