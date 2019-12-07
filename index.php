<!-- ////////////////////////// -->
<!-- ///////// ROUTER ///////// -->
<!-- ////////////////////////// -->

<?php

// IMPORT CONTROLLERS
require 'controller/pagesController.php';
require 'controller/userController.php';
require 'controller/uploadController.php';

// ??? require 'controller/contentController/MyTicketsController.php';
require 'controller/contentController/MyGroupsController.php';

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
        $myGroupsController = new MyGroupsController();
        $uploadController = new UploadController();

        if (isset($_GET['action'])) {
            //////////////////////////////////////////////////////////////////
            //////////////////////// ROUTER PAGES ////////////////////////////
            //////////////////////////////////////////////////////////////////

            // ACCUEIL PAGE
            if ($_GET['action'] == 'index') {
                $pagesController->Index();
            }

            // MY OPEN GROUPS PAGE
            if ($_GET['action'] == 'myopengroups') {
                if (isset($_SESSION["user"])) {
                    $pagesController->MyOpenGroups();
                } else {
                    header('Location: ../index.php');
                }
            }

            // MY CLOSED GROUPS PAGE
            if ($_GET['action'] == 'myclosedgroups') {
                if (isset($_SESSION["user"])) {
                    $pagesController->MyClosedGroups();
                } else {
                    header('Location: ../index.php');
                }
            }

            // LIST GROUP MEMBERS PAGE
            if ($_GET['action'] == 'groupmembers') {
                if ($_GET['group_name'] != null) {
                    if (isset($_SESSION["user"])) {
                        $GroupName = $_GET['group_name'];
                        $pagesController->listMembersForSpecificGroup($GroupName);
                    } else {
                        header('Location: ../index.php');
                    }
                }
            }

            // NEW MEMBER PAGE
            if ($_GET['action'] == 'newmember') {
                if (isset($_SESSION["user"])) {
                    $pagesController->NewMember();
                } else {
                    header('Location: ../index.php');
                }
            }

            // SHARED OPEN GROUPS PAGE
            if ($_GET['action'] == 'sharedopengroups') {
                if (isset($_SESSION["user"])) {
                    $pagesController->SharedOpenGroups();
                } else {
                    header('Location: ../index.php');
                }
            }

            // Shared Closed Groups PAGE
            if ($_GET['action'] == 'sharedclosedgroups') {
                if (isset($_SESSION["user"])) {
                    $pagesController->SharedClosedGroups();
                } else {
                    header('Location: ../index.php');
                }
            }

            // Shared Open Tickets PAGE
            if ($_GET['action'] == 'sharedtickets') {
                if (isset($_SESSION["user"])) {
                    $pagesController->SharedTickets();
                } else {
                    header('Location: ../index.php');
                }
            }

            // Shared Closed Tickets PAGE
            if ($_GET['action'] == 'sharedclosedtickets') {
                if (isset($_SESSION["user"])) {
                    $pagesController->sharedclosedtickets();
                } else {
                    header('Location: ../index.php');
                }
            }

            // TICKET DETAILS PAGE
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

            // MY ACTIVE TICKETS PAGE
            if ($_GET['action'] == 'myactivetickets') {
                if (isset($_SESSION["user"])) {
                    $pagesController->MyActiveTickets();
                } else {
                    header('Location: ../index.php');
                }
            }

            // MY CLOSED TICKETS PAGE
            if ($_GET['action'] == 'myclosedtickets') {
                if (isset($_SESSION["user"])) {
                    $pagesController->MyClosedTickets();
                } else {
                    header('Location: ../index.php');
                }
            }

            // NEW TICKET PAGE
            if ($_GET['action'] == 'newticket') {
                if (isset($_SESSION["user"])) {
                    $pagesController->NewTicket();
                } else {
                    header('Location: ../index.php');
                }
            }

            // NEW SHARED TICKET            
            if ($_GET['action'] == 'newsharedticket') {
                if (isset($_SESSION["user"])) {
                    $pagesController->NewSharedTicket();
                } else {
                    header('Location: ../index.php');
                }
            }

            // NEW GROUP PAGE
            if ($_GET['action'] == 'newgroup') {
                if (isset($_SESSION["user"])) {
                    $pagesController->NewGroup();
                } else {
                    header('Location: ../index.php');
                }
            }

            // User Profile PAGE
            if ($_GET['action'] == 'userprofile') {
                if (isset($_SESSION["user"])) {
                    $pagesController->UserProfile();
                } else {
                    header('Location: ../index.php');
                }
            }

            // User Settings PAGE
            if ($_GET['action'] == 'usersettings') {
                if (isset($_SESSION["user"])) {
                    $pagesController->UserSettings();
                } else {
                    header('Location: ../index.php');
                }
            }

            // User Activity Log PAGE
            if ($_GET['action'] == 'useractivitylog') {
                if (isset($_SESSION["user"])) {
                    $pagesController->UserActivityLog();
                } else {
                    header('Location: ../index.php');
                }
            }

            // LOGIN PAGE
            if ($_GET['action'] == 'login') {
                $pagesController->login();
            }

            // REGISTER PAGE
            if ($_GET['action'] == 'register') {
                $pagesController->register();
            }

            // LIST INVITATIONS PAGE
            if ($_GET['action'] == 'listinvitations') {
                if (isset($_SESSION["user"])) {
                    $pagesController->listInvitations();
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
            if ($_GET['action'] == 'login_validation') {
                $userController->loginValidation();
            }

            // REGISTER NEW USER FUNCTION
            if ($_GET['action'] == 'registernewuser') {
                $userController->registerNewUser();
            }

            // SEARCH USER NEW MEMBER         
            if ($_GET['action'] == 'searchusernewmember') {
                $userController->searchUserNewMember();
            }

            // ADD TICKET FUNCTION
            if ($_GET['action'] == 'addTicket') {
                if (isset($_SESSION["user"])) {
                    $myTicketsController->addTicket();
                } else {
                    header('Location: ../index.php');
                }
            }

            // ADD GROUPE FUNCTION
            if ($_GET['action'] == 'addGroup') {
                if (isset($_SESSION["user"])) {
                    $myGroupsController->addGroup();
                } else {
                    header('Location: ../index.php');
                }
            }

            // CLOSE GROUP FUNCTION
            if ($_GET['action'] == 'closegroup') {
                if ($_GET['group_id'] != null) {
                    if (isset($_SESSION["user"])) {
                        $groupid = $_GET['group_id'];
                        $myGroupsController->closeGroup($groupid);
                    } else {
                        header('Location: ../index.php');
                    }
                }
            }


            // CLOSE TICKET FUNCTION
            if ($_GET['action'] == 'closeticket') {
                if ($_GET['ticket_id'] != null) {
                    if (isset($_SESSION["user"])) {
                        $ticketid = $_GET['ticket_id'];
                        $myTicketsController->closeTicket($ticketid);
                    } else {
                        header('Location: ../index.php');
                    }
                }
            }

            // FILE UPLOAD TO TICKET FUNCTION
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

            // ADD TICKET INTERVENTION FUNCTION
            if ($_GET['action'] == 'addTicketIntervention') {
                if (isset($_SESSION["user"])) {
                    $string = null;
                    $myTicketsController->addTicketIntervention($string);
                } else {
                    header('Location: ../index.php');
                }
            }

            // SEND INVITATION FUNCTION
            if ($_GET['action'] == 'registerInvitation') {
                if (isset($_SESSION["user"])) {
                    $UserEmail = $_POST["email"];
                    $GroupName = $_POST["group_name"];

                    $userController->registerInvitation($UserEmail, $GroupName);
                } else {
                    header('Location: ../index.php');
                }
            }

            // DELETE MY INVITATION
            // deletemyinvitation
            if ($_GET['action'] == 'deletemyinvitation') {
                if ($_GET['invitationid'] != null) {
                    if (isset($_SESSION["user"])) {
                        $invitationId = $_GET['invitationid'];
                        $userController->deleteMyInvitation($invitationId);
                    } else {
                        header('Location: ../index.php');
                    }
                }
            }

            // DELETE RECEIVED INVITATION
            if ($_GET['action'] == 'deletereceivedinvitation') {
                if ($_GET['invitationid'] != null) {
                    if (isset($_SESSION["user"])) {
                        $invitationId = $_GET['invitationid'];
                        $userController->deleteReceivedInvitation($invitationId);
                    } else {
                        header('Location: ../index.php');
                    }
                }
            }

            // ACCEPT INVITATION
            // acceptinvitation
            if ($_GET['action'] == 'acceptinvitation') {
                if ($_GET['invitationid'] != null) {
                    if (isset($_SESSION["user"])) {
                        $invitationId = $_GET['invitationid'];
                        $userController->acceptInvitation($invitationId);
                    } else {
                        header('Location: ../index.php');
                    }
                }
            }

            // removememberfromgroup
            if ($_GET['action'] == 'removememberfromgroup') {
               
                if ($_GET['groupid'] != null) {
                   
                    if ($_GET['member'] != null) {
                   
                        if (isset($_SESSION["user"])) {                         
                            $GroupId = $_GET['groupid'];
                            $MemberEmail = $_GET['member'];
                            $userController->RemoveMemberFromGroup($GroupId, $MemberEmail);
                        } else {
                            header('Location: ../index.php');
                        }
                    }
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
