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

    // DISPLAY TICKETS PAGE
    public function tickets()
    {
        $view = new View;
        $contentTitle = "Tickets";

        // BUILD CONTENT
        $content = $view->ticketContentBuilder($contentTitle, null);

        // GET MY TICKETS
        $ticketModel = new TicketModel(null, null, null, null, null, null, null, null, null);
        $result = $ticketModel->getMyTickets();


        $total = count($result);
        $compiledArray = array();

        // NOT NECESSARY IF TO REBUILD THE $view->htmlTableBuilder() method
        for ($i = 0; $i < $total; $i++) {
            foreach ($result as $value) {
                $currentArray = array($value->getId(), $value->getAuthor(), $value->getRequester(), $value->getCreation_date(), $value->getTitle(), $value->getDescription(), $value->getGroup_id(), $value->getStatus(), $value->getClosed_date());
                $compiledArray[$i] = $currentArray;
                $i++;
            }
        }

        // GET HTML TABLE TO SHOW
        $view = new View;
        $htmlTableIndex = ["id", "Author", "Requester", "Creation Date", "Title", "Description", "Group Id", "Status", "Close Date"];
        $content = str_replace("{HTML_TABLE_RESULT}", $view->htmlTableBuilder($htmlTableIndex, $compiledArray), $content);

        $view->pageBuilder(null, $content, $contentTitle);
    }

    // DISPLAY TICKET DETAILS PAGE
    public function ticketDetails()
    {

        if (isset($_GET['id'])) {

            $id = $_GET['id'];

            $view = new View();

            $ticketModel = new TicketModel();
            $groupModel = new GroupModel();

            $contentTitle = "Ticket Details";

            // DEFINE BUTTONS TO SHOW
            $buttons = "";
            $buttons .= $view->buttonsBuilder("Close Ticket", "../index.php?action=closeticket&id=" . $id);

            // BUILD CONTENT
            $content = $view->ticketContentBuilder($contentTitle, $buttons);

            // REPLACE {HTML_TABLE_RESULT} BY TICKET DETAILS PAGE
            $ticketDetailsContentPage = file_get_contents('../src/View/backend/content/ticketdetails.html');
            $content = str_replace("{HTML_TABLE_RESULT}",  $ticketDetailsContentPage, $content);

            // GET TICKET DETAILS           
            $ticketModel = $ticketModel->getTicketDetails(intval($id));



            foreach ($ticketModel as $ticketValue) {
                $content = str_replace("{TICKET_TITLE}",  $ticketValue->getTitle(), $content);
                // 

                $groupModel = $groupModel->getGroupDetails(intval($ticketValue->getGroup_id()));
                foreach ($groupModel as $groupValue) {
                    // var_dump($groupValue);
                    // die;
                    $content = str_replace("{GROUP_NAME}",  $groupValue->getGroup_name(), $content);
                    $content = str_replace("{GROUP_ID}",  $groupValue->getId(), $content);
                    $content = str_replace("{GROUP_ADMIN}",   $groupValue->getGroup_admin(), $content);
                }

                // 


                // {TICKET_AUTHOR}
                $content = str_replace("{TICKET_AUTHOR}",   $ticketValue->getAuthor(), $content);
                // {REQUESTER}
                $content = str_replace("{REQUESTER}",   $ticketValue->getRequester(), $content);
                // {TICKET_STATUS}
                $content = str_replace("{TICKET_STATUS}",   $ticketValue->getStatus(), $content);
                // {CREATION_DATE}
                $content = str_replace("{CREATION_DATE}",  $ticketValue->getCreation_Date(), $content);
                // {DESCRIPTION}
                $content = str_replace("{DESCRIPTION}",   $ticketValue->getDESCRIPTION(), $content);
            }


            $view->pageBuilder(null, $content, $contentTitle);
        } else {
            echo "Missiong ID";
            die;
        }
    }

    public function sharedTickets()
    {
        $contentTitle = "Shared Tickets";
        // TODO
        $content = "";

        $view = new View();
        $view->pageBuilder(null, $content, $contentTitle);
    }

    public function sharedTicketDetails()
    {
        $contentTitle = "Shared Ticket Details";
        // TODO
        $content = "";

        $view = new View();
        $view->pageBuilder(null, $content, $contentTitle);
    }


    public function globalTickets()
    {
        $view = new View();
        $contentTitle = "Global Tickets";

        // DEFINE AND BUILD BUTTONS TO SHOW
        $buttons = "";
        $buttons .= $view->buttonsBuilder("Create New Ticket", "../index.php?action=createticket");

        // BUILD CONTENT
        $content = $view->groupContentBuilder($contentTitle, $buttons);

        // GET MY GROUPS
        $ticketModel = new TicketModel(null, null, null, null, null, null, null, null, null);
        $result = $ticketModel->getAllTickets();


        $total = count($result);
        $compiledArray = array();

        // NOT NECESSARY IF TO REBUILD THE $view->htmlTableBuilder() method
        for ($i = 0; $i < $total; $i++) {
            foreach ($result as $value) {
                $currentArray = array($value->getId(), $value->getAuthor(), $value->getRequester(), $value->getCreation_date(), $value->getTitle(), $value->getDescription(), $value->getGroup_id(), $value->getStatus(), $value->getClosed_date());
                $compiledArray[$i] = $currentArray;
                $i++;
            }
        }

        // GET HTML TABLE TO SHOW
        $view = new View;
        $htmlTableIndex = ["id", "Author", "Requester", "Status", "Creation Date", "Title", "Description",  "Close Date"];
        $content = str_replace("{HTML_TABLE_RESULT}", $view->htmlTableBuilder($htmlTableIndex, $compiledArray), $content);

        $view->pageBuilder(null, $content, $contentTitle);
    }


    public function displayCreateTicketPage()
    {
        $contentTitle = "Create New Ticket";
        // TODO
        $content = file_get_contents('../src/View/backend/content/newticket.html');
        $content = str_replace("{TICKET_TYPE}", "(Private)", $content);
        //  {MY_GROUP_LIST}
        $content = str_replace("{MY_GROUP_LIST}", $this->getMyCompiledGroupList(), $content);
        $view = new View;
        $view->pageBuilder(null, $content, $contentTitle);
    }

    // Gets Compiled Group List for Current User
    /*
    public function getMyCompiledGroupList(): string
    {
        $group = new Group(null, null, null, null, null, null);
        $myGroups = $group->getMyGroups();
        $compiledGroupList = "";
        $optionCode =  file_get_contents('../src/View/backend/htmlcomponents/option/html_component_option.html');
        foreach ($myGroups as $group) {
            $compiledGroupList .=  $optionCode;
            $compiledGroupList = str_replace("{CONTENT}", "#" . $group['id'] . " - " . $group['group_name'], $compiledGroupList);
        }
        return $compiledGroupList;
    }
    */

    // Gets Compiled Shared Group List for Current User
    // TODO
    public function getSharedCompiledGroupList()
    {
    }

    public function createTicketFunction()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["Title"]) and isset($_POST["Description"]) and isset($_POST["Requester"]) and isset($_POST["Group"])) {
            $TicketModel = new TicketModel();
            $TicketModel->createNewTicket();
            header('Location: ../index.php?action=tickets');
        }
    }

    /*
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
    */
}
