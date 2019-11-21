<?php

require 'model/Tickets.php';

class MyTicketsController
{

    // ADD NEW TICKET TO DATABASE
    public function addTicket()
    {
        if (isset($_SESSION['user'])) {
            // if (isset($_SESSION['user']) && $_SESSION["user"]->isAdmin()) {
            if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["Title"]) and isset($_POST["Description"]) and isset($_POST["Requester"])) {

                $Title = $_POST["Title"];
                $Description = $_POST["Description"];
                $Author = $_SESSION['user']->getEmail();
                $Requester = $_POST["Requester"];

                // INSERT INTO DATABASE
                // Create class instance

                $Tickets = new Tickets(null, null, null, null, null);
                // Execute method addTicket
                $Tickets->addTicket($Title, $Description, $Author, $Requester);
                //
                header('Location: ../index.php?action=myactivetickets');
                exit();
            }
            // }
        }
    }

    // CLOSE TICKET
    public function closeTicket($ticketid)
    {
        $Tickets = new Tickets(null, null, null, null, null);

        $this->addTicketIntervention($ticketid);
        $Tickets->closeTicket($ticketid);
        header('Location: ../index.php?action=myactivetickets');
    }

    public function addTicketIntervention($CloseTicketId)
    {
        if ($CloseTicketId != null) {
            if (isset($_SESSION['user'])) {
                $Intervention_Description = "CLOSED TICKET";
                $Ticket_id = $CloseTicketId;
                // $Author = $_POST["author"];
                // var_dump($Intervention_Description, $Ticket_id);
                $Tickets = new Tickets(null, null, null, null, null);
                $Tickets->addTicketIntervention($Ticket_id, $Intervention_Description, $_SESSION['user']->getEmail());

            }
        } else {
            if (isset($_SESSION['user'])) {
                $Intervention_Description = $_POST["intervention_description"];
                if ($Intervention_Description != "") {
                    $Ticket_id = $_POST["ticket_id"];
                    // $Author = $_POST["author"];
                    // var_dump($Intervention_Description, $Ticket_id);
                    $Tickets = new Tickets(null, null, null, null, null);
                    $Tickets->addTicketIntervention($Ticket_id, $Intervention_Description, $_SESSION['user']->getEmail());
                    header('Location: ../index.php?action=myactivetickets');
                    exit();
                } else {
                    header('Location: ../index.php?action=myactivetickets');
                }
            }
        }
    }

    // REPLACE TICKET LIST AREA IN THE HTML BY ALL AVAILABLE POSTS
    public function ReplaceTicketList($view, $status)
    {

        $ticket_list_final_code = null;
        $Author = $_SESSION['user']->getEmail();
        if (isset($_SESSION['user'])) {
            $ticket = new Tickets(null, null, null, null, null);
            $result = $ticket->getMyTickets($status); // FROM MODEL

            foreach ($result as $current_result) {
                $current_ticket = null;
                if ($status == "open") {
                    $current_ticket = file_get_contents('view/backend/ticket_list_default_code.html');
                } else {

                    $current_ticket = file_get_contents('view/backend/closed_ticket_list_default_code.html');
                }

                $current_ticket = str_replace("{TICKET_ID}", $current_result["id"], $current_ticket, $count);
                $current_ticket = str_replace("{REQUESTER_NAME}", $current_result["requester"], $current_ticket, $count);
                
                $current_ticket = str_replace("{TICKET_DESCRIPTION}", $current_result["description"], $current_ticket);
                $current_ticket = str_replace("{TICKET_TITLE}", $current_result["title"], $current_ticket);
                $current_ticket = str_replace("{INTERVENTION_CARD}", $this->ReplaceInterventionList($current_result["id"], null), $current_ticket);
                $current_ticket = str_replace("{LAST_INTERVENTION}", $this->ReplaceInterventionList($current_result["id"], 1), $current_ticket);
                $current_ticket = str_replace("{CURRENT_USER_EMAIL}", $Author, $current_ticket);
                $ticket_list_final_code .= $current_ticket;
            }
            $view = str_replace("{TICKET_LIST}", $ticket_list_final_code, $view);
        }

        return $view;
    }


    // ADD NEW TICKET TO DATABASE
    public function addPrivateTicket()
    {
        if (isset($_SESSION['user'])) {
            if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["Title"]) and isset($_POST["Description"]) and isset($_POST["Requester"])) {
                $Title = $_POST["Title"];
                $Description = $_POST["Description"];
                $Author = $_SESSION['user']->getEmail();
                $Requester = $_POST["Requester"];
                // INSERT INTO DATABASE
                // Create class instance
                $Tickets = new Tickets(null, null, null, null, null);
                // Execute method addTicket
                $Tickets->addTicket($Title, $Description, $Author, $Requester);
                header('Location: ../index.php');
                exit();
            }
        }
    }


    public function addPrivateTicketIntervention()
    {
        if (isset($_SESSION['user'])) {
            $Intervention_Description = $_POST["intervention_description"];
            $Ticket_id = $_POST["ticket_id"];
            // $Author = $_POST["author"];
            // var_dump($Intervention_Description, $Ticket_id);
            $Tickets = new Tickets(null, null, null, null, null);
            $Tickets->addTicketIntervention($Ticket_id, $Intervention_Description, $_SESSION['user']->getEmail());
            header('Location: ../index.php');
            exit();
        }
    }


    // REPLACE INTERVENTION LIST AREA IN THE HTML BY ALL AVAILABLE INTERVENTIONS FOR SPECIFIC TICKET
    public function ReplaceInterventionList($Ticket_id, $maxCicles)
    {
        if ($maxCicles == null) {
            $intervention_list_final_code = null;
            if (isset($_SESSION['user'])) {
                $Intervention = new Tickets(null, null, null, null, null);
                $result = $Intervention->getTicketInterventions($Ticket_id); // FROM MODEL
                foreach ($result as $current_result) {
                    $current_intervention = null;
                    $current_intervention = file_get_contents('view/backend/intervention_list_default_code.html');
                    $current_intervention = str_replace("{INTERVENTION_ID}", $current_result["id"], $current_intervention, $count);
                    $current_intervention = str_replace("{INTERVENTION_DESCRIPTION}", $current_result["intervention_description"], $current_intervention);
                    $current_intervention = str_replace("{INTERVENTION_DATE}", $current_result["intervention_date"], $current_intervention);
                    $current_intervention = str_replace("{INTERVENTION_AUTHOR_COUNTRY}", $current_result["intervention_author_country"], $current_intervention);
                    $current_intervention = str_replace("{INTERVENTION_AUTHOR_COMPANY}", $current_result["intervention_author_company"], $current_intervention);
                    $current_intervention = str_replace("{INTERVENTION_AUTHOR}", $current_result["intervention_author"], $current_intervention);
                    $intervention_list_final_code .= $current_intervention;
                }
            }
            return $intervention_list_final_code;
        }
        if ($maxCicles == 1) {
            $intervention_list_final_code = null;
            if (isset($_SESSION['user'])) {
                $Intervention = new Tickets(null, null, null, null, null);
                $result = $Intervention->getTicketInterventions($Ticket_id); // FROM MODEL
                foreach ($result as $current_result) {
                    $current_intervention = null;
                    $current_intervention = file_get_contents('view/backend/intervention_list_default_code.html');
                    $current_intervention = str_replace("{INTERVENTION_ID}", $current_result["id"], $current_intervention, $count);
                    $current_intervention = str_replace("{INTERVENTION_DESCRIPTION}", $current_result["intervention_description"], $current_intervention);
                    $current_intervention = str_replace("{INTERVENTION_DATE}", $current_result["intervention_date"], $current_intervention);
                    $current_intervention = str_replace("{INTERVENTION_AUTHOR_COUNTRY}", $current_result["intervention_author_country"], $current_intervention);
                    $current_intervention = str_replace("{INTERVENTION_AUTHOR_COMPANY}", $current_result["intervention_author_company"], $current_intervention);

                    $current_intervention = str_replace("{INTERVENTION_AUTHOR}", $current_result["intervention_author"], $current_intervention);
                    $intervention_list_final_code .= $current_intervention;
                    break; // ONLY THE LAST INTERVENTION
                }
            }
            return $intervention_list_final_code;
        }
    }
}
