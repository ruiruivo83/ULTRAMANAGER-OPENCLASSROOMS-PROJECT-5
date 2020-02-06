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

    public function __construct()
    {
        $this->view = new View;
        $this->ticketModel = new TicketModel;
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
        $this->view->render("createticket", []);
    }


    // DISPLAY PAGE - Create Ticket Page
    public function createTicketPage()
    {
        $result = $this->ticketModel->getAllTickets();
        $this->view->render("globaltickets", ['results' => $result]);
    }


    public function createTicketFunction()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["Title"]) and isset($_POST["Description"]) and isset($_POST["Requester"]) and isset($_POST["Group"])) {
            $TicketModel = new TicketModel();
            $TicketModel->createNewTicket();
            header('Location: ../index.php?action=tickets');
            exit();
        }
    }

}
