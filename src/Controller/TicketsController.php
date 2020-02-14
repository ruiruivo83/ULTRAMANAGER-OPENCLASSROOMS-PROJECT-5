<?php

declare(strict_types=1);

namespace App\Controller;

use App\View\View;
use App\Model\TicketModel;
use App\Model\GroupModel;
use App\Model\InterventionModel;
use App\Model\Entity\Group;
use App\Model\Entity\Ticket;

class TicketsController
{
    private $view;
    private $ticketModel;
    private $groupModel;
    private $interventionModel;

    public function __construct()
    {
        $this->view = new View;
        $this->ticketModel = new TicketModel();
        $this->groupModel = new GroupModel();
        $this->interventionModel = new InterventionModel();
    }

    // DISPLAY PAGE - TICKETS PAGE
    public function ticketsPage()
    {
        $result = $this->ticketModel->getMyTickets();
        $this->view->render("tickets", ['tickets' => $result]);
    }

    // DISPLAY PAGE - TICKET DETAILS
    public function ticketDetailsPage()
    {
        if (isset($_GET['id'])) {
            $ticketResult = $this->ticketModel->getTicketDetails(intval($_GET['id']));
            foreach ($ticketResult as $ticket) {
                $groupResult = $this->groupModel->getGroupDetails(intval($ticket->getGroup_id()));
                $interventionResult = $this->interventionModel->getAllInterventionsForTicketId(intval($ticket->getId()));
            }
            $this->view->render("ticketdetails", ['groupresults' => $groupResult, 'ticketresults' => $ticketResult, 'interventionresults' => $interventionResult]);
        } else {
            echo "Missiong ID";
            exit();
        }
    }

    // DISPLAY GLOBAL TICKETS PAGE
    public function globalTicketsPage()
    {


        // GET MY TICKETS FROM MY GROUPS
        // Shared Groups
        $result = $this->groupModel->getMyGroups();
        // Get Tickets for my groups
        $finalArrayMyTickets = array();
        foreach ($result as $key) {
            $finalArrayMyTickets = array_merge($finalArrayMyTickets, $this->ticketModel->getTicketsWithGroupId(intval($key->getId())));
        }

        // GET SHARED TICKETS FROM SHARED GROUPS
        // Shared Groups
        $result = $this->groupModel->getSharedGroups();
        // Get Tickets for shared groups
        $finalArraySharedTickets = array();
        foreach ($result as $key) {
            $finalArraySharedTickets = array_merge($finalArraySharedTickets, $this->ticketModel->getTicketsWithGroupId(intval($key['group_id'])));
        }

        $finalTable = array_merge($finalArrayMyTickets, $finalArraySharedTickets);

        $this->view->render("globaltickets", ['results' => $finalTable]);
    }


    // DISPLAY PAGE - Create Ticket Page
    public function createTicketPage()
    {
        $groupName = "";
        if (isset($_GET['groupid'])) {
            $group = $this->groupModel->getGroupDetails(intval($_GET['groupid']));
            foreach ($group as $key) {
                $groupName = $key->getGroup_name();
            }
            $groupId = $_GET['groupid'];
            $this->view->render("createticket", ['groupid' => $groupId, 'groupname' => $groupName]);
        } else {
            echo "Missiong ID";
            exit();
        }
    }


    public function createTicketFunction()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["Title"]) and isset($_POST["Description"]) and isset($_POST["Requester"]) and isset($_GET['groupid'])) {
            $this->ticketModel->createNewTicket();
            header('Location: ../index.php?action=groupdetails&id=' . $_GET['groupid']);
            exit();
        }
    }

    // DISPLAY PAGE - Shared Tickets
    public function sharedTicketsPage()
    {
        // Shared Groups
        $result = $this->groupModel->getSharedGroups();
        // Get Tickets for shared groups
        $finalArray = array();
        foreach ($result as $key) {
            $finalArray = array_merge($finalArray, $this->ticketModel->getTicketsWithGroupId(intval($key['group_id'])));
        }
        $this->view->render("sharedtickets", ['results' => $finalArray]);
    }

    // DISPLAY PAGE - My Tickets
    public function myTicketsPage()
    {
        // Shared Groups
        $result = $this->groupModel->getMyGroups();
        // Get Tickets for shared groups
        $finalArray = array();
        foreach ($result as $key) {
            $finalArray = array_merge($finalArray, $this->ticketModel->getTicketsWithGroupId(intval($key->getId())));
        }
        $this->view->render("mytickets", ['results' => $finalArray]);
    }


}
