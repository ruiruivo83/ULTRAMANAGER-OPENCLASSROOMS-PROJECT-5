<?php

// require "controller/sessionTestController.php";
require "model/user.php";

class userController
{
    // LOGIN VALIDATION FOR THE MAIN LOGIN
    public function loginValidation()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["email"])) {
            // GET LOGIN INFO FROM USER POST METHOD
            $login_email = $_POST["email"];
            $login_password = $_POST["password"];
            if ($this->testIfEmailExists($login_email)) {
                $user = User::findByEmail($login_email);
                if ($user != null && password_verify($login_password, $user->getPsw())) {   // IF PASSWORD IS OK
                    //// IMPORTANT
                    //// CREATION DE LA SESSION USER AVEC LES DONNEES EN BD DE L'UTILISATEUR   
                    $_SESSION['user'] = $user;
                    header('Location: ../index.php');
                } else {
                    $message = file_get_contents('view/backend/mot_de_pass_est_incorrect.html');
                    $view = file_get_contents('view/frontend/_layout.html');
                    $view = str_replace("{CONTENT}", file_get_contents('view/frontend/login.html'), $view);
                    $view = str_replace("<!--{MESSAGEALERT}-->", $message, $view);
                    $sessionTestController = new sessionTestController;
                    $view = $sessionTestController->replaceMenuIfSessionIsOpen($view);
                    echo $view;
                }
                exit();
            } else {
                $message = file_get_contents('view/backend/mail_non_reconu.html');
                $view = file_get_contents('view/frontend/_layout.html');
                $view = str_replace("{CONTENT}", file_get_contents('view/frontend/login.html'), $view);
                $view = str_replace("<!--{MESSAGEALERT}-->", $message, $view);
                $sessionController = new sessionTestController;
                $view = $sessionController->replaceMenuIfSessionIsOpen($view);
                echo $view;
            }
        }
    }

    // TEST IF MAIL EXISTS IN THE DATABASE
    public function testIfEmailExists($email)
    {
        $user = new User(null, null, $email, null, null, null, null);
        $emailCount = $user->getEmailCount();
        if ($emailCount == 0) {
            $result = false;
            return $result;
        } else {
            $result = true;
            return $result;
        }
    }

    // REGISTER A NEW USER
    public function registerNewUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["email"])) {
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $email = $_POST["email"];
            $Country = $_POST["country"];
            $psw = password_hash($_POST["psw"], PASSWORD_DEFAULT);
            $user = new User(null, $psw, $email, $lastname, $firstname, $Country, null);
            // Test if email exists in database
            if ($this->testIfEmailExists($email)) {
                $message = '<div class="alert alert-danger" role="alert">CE MAIL EST EXISTANT</div>';
                $view = file_get_contents('view/frontend/_layout.html');
                $view = str_replace("{CONTENT}", file_get_contents('view/frontend/register.html'), $view);
                $view = str_replace("<!--{MESSAGEALERT}-->", $message, $view);
                $sessionTestController = new sessionTestController;
                $view = $sessionTestController->replaceMenuIfSessionIsOpen($view);

                echo $view;
            } else {
                // Add User to Database
                $user->addUser();
                header('Location: ../index.php');
            }
        }
    }

    // SEARCH USER for NEW
    public function searchUserNewMember()
    {
        $GroupName = $_POST["GroupName"];

        $User = new User(null, null, null, null, null, null, null);
        $Result = $User->SearchUser();
        $email = null;

        foreach ($Result as $current_result) {
            $email = $current_result["email"];
        }

        if ($email != null) {
            $PagesController = new pagesController;
            $PagesController->newMemberUserFound($email, $GroupName);
        } else {
            var_dump("NO RESULT"); // PAGE TO INVITE USER TO REGISTER TO THE PLATFORM
            die;
        }
    }

    // SEND AND REGISTER INVITATION
    public function registerInvitation($UserEmail, $GroupName)
    {
        // Get GROM current user Session
        $FromUser = $_SESSION['user']->getEmail();
        // Get TO user email
        $ToUser = $UserEmail;
        // Get FOR group
        $InGroup = $GroupName;
        $User = new User(null, null, null, null, null, null, null);
        if ($User->verifyIfUserIsAlreadyInvitedToThisGroup($ToUser, $InGroup) == null) {
            $User->registerInvitation($FromUser, $ToUser, $InGroup);
        }
        header('Location: ../index.php?action=groupmembers&group_name=' . $GroupName);
    }

    // MAIN LOGOUT
    public function logout()
    {
        session_destroy();
        header('Location: ../index.php');
    }

    // DELETE MY OWN INVITATION ID
    public function deleteMyInvitation($invitationId)
    {
        // Check Author - IF OK
        // DELETE INVITATION
        $Invitations = new Invitations;
        $Result = $Invitations->getInvitationAuthor($invitationId);

        foreach ($Result as $currentResult) {
            $invitationAuthor = $currentResult["invitation_from"];
        }
        if ($_SESSION['user']->getEmail() == $invitationAuthor) {
            $Invitations->deleteInvitation($invitationId);
            header('Location: ../index.php?action=listinvitations');
        } else {
            header('Location: ../index.php?action=listinvitations');
        }
    }



    // DELETE RECEIVED INVITATION    
    public function deleteReceivedInvitation($invitationId)
    {
        // Check Author - IF OK
        // DELETE INVITATION
        $Invitations = new Invitations;
        $Result = $Invitations->getInvitationDestinator($invitationId);

        foreach ($Result as $currentResult) {
            $invitationDestinator = $currentResult["invitation_to"];
        }
        if ($_SESSION['user']->getEmail() == $invitationDestinator) {
            $Invitations->deleteInvitation($invitationId);
            header('Location: ../index.php?action=listinvitations');
        } else {
            header('Location: ../index.php?action=listinvitations');
        }
    }

    // ACCEPT INVITATION
    public function acceptInvitation($invitationId)
    {
        $Invitations = new Invitations;
        $Result = $Invitations->getInvitationDestinator($invitationId);
        $invitationDestinator = "";
        foreach ($Result as $currentResult) {
            $invitationDestinator = $currentResult["invitation_to"];
        }

        // GET group name from invitation id
        $Result = $Invitations->getGroupName($invitationId);
        $GroupName = "";
        foreach ($Result as $currentResult) {
            $GroupName = $currentResult["invitation_for_group_name"];
        }

        // GET group id with group name
        $Result = $Invitations->getGroupID($GroupName);
        $GroupID = "";
        foreach ($Result as $currentResult) {
            $GroupID = $currentResult["id"];
        }

        // GET TOTAL COUNT FOR THIS Destinator in the group
        $Groups = new Groups(null, null, null, null);
        $Result = $Groups->GetDestinatorTotalCountsInGroup($GroupID,  $invitationDestinator);
        if ($Result == 0) {
            $Invitations->InsertDestinatorToGroup($GroupID,  $invitationDestinator);
            $Invitations->deleteInvitation($invitationId);
            header("Location: ../index.php?action=listinvitations");
        } else {
            $Invitations->deleteInvitation($invitationId);
            header("Location: ../index.php?action=listinvitations");
        }
        header("Location: ../index.php?action=listinvitations");
    }

    // REMOVE MEMBER FROM GROUP
    public function RemoveMemberFromGroup($GroupId, $MemberEmail)
    {
       $Groups = new Groups(null, null, null,null);
       $Groups->RemoveMemberFromGroup($GroupId, $MemberEmail);
       header('Location: ../index.php?action=myopengroups');
     }
}
