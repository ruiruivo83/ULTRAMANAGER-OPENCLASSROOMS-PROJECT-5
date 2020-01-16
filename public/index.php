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

        // FOR TEST
        /*
        if (isset($_SESSION["user"])) {
            echo ("SESSION IS OPEN");
            die;
        } else {
            echo ("SESSION IS CLOSED");
            die;
        }
        */

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
                    $indexController->dashboard();
                } else {
                    header('Location: ../index.php');
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

            // GROUPMEMBERS PAGE
            if ($_GET['action'] == 'groupmembers') {
                if (isset($_SESSION["user"])) {
                    $groupsController->groupmembers();
                } else {
                    header('Location: ../index.php');
                }
            }

            // SHARED GROUPS PAGE
            if ($_GET['action'] == 'sharedgroups') {
                if (isset($_SESSION["user"])) {
                    $groupsController->sharedgroups();
                } else {
                    header('Location: ../index.php');
                }
            }

            // SHARED GROUP MEMBERS PAGE
            if ($_GET['action'] == 'sharedgroupmembers') {
                if (isset($_SESSION["user"])) {
                    $groupsController->sharedgroupmembers();
                } else {
                    header('Location: ../index.php');
                }
            }

            // MEMBER DETAILS PAGE
            if ($_GET['action'] == 'memberdetails') {
                if (isset($_SESSION["user"])) {
                    $groupsController->memberdetails();
                } else {
                    header('Location: ../index.php');
                }
            }

            // SHARED MEMBER DETAILS PAGE
            if ($_GET['action'] == 'sharedmemberdetails') {
                if (isset($_SESSION["user"])) {
                    $groupsController->sharedmemberdetails();
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
                    $ticketsController->ticketdetails();
                } else {
                    header('Location: ../index.php');
                }
            }

            // SHARED TICKETS PAGE
            if ($_GET['action'] == 'sharedtickets') {
                if (isset($_SESSION["user"])) {
                    $ticketsController->sharedtickets();
                } else {
                    header('Location: ../index.php');
                }
            }

            // SHARED TICKET DETAILS PAGE
            if ($_GET['action'] == 'sharedticketdetails') {
                if (isset($_SESSION["user"])) {
                    $ticketsController->sharedticketdetails();
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
                    $interventionsController->interventiondetails();
                } else {
                    header('Location: ../index.php');
                }
            }

            // SHARED INTERVENTIONS PAGE
            if ($_GET['action'] == 'sharedinterventions') {
                if (isset($_SESSION["user"])) {
                    $interventionsController->sharedinterventions();
                } else {
                    header('Location: ../index.php');
                }
            }

            // SHARED INTERVENTION DETAILS PAGE
            if ($_GET['action'] == 'sharedinterventiondetails') {
                if (isset($_SESSION["user"])) {
                    $interventionsController->sharedinterventiondetails();
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
                    $groupsController->globalgroups();
                } else {
                    header('Location: ../index.php');
                }
            }

            // GLOBAL TICKETS PAGE
            if ($_GET['action'] == 'globaltickets') {
                if (isset($_SESSION["user"])) {
                    $ticketsController->globaltickets();
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
            if ($_GET['action'] == 'creategroupgunction') {
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
            $indexController->frontPage();
        }
    }
}


$router = new Router;
$router->main();
