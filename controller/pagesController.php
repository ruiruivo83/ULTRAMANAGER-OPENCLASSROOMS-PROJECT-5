<?php

require 'controller/sessionTestController.php';
require 'controller/contentController/MyTicketsController.php';
// require 'controller/contentController/MyGroupsController.php';

require 'model/Invitations.php';



class pagesController
{

    // PAGE - INDEX Graphics PAGE
    public function Index()
    {
        $view = file_get_contents('view/frontend/_layout.html');
        if (isset($_SESSION["user"])) {
            $view = $this->SessionTestForUserMenu($view);
            $view = $this->ReplaceContent($view, "index");
            $view = $this->ReplaceTotals($view);
        } else {
            $view = $this->SessionTestForUserMenu($view);
            $view = $this->ReplaceContent($view, "demo_index");
            $view = $this->ReplaceTotals($view);
        }
        echo $view;
    }

    // PAGE - My Active Tickets Page
    public function MyOpenGroups()
    {        
        $view = file_get_contents('view/frontend/_layout.html');
        $view = $this->SessionTestForUserMenu($view);
        $view = $this->ReplaceContent($view, "myopengroups");
        $status = "open";
        $myGroupsController = new MyGroupsController;
        $view = $myGroupsController->ReplaceGroupList($view, $status);
        $view = $this->ReplaceTotals($view);
        echo $view;
    }

    // PAGE - My Active Tickets Page
    public function MyClosedGroups()
    {
        $view = file_get_contents('view/frontend/_layout.html');
        $view = $this->SessionTestForUserMenu($view);
        $view = $this->ReplaceContent($view, "myclosedgroups");
        $status = "close";
        $myGroupsController = new MyGroupsController;
        $view = $myGroupsController->ReplaceGroupList($view, $status);
        $view = $this->ReplaceTotals($view);
        echo $view;
    }

    // PAGE - NEW MEMBER
    public function NewMember()
    {
        $view = file_get_contents('view/frontend/_layout.html');
        $view = $this->SessionTestForUserMenu($view);
        $view = $this->ReplaceContent($view, "newmember");
        $view = $this->ReplaceTotals($view);
        echo $view;
    }

    // PAGE - NEW MEMBER USER FOUND
    public function newMemberUserFound($email, $GroupName)
    {
        $forGroup = $GroupName;
        $view = file_get_contents('view/frontend/_layout.html');
        $view = $this->SessionTestForUserMenu($view);
        $view = $this->ReplaceContent($view, "newmember");
        $member_list_default_code = file_get_contents('view/backend/new_member_default_code.html');
        $new_member = str_replace("{NEW_MEMBER_EMAIL}", $email,  $member_list_default_code);
        $new_member = str_replace("{GROUP_NAME}", $forGroup,  $new_member);
        $view = str_replace("{NEW_MEMBER_FOUND_DEFAULT_CODE}", $new_member, $view);
        $view = str_replace("{USER_EMAIL}", $email, $view);
        $view = str_replace("{GROUP_NAME}", $GroupName, $view);
        $view = $this->ReplaceTotals($view);
        echo $view;
    }







    // LIST ALL INVITATIONS
    public function listInvitations()
    {
        $view = file_get_contents('view/frontend/_layout.html');
        $view = $this->SessionTestForUserMenu($view);
        $view = $this->ReplaceContent($view, "listinvitations");

        $Result = $this->replaceInvitationsSentList();
      

        $CurrentResult = "";
        $compiledSentListCode = "";
        $compiledReceivedListCode = "";


        foreach ($Result as $CurrentResult) {
            $invitations_sent_list_default_code = file_get_contents('view/backend/invitations_sent_list_default_code.html');

            $invitation_to = $CurrentResult["invitation_to"];
            $invitations_sent_list_default_code = str_replace("{invitation_to}", $invitation_to, $invitations_sent_list_default_code);

            $invitation_date = $CurrentResult["invitation_date"];
            $invitations_sent_list_default_code = str_replace("{invitation_date}", $invitation_date, $invitations_sent_list_default_code);

            $invitation_for_group_name = $CurrentResult["invitation_for_group_name"];
            $invitations_sent_list_default_code = str_replace("{invitation_for_group_name}", $invitation_for_group_name, $invitations_sent_list_default_code);

            $compiledSentListCode .=  $invitations_sent_list_default_code;
        }

        $Result = $this->replaceInvitationsReceivedList();
        foreach ($Result as $CurrentResult) {
            $invitations_sent_list_default_code = file_get_contents('view/backend/invitations_received_list_default_code.html');

            $invitation_to = $CurrentResult["invitation_from"];
            $invitations_sent_list_default_code = str_replace("{invitation_from}", $invitation_to, $invitations_sent_list_default_code);

            $invitation_date = $CurrentResult["invitation_date"];
            $invitations_sent_list_default_code = str_replace("{invitation_date}", $invitation_date, $invitations_sent_list_default_code);

            $invitation_for_group_name = $CurrentResult["invitation_for_group_name"];
            $invitations_sent_list_default_code = str_replace("{invitation_for_group_name}", $invitation_for_group_name, $invitations_sent_list_default_code);

            $compiledReceivedListCode .=  $invitations_sent_list_default_code;
        }
        $view = str_replace("{INVITATIONS_SENT_LIST}", $compiledSentListCode, $view);
        $view = str_replace("{INVITATIONS_RECEIVED_LIST}", $compiledReceivedListCode, $view);
        $view = $this->ReplaceTotals($view);
        echo $view;
    }

