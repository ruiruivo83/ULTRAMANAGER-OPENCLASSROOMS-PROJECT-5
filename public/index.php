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
                $commonController->loginPage();
            }

            // REGISTER PAGE
            if ($_GET['action'] == 'register') {
                $commonController->registerPage();
            }

            // INDEX PAGE
            if ($_GET['action'] == 'index') {

                if (isset($_SESSION["user"])) {
                    // IF SESSION IS OPEN
                    $indexController->dashboardPage();
                } else {
                    // IF SESSION IS NOT OPEN
                    $indexController->noLoginFrontPagePage();
                }
            }

            // ACTIVITY LOG PAGE
            if ($_GET['action'] == 'activitylog') {
                if (isset($_SESSION["user"])) {
                    $activityLogController->activityLogPage();
                } else {
                    // TODO
                    header('Location: ../index.php');
                    exit();
                }
            }

            // PROFILE PAGE
            if ($_GET['action'] == 'profile') {
                if (isset($_SESSION["user"])) {
                    $profileController->profilePage();
                } else {
                    header('Location: ../index.php');
                    exit();
                }
            }

            // SETTINGS PAGE
            if ($_GET['action'] == 'settings') {
                if (isset($_SESSION["user"])) {
                    $settingsController->settingsPage();
                } else {
                    header('Location: ../index.php');
                    exit();
                }
            }

            // MY GROUPS PAGE
            if ($_GET['action'] == 'mygroups') {
                if (isset($_SESSION["user"])) {
                    $groupsController->myGroupsPage();
                } else {
                    header('Location: ../index.php');
                    exit();
                }
            }

            // GROUP DETAILS PAGE
            if ($_GET['action'] == 'groupdetails') {
                if (isset($_SESSION["user"])) {
                    $groupsController->groupDetailsPage();
                } else {
                    header('Location: ../index.php');
                    exit();
                }
            }

            // GROUPMEMBERS PAGE
            if ($_GET['action'] == 'groupmembers') {
                if (isset($_SESSION["user"])) {
                    $groupsController->groupMembersPage();
                } else {
                    header('Location: ../index.php');
                    exit();
                }
            }



            // SHARED GROUPS PAGE
            if ($_GET['action'] == 'sharedgroups') {
                if (isset($_SESSION["user"])) {
                    $groupsController->sharedGroupsPage();
                } else {
                    header('Location: ../index.php');
                    exit();
                }
            }

            // SHARED TICKETS PAGE
            if ($_GET['action'] == 'sharedtickets') {
                if (isset($_SESSION["user"])) {
                    $ticketsController->sharedTicketsPage();
                } else {
                    header('Location: ../index.php');
                    exit();
                }
            }

            // SHARED GROUP MEMBERS PAGE
            if ($_GET['action'] == 'sharedgroupmembers') {
                if (isset($_SESSION["user"])) {
                    $groupsController->sharedGroupMembersPage();
                } else {
                    header('Location: ../index.php');
                    exit();
                }
            }

            // MEMBER DETAILS PAGE
            if ($_GET['action'] == 'mymemberdetails') {
                if (isset($_SESSION["user"])) {
                    $groupsController->myMemberDetails();
                } else {
                    header('Location: ../index.php');
                    exit();
                }
            }

            // SHARED MEMBER DETAILS PAGE
            if ($_GET['action'] == 'sharedmemberdetails') {
                if (isset($_SESSION["user"])) {
                    $groupsController->sharedMemberDetailsPage();
                } else {
                    header('Location: ../index.php');
                    exit();
                }
            }

            // TICKETS PAGE
            if ($_GET['action'] == 'tickets') {
                if (isset($_SESSION["user"])) {
                    $ticketsController->ticketsPage();
                } else {
                    header('Location: ../index.php');
                    exit();
                }
            }

            // TICKET DETAILS PAGE
            if ($_GET['action'] == 'ticketdetails') {
                if (isset($_SESSION["user"])) {
                    $ticketsController->ticketDetailsPage();
                } else {
                    header('Location: ../index.php');
                    exit();
                }
            }

            // SHARED TICKETS PAGE
            if ($_GET['action'] == 'sharedtickets') {
                if (isset($_SESSION["user"])) {
                    $ticketsController->sharedTicketsPage
                    ();
                } else {
                    header('Location: ../index.php');
                    exit();
                }
            }

            // SHARED TICKET DETAILS PAGE
            if ($_GET['action'] == 'sharedticketdetails') {
                if (isset($_SESSION["user"])) {
                    $ticketsController->sharedTicketDetailsPage();
                } else {
                    header('Location: ../index.php');
                    exit();
                }
            }

            // INTERVENTIONS PAGE
            if ($_GET['action'] == 'interventions') {
                if (isset($_SESSION["user"])) {
                    $interventionsController->myInterventionsPage();
                } else {
                    header('Location: ../index.php');
                    exit();
                }
            }

            // INTERVENTION DETAILS PAGE
            if ($_GET['action'] == 'interventiondetails') {
                if (isset($_SESSION["user"])) {
                    $interventionsController->interventionDetailsPage();
                } else {
                    header('Location: ../index.php');
                    exit();
                }
            }

            // SHARED INTERVENTIONS PAGE
            if ($_GET['action'] == 'sharedinterventions') {
                if (isset($_SESSION["user"])) {
                    $interventionsController->sharedInterventionsPage();
                } else {
                    header('Location: ../index.php');
                    exit();
                }
            }

            // SHARED INTERVENTION DETAILS PAGE
            if ($_GET['action'] == 'sharedinterventiondetails') {
                if (isset($_SESSION["user"])) {
                    $interventionsController->sharedInterventionDetailsPage();
                } else {
                    header('Location: ../index.php');
                    exit();
                }
            }

            // INVITATIONS PAGE
            if ($_GET['action'] == 'invitations') {
                if (isset($_SESSION["user"])) {
                    $invitationsController->invitationsPage();
                } else {
                    header('Location: ../index.php');
                    exit();
                }
            }

            // SHOW ALL ALERTS PAGE
            if ($_GET['action'] == 'showallalerts') {
                if (isset($_SESSION["user"])) {
                    $alertsController->showAllAlertsPage();
                } else {
                    header('Location: ../index.php');
                    exit();
                }
            }

            // SHOW ALL MESSAGES PAGE
            if ($_GET['action'] == 'showallmessages') {
                if (isset($_SESSION["user"])) {
                    $messagesController->showAllMessagesPage();
                } else {
                    header('Location: ../index.php');
                    exit();
                }
            }

            // GLOBAL GROUPS PAGE
            if ($_GET['action'] == 'globalgroups') {
                if (isset($_SESSION["user"])) {
                    $groupsController->globalGroupsPage();
                } else {
                    header('Location: ../index.php');
                    exit();
                }
            }

            // GLOBAL TICKETS PAGE
            if ($_GET['action'] == 'globaltickets') {
                if (isset($_SESSION["user"])) {
                    $ticketsController->globalTicketsPage();
                } else {
                    header('Location: ../index.php');
                    exit();
                }
            }

            // GLOBAL INTERVENTIONS PAGE
            if ($_GET['action'] == 'globalinterventions') {
                if (isset($_SESSION["user"])) {
                    $interventionsController->globalInterventionsPage();
                } else {
                    header('Location: ../index.php');
                    exit();
                }
            }

            // CREATE GROUP PAGE             
            if ($_GET['action'] == 'creategroup') {
                if (isset($_SESSION["user"])) {
                    $groupsController->createGroupPage();
                } else {
                    header('Location: ../index.php');
                    exit();
                }
            }

            // CREATE TICKET PAGE             
            if ($_GET['action'] == 'createticket') {
                if (isset($_SESSION["user"])) {
                    $ticketsController->createTicketPage();
                } else {
                    header('Location: ../index.php');
                    exit();
                }
            }

            // CREATE INTERVENTION PAGE             
            if ($_GET['action'] == 'createintervention') {
                if (isset($_SESSION["user"])) {
                    $interventionsController->createInterventionPage();
                } else {
                    header('Location: ../index.php');
                    exit();
                }
            }

            // SEARCH RESULTS PAGE
            if ($_GET['action'] == 'searchuser') {
                if (isset($_SESSION["user"])) {
                    $userController->searchUserResultsPage();
                } else {
                    header('Location: ../index.php');
                    exit();
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
                    exit();
                }
            }

            // LOGIN VALIDATION FUNCTION
            if (!isset($_SESSION["user"])) {
                if ($_GET['action'] == 'login_validation') {
                    $userController->loginValidationFunction();
                }
            }

            // REGISTER NEW USER FUNCTION
            if (!isset($_SESSION["user"])) {
                if ($_GET['action'] == 'registernewuser') {
                    $userController->registerNewUserFunction();
                }
            }

            // CREATE GROUP FUNCTION
            if ($_GET['action'] == 'creategroupfunction') {
                if (isset($_SESSION["user"])) {
                    $groupsController->createGroupFunction();
                } else {
                    header('Location: ../index.php');
                    exit();
                }
            }

            // CREATE TICKET FUNCTION
            if ($_GET['action'] == 'createticketfunction') {
                if (isset($_SESSION["user"])) {
                    $ticketsController->createTicketFunction();
                } else {
                    header('Location: ../index.php');
                    exit();
                }
            }

            // CREATE TICKET FUNCTION
            if ($_GET['action'] == 'createinterventionfunction') {
                if (isset($_SESSION["user"])) {
                    $interventionsController->createInterventionFunction();
                } else {
                    header('Location: ../index.php');
                    exit();
                }
            }

            // CREATE INVITATION FUNCTION
            if ($_GET['action'] == 'createinvitationfunction') {
                if (isset($_SESSION["user"])) {
                    $invitationsController->createInvitationFunction();
                } else {
                    header('Location: ../index.php');
                    exit();
                }
            }

            // DELETE INVITATION FUNCTION
            if ($_GET['action'] == 'deleteinvitationfunction') {
                if (isset($_SESSION["user"])) {
                    $invitationsController->deleteInvitationFunction();
                } else {
                    header('Location: ../index.php');
                    exit();
                }
            }

            // ACCEPT INVITATION FUNCTION
            if ($_GET['action'] == 'acceptinvitationfunction') {
                if (isset($_SESSION["user"])) {
                    $invitationsController->acceptInvitationFunction();
                } else {
                    header('Location: ../index.php');
                    exit();
                }
            }

            // ACCEPT INVITATION FUNCTION
            if ($_GET['action'] == 'removememberfromgroupfunction') {
                if (isset($_SESSION["user"])) {
                    $groupsController->removeMemberFromGroupFunction();
                } else {
                    header('Location: ../index.php');
                    exit();
                }
            }







        } else if (isset($_SESSION["user"])) {
            $indexController->dashboardPage();
        } else {
            // IF SESSION IS NOT OPEN
            $indexController->noLoginFrontPage();
        }
    }
}


$router = new Router;
$router->main();
