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

    private $ticketModel;

    public function __construct()
    {
        $this->ticketModel = new TicketModel;
    }

    // DISPLAY PAGE - TICKETS PAGE
    public function tickets()
    {
        $result = $this->ticketModel->getMyTickets();
        $this->view->render("tickets", ['tickets' => $result]);
    }

    // DISPLAY PAGE - TICKET DETAILS
    public function ticketDetails()
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
    public function globalTickets()
    {
        $result = $this->ticketModel->getAllTickets();
        $this->view->render("globaltickets", ['groups' => $result]);
    }


    // DISPLAY PAGE - Create Ticket Page
    public function displayCreateTicketPage()
    {
        $contentTitle = "Create New Ticket";
        // TODO
        $content = file_get_contents('../src/View/backend/content/newticket.html');
        $content = str_replace("{TICKET_TYPE}", "(Private)", $content);
        //  {MY_GROUP_LIST}
        $content = str_replace("{MY_GROUP_LIST}", $this->getMyCompiledGroupList(), $content);
        $view = new View;
        // $view->pageBuilder(null, $content, $contentTitle);
        $view->render("ticket", ['ticket' => '5']);
    }


    public function createTicketFunction()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["Title"]) and isset($_POST["Description"]) and isset($_POST["Requester"]) and isset($_POST["Group"])) {
            $TicketModel = new TicketModel();
            $TicketModel->createNewTicket();
            header('Location: ../index.php?action=tickets');
        }
    }

}