    // Builds list for Invitations Sent
    public function replaceInvitationsSentList()
    {
        $result = "";
        // GET invitations obj
        $Invitations = new Invitations;
        $Result = $Invitations->getSentInvitationsFromDB();
        return $Result;
    }

    // Builds list for Invitations Received
    public function replaceInvitationsReceivedList()
    {
        $result = "";
        // GET invitations obj
        $Invitations = new Invitations;
        $Result = $Invitations->getReceivedInvitationsFromDB();
        return $Result;
    }























    public function listMembersForSpecificGroup($GroupName)
    {
        $view = file_get_contents('view/frontend/_layout.html');
        $view = $this->SessionTestForUserMenu($view);
        $view = $this->ReplaceContent($view, "listmembersforgroup");
        $view = str_replace("{GROUP_NAME}", $GroupName, $view);
        $view = $this->ReplaceTotals($view);
        echo $view;
    }

    // PAGE - Shared Open Groups Page
    public function SharedOpenGroups()
    {
        $view = file_get_contents('view/frontend/_layout.html');
        $view = $this->SessionTestForUserMenu($view);
        $view = $this->ReplaceContent($view, "sharedopengroups");
        $view = $this->ReplaceTotals($view);
        echo $view;
    }

    // PAGE - Chared Closed Groups Page
    public function SharedClosedGroups()
    {
        $view = file_get_contents('view/frontend/_layout.html');
        $view = $this->SessionTestForUserMenu($view);
        $view = $this->ReplaceContent($view, "sharedclosedgroups");
        $view = $this->ReplaceTotals($view);
        echo $view;
    }

    // PAGE - Shared Open Tickets Page
    public function SharedOpenTickets()
    {

        $view = file_get_contents('view/frontend/_layout.html');
        $view = $this->SessionTestForUserMenu($view);
        $view = $this->ReplaceContent($view, "sharedopentickets");
        $view = $this->ReplaceTotals($view);
        echo $view;
    }

    // PAGE - Chared Closed Tickets Page
    public function SharedClosedTickets()
    {
        $view = file_get_contents('view/frontend/_layout.html');
        $view = $this->SessionTestForUserMenu($view);
        $view = $this->ReplaceContent($view, "sharedclosedtickets");
        $view = $this->ReplaceTotals($view);
        echo $view;
    }

    // PAGE - My Active Tickets Page
    public function MyActiveTickets()
    {
        $view = file_get_contents('view/frontend/_layout.html');

        $view = $this->SessionTestForUserMenu($view);
        $view = $this->ReplaceContent($view, "myactivetickets");
        $view = $this->ReplaceTotals($view);
        $status = "open";
        $myTicketsController = new MyTicketsController;
        $view = $myTicketsController->ReplaceTicketList($view, $status);
        echo $view;
    }

    // PAGE - My Active Tickets Page
    public function MyClosedTickets()
    {
        $view = file_get_contents('view/frontend/_layout.html');
        $view = $this->SessionTestForUserMenu($view);
        $view = $this->ReplaceContent($view, "myclosedtickets");
        $view = $this->ReplaceTotals($view);
        $status = "close";
        $myTicketsController = new MyTicketsController;
        $view = $myTicketsController->ReplaceTicketList($view, $status);
        echo $view;
    }

    // PAGE - Ticket Details
    public function TicketDetails($ticketid)
    {
        $view = file_get_contents('view/frontend/_layout.html');
        $view = $this->SessionTestForUserMenu($view);
        $view = $this->ReplaceContent($view, "ticketdetails");
        $MyTicketsControllert = new MyTicketsController();
        $view = str_replace("{INTERVENTION_LIST}", $MyTicketsControllert->ReplaceInterventionList($ticketid, null), $view);
        $view = $this->ReplaceTotals($view);
        // $myTicketsController = new MyTicketsController;
        // $view = $myTicketsController->ReplaceTicketList($view);
        echo $view;
    }

