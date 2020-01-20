<?php

declare(strict_types=1);

namespace App\Controller;

use App\View\View;
use App\Model\Ticket;
use App\Model\Group;

class TicketsController
{

    public function tickets()
    {
        $contentTitle = "Tickets";
        $commonController = new CommonController();

        // DEFINE BUTTONS TO SHOW
        $buttons = "";
        $buttons .= $commonController->buttonsBuilder("Create New Ticket", "../index.php?action=createticket");

        // BUILD CONTENT
        $content = $commonController->ticketContentBuilder($contentTitle, $buttons);

        // GET MY TICKETS
        $ticket = new Ticket(null, null, null, null, null, null, null, null, null);
        $myTickets = $ticket->getMyTickets();

        // GET HTML TABLE TO SHOW
        $view = new View;
        $htmlTableIndex = ["id", "author", "requester", "status", "creation_date", "title", "description", "group_name", "close_date"];
        $content = str_replace("{HTML_TABLE_RESULT}", $view->htmlTableBuilder($htmlTableIndex, $myTickets), $content);

        $view->pageBuilder(null, $content, $contentTitle);
    }

    public function ticketDetails()
    {
        $contentTitle = "Ticket Details";
        // TODO
        $content = "";

        $view = new View();
        $view->pageBuilder(null, $content, $contentTitle);
        echo $view;
    }

    public function sharedTickets()
    {
        $contentTitle = "Shared Tickets";
        // TODO
        $content = "";

        $view = new View();
        $view->pageBuilder(null, $content, $contentTitle);
        echo $view;
    }

    public function sharedTicketDetails()
    {
        $contentTitle = "Shared Ticket Details";
        // TODO
        $content = "";

        $view = new View();
        $view->pageBuilder(null, $content, $contentTitle);
        echo $view;
    }


    public function globalTickets()
    {

        $contentTitle = "Global Tickets";
        $commonController = new CommonController();

        // DEFINE AND BUILD BUTTONS TO SHOW
        $buttons = "";
        $buttons .= $commonController->buttonsBuilder("Create New Ticket", "../index.php?action=createticket");

        // BUILD CONTENT
        $content = $commonController->groupContentBuilder($contentTitle, $buttons);

        // GET MY GROUPS
        $ticket = new Ticket(null, null, null, null, null, null, null, null, null);
        $myTickets = $ticket->getTickets();

      
         // GET HTML TABLE TO SHOW
        $view = new View;
        $htmlTableIndex = ["id", "author", "requester", "status", "creation_date", "title", "description", "group_name", "close_date"];
        $content = str_replace("{HTML_TABLE_RESULT}", $view->htmlTableBuilder($htmlTableIndex, $myTickets), $content);
       
        $view->pageBuilder(null, $content, $contentTitle);
    }

    public function displayCreateTicketPage()
    {
        $contentTitle = "Create New Ticket";
        // TODO
        $content = file_get_contents('../src/View/backend/content/newticket.html');
        $content = str_replace("{TICKET_TYPE}", "(Private)", $content);

        $view = new View;
        $view->pageBuilder(null, $content, $contentTitle);
    }

    public function createTicketFunction()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["Title"]) and isset($_POST["Description"])) {
            $title = $_POST["Title"];
            $description = $_POST["Description"];
            $requester = $_POST["Requester"];
            $ticket_admin = $_SESSION['user']->getEmail();
            $ticket_status = "open";
            // INSERT INTO DATABASE
            // Create class instance
            $Ticket = new Ticket(null, $ticket_admin, $requester, $ticket_status, null, $title, $description, null, null);
            // Execute method addTicket
            $Ticket->createNewTicket();
            header('Location: ../index.php?action=groups');
            // exit();
        }
    }

    public function replaceTicketList($status)
    {
        $ticket_list_final_code = null;
        $ticket_admin = $_SESSION['user']->getEmail();
        if (isset($_SESSION['user'])) {
            $ticket = new Ticket(null, null, null, null, null, null, null, null, null);
            $ticketList = $ticket->getTickets($status);
            foreach ($ticketList as $current_ticket) {
                $ticket = null;
                $ticket = file_get_contents('../src/View/backend/tickets/ticket_list_default_code.html');
                $ticket = str_replace("{TICKET_AUTHOR}", $current_ticket["author"], $ticket);
                $ticket = str_replace("{TICKET_ID}", $current_ticket["id"], $ticket, $count);
                $ticket = str_replace("{TICKET_DESCRIPTION}", $current_ticket["description"], $ticket);
                $ticket = str_replace("{TICKET_NAME}", $current_ticket["title"], $ticket);
                $ticket = str_replace("{CURRENT_USER_EMAIL}", $ticket_admin, $ticket);
                $ticket_list_final_code .= $ticket;
            }
            $ticket_list_final_code = str_replace("{TICKET_LIST}", $ticket_list_final_code, $ticket_list_final_code);
            $ticket_list_final_code = "<div>{TICKET_STATUS_TITLE}</div>" . $ticket_list_final_code;
            if ($status == "open") {
                $ticket_list_final_code = str_replace("{TICKET_STATUS_TITLE}", "Open", $ticket_list_final_code);
            } else {
                $ticket_list_final_code = str_replace("{TICKET_STATUS_TITLE}", "Closed", $ticket_list_final_code);
            }
        }


        return $ticket_list_final_code;
    }
}
