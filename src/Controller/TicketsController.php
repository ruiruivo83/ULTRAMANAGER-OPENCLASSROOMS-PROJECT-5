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

    // CREATE TICKET FUNCTION
    public function createTicketFunction()
    {
        $action = $this->superGlobals->_GET("action");
        $id = $this->superGlobals->_GET("groupid");
        if ($this->testForAccess((string)$action, (int)$id)) {
            if ($_SERVER['REQUEST_METHOD'] == "POST" and $this->superGlobals->ISSET_POST("Title") and $this->superGlobals->ISSET_POST("Description") and $this->superGlobals->ISSET_POST("Requester") and $this->superGlobals->ISSET_GET("groupid")) {
                $this->ticketModel->createNewTicket();
                header('Location: ../index.php?action=groupdetails&id=' . $this->superGlobals->_GET("groupid"));
                exit();
            }
        } else {
            header('Location: ../index.php');
            exit();
        }
    }

    // SECURITY TEST
    private function testForAccess(string $action, int $id): bool
    {
        if ($action == "ticketdetails") {
            // GET GROUP ID WITH TICKET ID
            $ticketId = (int)$this->superGlobals->_GET("id");
            $ticketGroupId = $this->ticketModel->getTicketGroupIdWithTicketId((int)$ticketId);
            $groupId = $ticketGroupId->getGroup_id();
            if ($this->groupModel->testGroupMemberForCurrentUser((int)$groupId) != 0 OR $this->groupModel->testGroupAdminForCurrentUser((int)$groupId) != 0) {
                return true;
            } else  return false;
        }
        if ($action == "createticketfunction") {
            if ($this->groupModel->testGroupMemberForCurrentUser((int)$id) != 0 OR $this->groupModel->testGroupAdminForCurrentUser((int)$id) != 0) {
                return true;
            } else  return false;
        } else {
            header('Location: ../index.php');
            exit();
        }
    }

    // DISPLAY PAGE - TICKET DETAILS
    public function ticketDetailsPage()
    {
        $action = $this->superGlobals->_GET("action");
        $id = (int)$this->superGlobals->_GET("id");
        if ($this->testForAccess($action, $id)) {
            $ticketDetails = $this->ticketModel->getTicketDetails((int)$this->superGlobals->_GET("id"));
            $groupDetails = $this->groupModel->getGroupDetails((int)$ticketDetails->getGroup_id());
            $interventionList = $this->interventionModel->getInterventionsForTicketIdAndAuthorDetails((int)$ticketDetails->getId());
            $this->view->render("ticketdetails", ['groupdetails' => $groupDetails, 'ticketdetails' => $ticketDetails, 'interventionresults' => $interventionList]);

        } else {
            header('Location: ../index.php');
            exit();
        }
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
        $result = $this->ticketModel->getMyTickets("open");
        $this->view->render("mytickets", ['results' => $result]);
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
        } else {
            header('Location: ../index.php');
            exit();
        }

    }


}