    // PAGE NEW TICKET
    public function NewTicket()
    {
        $view = file_get_contents('view/frontend/_layout.html');
        $view = $this->SessionTestForUserMenu($view);
        $view = $this->ReplaceContent($view, "newticket");
        $MyTicketsControllert = new MyTicketsController();
        $view = $MyTicketsControllert->ReplaceGroupListOptions($view);
        $view = $this->ReplaceTotals($view);
        echo $view;
    }

    // PAGE NEW TICKET
    public function NewGroup()
    {
        $view = file_get_contents('view/frontend/_layout.html');
        $view = $this->SessionTestForUserMenu($view);
        $view = $this->ReplaceContent($view, "newgroup");
        $view = $this->ReplaceTotals($view);
        echo $view;
    }

    // PAGE - User Profile Page
    public function UserProfile()
    {
        $view = file_get_contents('view/frontend/_layout.html');
        $view = $this->SessionTestForUserMenu($view);
        $view = $this->ReplaceContent($view, "userprofile");
        $view = $this->ReplaceTotals($view);
        $user = new User(null, null, null, null, null, null, null);
        $PhotoName = $user->getPhotoIfExist($_SESSION['user']->getId());
        if (strlen($PhotoName[0]) != 0) {
            $PhotoCode = file_get_contents('view/backend/profile_photo_code.html');
            $view = str_replace("{USER_PHOTO}", $PhotoCode, $view);
            $view = str_replace("{PHOTO_NAME}", $PhotoName[0], $view);
            echo $view;
        } else {
            $PhotoCode = file_get_contents('view/backend/profile_no_photo_code.html');
            $view = str_replace("{USER_PHOTO}", $PhotoCode, $view);
            echo $view;
        }
    }

    // PAGE - User Settings Page
    public function UserSettings()
    {
        $view = file_get_contents('view/frontend/_layout.html');
        $view = $this->SessionTestForUserMenu($view);
        $view = $this->ReplaceContent($view, "usersettings");
        $view = $this->ReplaceTotals($view);
        echo $view;
    }

    // PAGE - User Settings Page
    public function UserActivityLog()
    {
        $view = file_get_contents('view/frontend/_layout.html');
        $view = $this->SessionTestForUserMenu($view);
        $view = $this->ReplaceContent($view, "useractivitylog");
        $view = $this->ReplaceTotals($view);
        echo $view;
    }

    // PAGE - LOGIN
    public function login()
    {
        $view = file_get_contents('view/frontend/_layout.html');
        $view = $this->SessionTestForUserMenu($view);
        $view = $this->ReplaceContent($view, "login");
        $view = $this->ReplaceTotals($view);
        echo $view;
    }

    // PAGE - REGISTER
    public function register()
    {
        $view = file_get_contents('view/frontend/_layout.html');
        $view = $this->SessionTestForUserMenu($view);
        $view = $this->ReplaceContent($view, "register");
        $view = $this->ReplaceTotals($view);
        echo $view;
    }

    //
    //
    // TEST FOR SESSION
    public function SessionTestForUserMenu($view)
    {
        $sessionTestController = new SessionTestController;
        $view = $sessionTestController->replaceMenuIfSessionIsOpen($view);
        return $view;
    }

    // REPLACE CONTENT
    public function ReplaceContent($view, $pagetoopen)
    {
        $view = str_replace("{CONTENT}", file_get_contents('view/frontend/' . $pagetoopen . '.html'), $view);
        return $view;
    }

    // REPLACE INDEX CARDS
    public function ReplaceTotals($view)
    {
        // IF SESSION IS OPEN - REPLACE WITH REAL CONTENT
        if (isset($_SESSION["user"])) {
            $ticket = new Tickets(null, null, null, null, null);
            $status = "open";
            $result = $ticket->getMyTickets($status); // FROM MODEL
            $view = str_replace("{TOTAL_TICKETS_CARD_DEFAULT_CODE}", file_get_contents('view/backend/total_tickets_card_default_code.html'), $view);
            $view = str_replace("{TOTAL_TICKETS_OPEN}", count($result), $view);
        } else {
            $view = str_replace("{TOTAL_TICKETS_CARD_DEFAULT_CODE}", file_get_contents('view/backend/DEMO_total_tickets_card_default_code.html'), $view);
            $view = str_replace("{TOTAL_TICKETS_OPEN}", "14", $view);
        }
        // IF SESSION IS NOT OPEN - REPLACE WITH DEMO CONTENT
        return $view;
    }
}
