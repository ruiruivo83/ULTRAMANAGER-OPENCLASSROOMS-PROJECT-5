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
use App\Controller\StatsController;
use App\Tools\SuperGlobals;
use App\Model\UserModel;

// ROUTER FOR INDEX PAGE
class Router
{

    private $superGlobals;
    private $indexController;

    private $userController;
    private $statsController;


    private $groupsController;
    private $ticketsController;
    private $interventionsController;
    private $invitationsController;

    private $commonController;

    private $userModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->superGlobals = new SuperGlobals();
        $this->indexController = new IndexController();
        $this->commonController = new CommonController();
        $this->userController = new UserController();
        $this->userModel = new UserModel();
        $this->groupsController = new GroupsController();
        $this->ticketsController = new TicketsController();
        $this->interventionsController = new InterventionsController();
        $this->invitationsController = new InvitationsController();
        $this->statsController = new StatsController();

        if ($this->superGlobals->ISSET_SESSION("user")) {
            // IF USER EXISTS FOR SESSION OPEN
            if ($this->userModel->getEmailCount($this->superGlobals->_SESSION("user")['email']) == 0) {
                // LOGOUT
                session_destroy();
                header('Location: ../index.php');
                exit();
            }
        }
    }

    // ROUTER MAIN FUNCTION
    public function main()
    {

        if ($this->superGlobals->ISSET_GET("action")) {
            // NO SESSION
            if ($this->superGlobals->_GET("action") === "login") {
                $this->commonController->loginPage();
            }
            if ($this->superGlobals->_GET("action") === "register") {
                $this->commonController->registerPage();
            }
            // GET FUNCTIONS - Must Run first
            $this->getFunction($this->superGlobals->_GET("action"));
            // GET PAGES
            $this->getPage($this->superGlobals->_GET("action"));
        } else if ($this->superGlobals->ISSET_SESSION("user")) {
            // SESSION OPEN
            $this->indexController->dashboardPage();
        } else {
            // SESSION NOT OPEN
            $this->indexController->noLoginFrontPage();
        }
    }

    ////////////////////////////////////////////////////////////////////
    ////////////////////// ROUTER FUNCTIONS ////////////////////////////
    ////////////////////////////////////////////////////////////////////

    public function getFunction($functionName)
    {
        // LOGIN VALIDATION FUNCTION
        if ($functionName === 'login_validation') {
            $this->userController->loginValidationFunction();
        }
        // REGISTER NEW USER FUNCTION
        if ($functionName === 'registernewuser') {
            $this->userController->registerNewUserFunction();
        }
        // IF SESSION IS OPEN
        if ($this->superGlobals->ISSET_SESSION("user")) {
            // USER PROFILE FUNCTION
            if ($functionName === "atachphototouser") {
                $this->userController->addAvatarToUserProfile();
            }
            // SAVE USER PROFILE COUNTRY AND COMPANY FUNCTION
            if ($functionName === "savecompanyandcountryfunction") {
                $this->userController->saveCompanyAndCountryFunction();
            }
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
            // STATS CONTROLLER
            if ($functionName === 'ajaxGetTotalOpenTicketsThisMonthFunction') {
                $this->statsController->ajaxGetTotalOpenTicketsThisMonthFunction();
                exit();
            }
            if ($functionName === 'TotalClosedTicketsThisMonth') {
                $this->statsController->getTotalClosedTicketsThisMonthFunction();
                exit();
            }
            if ($functionName === 'ajaxGetTotalOpenInterventionsThisMonthFunction') {
                $this->statsController->ajaxGetTotalInterventionsThisMonthFunction();
                exit();
            }
        } else {
            // IF SESSION IS NOT OPEN
            header('Location: ../index.php');
            exit();
        }
    }

    ////////////////////////////////////////////////////////////////////
    ////////////////////////// ROUTER PAGES ////////////////////////////
    ////////////////////////////////////////////////////////////////////

    public function getPage($pageName)
    {
        if ($this->superGlobals->_GET("action") === $pageName) {
            if ($this->superGlobals->ISSET_SESSION(("user"))) {
                // MAIN
                if ($pageName === "index") {
                    $this->indexController->dashboardPage();
                }
                // USER
                if ($pageName === "userprofile") {
                    $this->userController->userProfilePage();
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
        } else {
            // IF SESSION IS NOT OPEN
            header('Location: ../index.php');
            exit();
        }
    }
}

$router = new Router;
$router->main();
