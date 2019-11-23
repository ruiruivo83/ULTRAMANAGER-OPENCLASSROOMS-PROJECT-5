<!-- ////////////////////////// -->
<!-- ///////// ROUTER ///////// -->
<!-- ////////////////////////// -->

<?php

// IMPORT CONTROLLERS
require 'controller/pagesController.php';
require 'controller/userController.php';
require 'controller/uploadController.php';

// CLASS ROUTER {
class Router
{
    public function __construct()
    {
        // SESSION OPEN FOR ALL USERS
        // IMPLEMENT SESSION VERIFICATION
        // STARTS SESSION BEFORE OPENIN HTML PAGE
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // ROUTER MAIN FUNCTION
    public function main()
    {
        // OBJECT INSTANCE CREATION
        $pagesController = new pagesController();
        $userController = new userController();
        $myTicketsController = new MyTicketsController();
        $uploadController = new UploadController();

        if (isset($_GET['action'])) {
            //////////////////////////////////////////////////////////////////
            //////////////////////// ROUTER PAGES ////////////////////////////
            //////////////////////////////////////////////////////////////////

            // ACCUEIL
            if ($_GET['action'] == 'index') {
                $pagesController->Index();
            }

            // TICKET DETAILS
            if ($_GET['action'] == 'ticketdetails') {
                if ($_GET['ticket_id'] != null) {
                    if (isset($_SESSION["user"])) {
                        $ticketid = $_GET['ticket_id'];
                        $pagesController->TicketDetails($ticketid);
                    } else {
                        header('Location: ../index.php');
                    }
                } else {
                    header('Location: ../index.php');
                }
            }

            // MY ACTIVE TICKETS
            if ($_GET['action'] == 'myactivetickets') {
                if (isset($_SESSION["user"])) {
                    $pagesController->MyActiveTickets();
                } else {
                    header('Location: ../index.php');
                }
            }

            // MY CLOSED TICKETS
            if ($_GET['action'] == 'myclosedtickets') {
                if (isset($_SESSION["user"])) {
                    $pagesController->MyClosedTickets();
                } else {
                    header('Location: ../index.php');
                }
            }

            // ACCUEIL
            if ($_GET['action'] == 'newticket') {
                if (isset($_SESSION["user"])) {
                    $pagesController->NewTicket();
                } else {
                    header('Location: ../index.php');
                }
            }

            // User Profile
            if ($_GET['action'] == 'userprofile') {
                if (isset($_SESSION["user"])) {
                    $pagesController->UserProfile();
                } else {
                    header('Location: ../index.php');
                }
            }

            // User Settings
            if ($_GET['action'] == 'usersettings') {
                if (isset($_SESSION["user"])) {
                    $pagesController->UserSettings();
                } else {
                    header('Location: ../index.php');
                }
            }

            // User Activity Log
            if ($_GET['action'] == 'useractivitylog') {
                if (isset($_SESSION["user"])) {
                    $pagesController->UserActivityLog();
                } else {
                    header('Location: ../index.php');
                }
            }

            // LOGIN
            if ($_GET['action'] == 'login') {
                $pagesController->login();
            }

            // REGISTER
            if ($_GET['action'] == 'register') {
                $pagesController->register();
            }

            ////////////////////////////////////////////////////////////////////
            ////////////////////// ROUTER FUNCTIONS ////////////////////////////
            ////////////////////////////////////////////////////////////////////

            // LOGOUT
            if ($_GET['action'] == 'logout') {
                if (isset($_SESSION["user"])) {
                    $userController->logout();
                } else {
                    header('Location: ../index.php');
                }
            }

            // LOGIN VALIDATION
            if ($_GET['action'] == 'login_validation') {
                $userController->loginValidation();
            }

            // PAGE REGISTER NEW USER
            if ($_GET['action'] == 'registernewuser') {
                $userController->registerNewUser();
            }

            // ADD TICKET
            if ($_GET['action'] == 'addTicket') {
                if (isset($_SESSION["user"])) {
                    $myTicketsController->addTicket();
                } else {
                    header('Location: ../index.php');
                }
            }

            // CLOSE TICKET
            if ($_GET['action'] == 'closeticket') {
                if ( $_GET['ticket_id'] != null) {
                    if (isset($_SESSION["user"])) {
                        $ticketid = $_GET['ticket_id'];
                        $myTicketsController->closeTicket($ticketid);
                    } else {
                        header('Location: ../index.php');
                    }
                }               
            }

            // FILE UPLOAD TO TICKET
            if ($_GET['action'] == 'fileupload') {
                if (isset($_SESSION["user"])) {
                    $uploadController->uploadFile();
                } else {
                    header('Location: ../index.php');
                }
            }

            
            if ($_GET['action'] == 'atachphototouser') {
                if (isset($_SESSION["user"])) {
                    $uploadController->atachphototouser();
                } else {
                    header('Location: ../index.php');
                }
            }

            // ADD TICKET INTERVENTION
            if ($_GET['action'] == 'addTicketIntervention') {
                if (isset($_SESSION["user"])) {
                    $string = null;
                    $myTicketsController->addTicketIntervention($string);
                } else {
                    header('Location: ../index.php');
                }
            }
        } else {
            $pagesController->Index();
        }
    }
}


// Main Call
$router = new Router;
$router->main();
