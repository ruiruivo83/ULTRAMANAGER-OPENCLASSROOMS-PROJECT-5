<?php

declare(strict_types=1);

// COMPOSER AUTOLOAD
require '../vendor/autoload.php';

use App\Controller\ActivityLogController;
use App\Controller\AlertsController;
use App\Controller\CommonController;
use App\Controller\FileController;
use App\Controller\GroupsController;
use App\Controller\IndexController;
use App\Controller\InterventionsController;
use App\Controller\InvitationsController;
use App\Controller\MessagesController;
use App\Controller\ProfileController;
use App\Controller\SettingsController;
use App\Controller\TicketsController;
use App\Controller\UserController;
use App\Tools\SuperGlobals;


// ROUTER FOR INDEX PAGE
class Router
{

    private $superGlobals;
    private $indexController;

    private $userController;

    private $groupsController;
    private $ticketsController;
    private $interventionsController;
    private $invitationsController;

    private $commonController;


    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->superGlobals = new SuperGlobals();
        $this->indexController = new IndexController;
        $this->commonController = new CommonController;
        $this->userController = new UserController;

        $this->groupsController = new GroupsController;
        $this->ticketsController = new TicketsController;
        $this->interventionsController = new InterventionsController;
        $this->invitationsController = new InvitationsController;

    }

    // ROUTER MAIN FUNCTION
    public function main()
    {

        if ($this->superGlobals->testIf_IssetGet("action")) {

            // NO SESSION
            if ($this->superGlobals->getGlobal_Get("action") === "login") {
                $this->commonController->loginPage();
            }
            if ($this->superGlobals->getGlobal_Get("action") === "register") {
                $this->commonController->registerPage();
            }

            // GET FUNCTIONS - Must Run first
            $this->getFunction($this->superGlobals->getGlobal_Get("action"));

            // GET PAGES
            $this->getPage($this->superGlobals->getGlobal_Get("action"));

        } else if ($this->superGlobals->testIf_IssetSession("user")) {
            // SESSION OPEN
            $this->indexController->dashboardPage();
        } else {
            // SESSION NOT OPEN
            $this->indexController->noLoginFrontPage();
        }
    }

    public function getFunction($functionName)
    {

        ////////////////////////////////////////////////////////////////////
        ////////////////////// ROUTER FUNCTIONS ////////////////////////////
        ////////////////////////////////////////////////////////////////////

        // LOGIN VALIDATION FUNCTION
        if ($functionName === 'login_validation') {
            $this->userController->loginValidationFunction();
        }

        // REGISTER NEW USER FUNCTION
        if ($functionName === 'registernewuser') {
            $this->userController->registerNewUserFunction();
        }

        if ($this->superGlobals->testIf_IssetSession("user")) {

            // LOGOUT FUNCTION
            if ($functionName === "logout") {
                $this->userController->logout();
            }

            // GROUPS FUNCTIONS
            if ($functionName === 'creategroupfunction') {
                $this->groupsController->createGroupFunction();
            }
            if ($functionName === 'modifygroupfunction') {
                $this->groupsController->modifyGroupFunction();
            }
            // - close group will add a ticket with author, date and time.
            if ($functionName === 'closegroupfunction') {
                $this->groupsController->closeGroupFunction();
            }

            // TICKETS FUNCTIONS
            if ($functionName === 'createticketfunction') {
                $this->ticketsController->createTicketFunction();
            }
            if ($functionName === 'modifyticketfunction') {
                $this->ticketsController->modifyTicketFunction();
            }
            if ($functionName === 'closeticketfunction') {
                $this->ticketsController->closeTicketFunction();
            }

            // INTERVENTIONS FUNCTIONS -- CANNOT MODIFY NOR CLOSE
            if ($functionName === 'createinterventionfunction') {
                $this->interventionsController->createInterventionFunction();
            }

            // INVITATIONS FUNCTIONS
            if ($functionName === 'createinvitationfunction') {
                $this->invitationsController->createInvitationFunction();
            }
            if ($functionName === 'acceptinvitationfunction') {
                $this->invitationsController->acceptInvitationFunction();
            }
            if ($functionName === 'deleteinvitationfunction') {
                $this->invitationsController->deleteInvitationFunction();
            }

            // MEMBERS FUNCTIONS
            if ($functionName === 'removememberfromgroupfunction') {
                $this->groupsController->removeMemberFromGroupFunction();
            }

        }
    }

    public function getPage($pageName)
    {
        if ($this->superGlobals->getGlobal_Get("action") === $pageName) {
            if ($this->superGlobals->testIf_IssetSession(("user"))) {

                ////////////////////////////////////////////////////////////////////
                ////////////////////////// ROUTER PAGES ////////////////////////////
                ////////////////////////////////////////////////////////////////////

                // MAIN
                if ($pageName === "index") {
                    $this->indexController->dashboardPage();
                }

                // USER
                if ($pageName === "activityLog") {
                    $this->activityLogController->activityLogPage();
                }
                if ($pageName === "profile") {
                    $this->profileController->profilePage();
                }
                if ($pageName === "settings") {
                    $this->settingsController->settingsPage();
                }
                if ($pageName === "sharedTickets") {
                    $this->ticketsController->sharedTicketsPage();
                }
                if ($pageName === "searchuser") {
                    $this->userController->searchUserResultsPage();
                }

                // GROUPS
                if ($pageName === "creategroup") {
                    $this->groupsController->createGroupPage();
                }
                if ($pageName === "mygroups") {
                    $this->groupsController->myGroupsPage();
                }
                if ($pageName === "sharedgroups") {
                    $this->groupsController->sharedGroupsPage();
                }
                if ($pageName === "groupdetails") {
                    $this->groupsController->groupDetailsPage();
                }
                if ($pageName === "groupmembers") {
                    $this->groupsController->groupMembersPage();
                }
                if ($pageName === "globalgroups") {
                    $this->groupsController->globalGroupsPage();
                }

                // TICKETS
                if ($pageName === "createticket") {
                    $this->ticketsController->createTicketPage();
                }
                if ($pageName === "mytickets") {
                    $this->ticketsController->myTicketsPage();
                }
                if ($pageName === "sharedtickets") {
                    $this->ticketsController->sharedTicketsPage();
                }
                if ($pageName === "globaltickets") {
                    $this->ticketsController->globalTicketsPage();
                }
                if ($pageName === "ticketdetails") {
                    $this->ticketsController->ticketDetailsPage();
                }



                // INTERVENTIONS
                if ($pageName === "createintervention") {
                    $this->interventionsController->createInterventionPage();
                }
                if ($pageName === "myinterventions") {
                    $this->interventionsController->myInterventionsPage();
                }
                if ($pageName === "sharedinterventions") {
                    $this->interventionsController->sharedInterventionsPage();
                }
                if ($pageName === "globalinterventions") {
                    $this->interventionsController->globalInterventionsPage();
                }
                if ($pageName === "interventiondetails") {
                    $this->interventionsController->interventionDetailsPage();
                }


                // MEMBERS
                if ($pageName === "sharedgroupmembers") {
                    $this->groupsController->sharedGroupMembersPage();
                }
                // TODO
                if ($pageName === "mymemberdetails") {
                    $this->groupsController->myMemberDetailsPage();
                }
                if ($pageName === "sharedmemberdetails") {
                    $this->groupsController->sharedMemberDetailsPage();
                }

                // INVITATIONS
                if ($pageName === "invitations") {
                    $this->invitationsController->invitationsPage();
                }

            } else {
                // IF SESSION IS NOT OPEN
                header('Location: ../index.php');
                exit();
            }
        }
    }

}


$router = new Router;
$router->main();
