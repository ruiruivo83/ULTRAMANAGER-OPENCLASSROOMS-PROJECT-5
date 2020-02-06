<?php

declare(strict_types=1);

namespace App\Controller;

use App\View\View;
use App\Model\TicketModel;
use App\Model\GroupModel;
use App\Model\Entity\Group;
use App\Model\Entity\Ticket;

class TicketsController
{
    private $view;
    private $ticketModel;
    private $groupModel;

    public function __construct()
    {
        $this->view = new View;
        $this->ticketModel = new TicketModel();
        $this->groupModel = new GroupModel();
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
            $result = $this->ticketModel->getTicketDetails(intval($_GET['id']));
            $this->view->render("ticketdetails", ['ticketdetails' => $result]);
        } else {
            echo "Missiong ID";
            exit();
        }
    }


    // DISPLAY PAGE - Global Tickets
    public function globalTicketsPage()
    {
        $result = $this->ticketModel->getAllTickets();
        $this->view->render("globaltickets", ['results' => $result]);
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
            var_dump($groupId);
            var_dump($groupName);
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
            header('Location: ../index.php?action=groupdetails&id='. $_GET['groupid']);
            exit();
        }
    }

}
