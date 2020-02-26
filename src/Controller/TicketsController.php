<?php

declare(strict_types=1);

namespace App\Controller;

use App\Tools\SuperGlobals;
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
    private $superGlobals;

    public function __construct()
    {
        $this->view = new View;
        $this->ticketModel = new TicketModel();
        $this->groupModel = new GroupModel();
        $this->interventionModel = new InterventionModel();
        $this->superGlobals = new SuperGlobals();
    }

    // DISPLAY PAGE - TICKET DETAILS
    public function ticketDetailsPage()
    {
        $ticketDetails = $this->ticketModel->getTicketDetails((int)$this->superGlobals->_GET("id"));
        $groupDetails = $this->groupModel->getGroupDetails((int)$ticketDetails->getGroup_id());
        $interventionList = $this->interventionModel->getInterventionsForTicketIdAndAuthorDetails((int)$ticketDetails->getId());
        $this->view->render("ticketdetails", ['groupdetails' => $groupDetails, 'ticketdetails' => $ticketDetails, 'interventionresults' => $interventionList]);

    }

    // DISPLAY GLOBAL TICKETS PAGE
    public function globalTicketsPage()
    {
        $result = $this->groupModel->getMyGroups();
        $finalArrayMyTickets = array();
        foreach ($result as $key) {
            $finalArrayMyTickets = array_merge($finalArrayMyTickets, $this->ticketModel->getOpenTicketsWithGroupId((int)$key->getId()));
        }
        $result = $this->groupModel->getSharedGroups();
        $finalArraySharedTickets = array();
        foreach ($result as $key) {
            $finalArraySharedTickets = array_merge($finalArraySharedTickets, $this->ticketModel->getOpenTicketsWithGroupId((int)$key['group_id']));
        }
        $finalTable = array_merge($finalArrayMyTickets, $finalArraySharedTickets);
        $this->view->render("globaltickets", ['results' => $finalTable]);
    }

    // DISPLAY PAGE - Create Ticket Page
    public function createTicketPage()
    {
        $groupName = "";
        if ($this->superGlobals->ISSET_GET("groupid")) {
            $group = $this->groupModel->getGroupDetails((int)$this->superGlobals->_GET("groupid"));
            foreach ($group as $key) {
                $groupName = $key->getGroup_name();
            }
            $groupId = $this->superGlobals->_GET("groupid");
            $this->view->render("createticket", ['groupid' => $groupId, 'groupname' => $groupName]);
        } else {
            echo "Missiong ID";
            exit();
        }
    }


    // DISPLAY PAGE - Shared Tickets
    public function sharedTicketsPage()
    {
        $result = $this->groupModel->getSharedGroups();
        $finalArray = array();
        foreach ($result as $key) {
            $finalArray = array_merge($finalArray, $this->ticketModel->getOpenTicketsWithGroupId((int)$key['group_id']));
        }
        $this->view->render("sharedtickets", ['results' => $finalArray]);
    }

    // DISPLAY PAGE - My Tickets
    public function myTicketsPage()
    {
        $result = $this->groupModel->getMyGroups();
        $finalArray = array();
        foreach ($result as $key) {
            $finalArray = array_merge($finalArray, $this->ticketModel->getOpenTicketsWithGroupId((int)$key->getId()));
        }
        $this->view->render("mytickets", ['results' => $finalArray]);
    }

    // CREATE TICKET FUNCTION
    public function createTicketFunction()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" and $this->superGlobals->ISSET_POST("Title") and $this->superGlobals->ISSET_POST("Description") and $this->superGlobals->ISSET_POST("Requester") and $this->superGlobals->ISSET_GET("groupid")) {
            $this->ticketModel->createNewTicket();
            header('Location: ../index.php?action=groupdetails&id=' . $this->superGlobals->_GET("groupid"));
            exit();
        }
    }

    // CLOSE TICKET FUNCTION
    public function closeTicketFunction()
    {
        if ($this->superGlobals->ISSET_GET("ticketid")) {
            $ticketId = $this->superGlobals->_GET("ticketid");
            // ADD CLOSE INTERVENTION
            $interventionDescription = "CLOSING TICKET";
            $this->interventionModel->createClosingIntervention($ticketId, $interventionDescription);
            // CHANGE TICKET STATUS
            $this->ticketModel->closeTicket($ticketId);
            header('Location: ../index.php?action=mytickets');
            exit();
        }
        header('Location: ../index.php');
        exit();
        // ?? $this->ticketModel->closeTicket();
    }


}
