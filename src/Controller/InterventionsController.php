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

    // DISPLAY GLOBAL TICKETS PAGE
    public function globalInterventionsPage()
    {

        $finalInterventionsTable = array();

        // GET MY TICKETS FROM MY GROUPS
        // Shared Groups
        $result = $this->groupModel->getMyGroups();
        // Get Tickets for my groups
        $finalArrayMyTickets = array();
        foreach ($result as $key) {
            $finalArrayMyTickets = array_merge($finalArrayMyTickets, $this->ticketModel->getTicketsWithGroupId((int)$key->getId()));
        }

        // GET SHARED TICKETS FROM SHARED GROUPS
        // Shared Groups
        $result = $this->groupModel->getSharedGroups();
        // Get Tickets for shared groups
        $finalArraySharedTickets = array();
        foreach ($result as $key) {
            $finalArraySharedTickets = array_merge($finalArraySharedTickets, $this->ticketModel->getTicketsWithGroupId((int)$key['group_id']));
        }

        $finalTicketList = array_merge($finalArrayMyTickets, $finalArraySharedTickets);

        foreach ($finalTicketList as $ticket) {
            $finalInterventionsTable = array_merge($finalInterventionsTable, $this->interventionModel->getInterventionForTicketId((int)$ticket['id']));
        }

        $this->view->render("globalinterventions", ['results' => $finalInterventionsTable]);
    }


}
