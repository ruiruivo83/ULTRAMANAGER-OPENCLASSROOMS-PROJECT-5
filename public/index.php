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


// ROUTER FOR INDEX PAGE
class Router
{

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // ROUTER MAIN FUNCTION
    public function main()
    {
        $indexController = new IndexController;
        $commonController = new CommonController;
        $userController = new UserController;
        $profileController = new ProfileController;
        $activityLogController = new activityLogController;
        $settingsController = new SettingsController;
        $groupsController = new GroupsController;
        $ticketsController = new TicketsController;
        $interventionsController = new InterventionsController;
        $invitationsController = new InvitationsController;
        $alertsController = new AlertsController;
        $messagesController = new MessagesController;

        if (isset($_GET['action'])) {

            // LOGIN PAGE
            if ($_GET['action'] == 'login') {
                $commonController->login();
            }

            // REGISTER PAGE
            if ($_GET['action'] == 'register') {
                $commonController->register();
            }

            // INDEX PAGE
            if ($_GET['action'] == 'index') {
                if (isset($_SESSION["user"])) {
                    // IF SESSION IS OPEN
                    $indexController->dashboard();
                } else {
                    // IF SESSION IS NOT OPEN
                    $indexController->noLoginFrontPage();
                }
            }

            // ACTIVITY LOG PAGE
            if ($_GET['action'] == 'activitylog') {
                if (isset($_SESSION["user"])) {
                    $activityLogController->activityLog();
                } else {
                    // TODO
                    header('Location: ../index.php');
                }
            }

            // PROFILE PAGE
            if ($_GET['action'] == 'profile') {
                if (isset($_SESSION["user"])) {
                    $profileController->profile();
                } else {
                    header('Location: ../index.php');
                }
            }

            // SETTINGS PAGE
            if ($_GET['action'] == 'settings') {
                if (isset($_SESSION["user"])) {
                    $settingsController->settings();
                } else {
                    header('Location: ../index.php');
                }
            }

            // GROUPS PAGE
            if ($_GET['action'] == 'groups') {
                if (isset($_SESSION["user"])) {
                    $groupsController->groups();
                } else {
                    header('Location: ../index.php');
                }
            }

            // GROUP DETAILS PAGE
            if ($_GET['action'] == 'groupdetails') {
                if (isset($_SESSION["user"])) {
                    $groupsController->groupDetails();
                } else {
                    header('Location: ../index.php');
                }
            }

            // GROUPMEMBERS PAGE
            if ($_GET['action'] == 'groupmembers') {
                if (isset($_SESSION["user"])) {
                    $groupsController->groupMembers();
                } else {
                    header('Location: ../index.php');
                }
            }

            // SHARED GROUPS PAGE
            if ($_GET['action'] == 'sharedgroups') {
                if (isset($_SESSION["user"])) {
                    $groupsController->sharedGroups();
                } else {
                    header('Location: ../index.php');
                }
            }

            // SHARED GROUP MEMBERS PAGE
            if ($_GET['action'] == 'sharedgroupmembers') {
                if (isset($_SESSION["user"])) {
                    $groupsController->sharedGroupMembers();
                } else {
                    header('Location: ../index.php');
                }
            }

            // MEMBER DETAILS PAGE
            if ($_GET['action'] == 'memberdetails') {
                if (isset($_SESSION["user"])) {
                    $groupsController->memberDetails();
                } else {
                    header('Location: ../index.php');
                }
            }

            // SHARED MEMBER DETAILS PAGE
            if ($_GET['action'] == 'sharedmemberdetails') {
                if (isset($_SESSION["user"])) {
                    $groupsController->sharedMemberDetails();
                } else {
                    header('Location: ../index.php');
                }
            }

            // TICKETS PAGE
            if ($_GET['action'] == 'tickets') {
                if (isset($_SESSION["user"])) {
                    $ticketsController->tickets();
                } else {
                    header('Location: ../index.php');
                }
            }

            // TICKET DETAILS PAGE
            if ($_GET['action'] == 'ticketdetails') {
                if (isset($_SESSION["user"])) {
                    $ticketsController->ticketDetails();
                } else {
                    header('Location: ../index.php');
                }
            }

            // SHARED TICKETS PAGE
            if ($_GET['action'] == 'sharedtickets') {
                if (isset($_SESSION["user"])) {
                    $ticketsController->sharedTickets();
                } else {
                    header('Location: ../index.php');
                }
            }

            // SHARED TICKET DETAILS PAGE
            if ($_GET['action'] == 'sharedticketdetails') {
                if (isset($_SESSION["user"])) {
                    $ticketsController->sharedTicketDetails();
                } else {
                    header('Location: ../index.php');
                }
            }

            // INTERVENTIONS PAGE
            if ($_GET['action'] == 'interventions') {
                if (isset($_SESSION["user"])) {
                    $interventionsController->interventions();
                } else {
                    header('Location: ../index.php');
                }
            }

            // INTERVENTION DETAILS PAGE
            if ($_GET['action'] == 'interventiondetails') {
                if (isset($_SESSION["user"])) {
                    $interventionsController->interventionDetails();
                } else {
                    header('Location: ../index.php');
                }
            }

            // SHARED INTERVENTIONS PAGE
            if ($_GET['action'] == 'sharedinterventions') {
                if (isset($_SESSION["user"])) {
                    $interventionsController->sharedInterventions();
                } else {
                    header('Location: ../index.php');
                }
            }

            // SHARED INTERVENTION DETAILS PAGE
            if ($_GET['action'] == 'sharedinterventiondetails') {
                if (isset($_SESSION["user"])) {
                    $interventionsController->sharedInterventionDetails();
                } else {
                    header('Location: ../index.php');
                }
            }

            // INVITATIONS
            if ($_GET['action'] == 'invitations') {
                if (isset($_SESSION["user"])) {
                    $invitationsController->invitations();
                } else {
                    header('Location: ../index.php');
                }
            }

            // SHOW ALL ALERTS
            if ($_GET['action'] == 'showallalerts') {
                if (isset($_SESSION["user"])) {
                    $alertsController->showAllAlerts();
                } else {
                    header('Location: ../index.php');
                }
            }

            // SHOW ALL MESSAGES
            if ($_GET['action'] == 'showallmessages') {
                if (isset($_SESSION["user"])) {
                    $messagesController->showAllMessages();
                } else {
                    header('Location: ../index.php');
                }
            }

            // GLOBAL GROUPS PAGE
            if ($_GET['action'] == 'globalgroups') {
                if (isset($_SESSION["user"])) {
                    $groupsController->globalGroups();
                } else {
                    header('Location: ../index.php');
                }
            }

            // GLOBAL TICKETS PAGE
            if ($_GET['action'] == 'globaltickets') {
                if (isset($_SESSION["user"])) {
                    $ticketsController->globalTickets();
                } else {
                    header('Location: ../index.php');
                }
            }

            // GLOBAL INTERVENTIONS PAGE
            if ($_GET['action'] == 'globalinterventions') {
                if (isset($_SESSION["user"])) {
                    $interventionsController->globalInterventions();
                } else {
                    header('Location: ../index.php');
                }
            }

            // CREATE GROUP PAGE             
            if ($_GET['action'] == 'creategroup') {
                if (isset($_SESSION["user"])) {
                    $groupsController->displayCreateGroupPage();
                } else {
                    header('Location: ../index.php');
                }
            }

            // CREATE TICKET PAGE             
            if ($_GET['action'] == 'createticket') {
                if (isset($_SESSION["user"])) {
                    $ticketsController->displayCreateTicketPage();
                } else {
                    header('Location: ../index.php');
                }
            }

            // CREATE INTERVENTION PAGE             
            if ($_GET['action'] == 'createintervention') {
                if (isset($_SESSION["user"])) {
                    $interventionsController->displayCreateInterventionsPage();
                } else {
                    header('Location: ../index.php');
                }
            }


            ////////////////////////////////////////////////////////////////////
            ////////////////////// ROUTER FUNCTIONS ////////////////////////////
            ////////////////////////////////////////////////////////////////////

            // LOGOUT FUNCTION
            if ($_GET['action'] == 'logout') {
                if (isset($_SESSION["user"])) {
                    $userController->logout();
                } else {
                    header('Location: ../index.php');
                }
            }

            // LOGIN VALIDATION FUNCTION
            if (!isset($_SESSION["user"])) {
                if ($_GET['action'] == 'login_validation') {
                    $userController->loginValidation();
                }
            }

            // REGISTER NEW USER FUNCTION
            if (!isset($_SESSION["user"])) {
                if ($_GET['action'] == 'registernewuser') {
                    $userController->registerNewUser();
                }
            }


            // createGroupFunction FUNCTION
            if ($_GET['action'] == 'creategroupfunction') {
                if (isset($_SESSION["user"])) {

                    $groupsController->createGroupFunction();
                } else {
                    header('Location: ../index.php');
                }
            }

            // createTicketFunction FUNCTION
            if ($_GET['action'] == 'createticketfunction') {
                if (isset($_SESSION["user"])) {
                    $ticketsController->createTicketFunction();
                } else {
                    header('Location: ../index.php');
                }
            }
        } else  if (isset($_SESSION["user"])) {
            $indexController->dashboard();
        } else {
            // IF SESSION IS NOT OPEN
            $indexController->noLoginFrontPage();
        }
    }
}


$router = new Router;
$router->main();
