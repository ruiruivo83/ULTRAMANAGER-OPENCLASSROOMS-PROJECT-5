<?php

declare(strict_types=1);

namespace App\Controller;

use App\View\View;
use App\Model\UserModel;
use App\Model\InvitationModel;

class InvitationsController
{

    private $view;
    private $invitationModel;
    private $userModel;

    public function __construct()
    {
        $this->view = new View();
        $this->invitationModel = new InvitationModel();
        $this->userModel = new UserModel();
    }

    public function invitationsPage()
    {
        $invitationsFromMe = $this->invitationModel->getInvitationsFromMe();
        $invitationsForMe = $this->invitationModel->getInvitationsForMe();
        $this->view->render("invitations", ['invitationsFromMe' => $invitationsFromMe, 'invitationsForMe' => $invitationsForMe]);
    }

    public function createInvitationFunction()
    {
        if (isset($_GET['groupid']) AND isset($_GET['memberemail'])) {

            // get User Id with Email
            $user = $this->userModel->getUserByEmail($_GET['memberemail']);
            $userEmail = "";
            foreach ($user as $key) {
                $userEmail = $key->getEmail();
            }

            // TEST IF USER IS ALREADY A MEMBER
            $groupId = intval($_GET['groupid']);
            if ($this->invitationModel->getUserCount($groupId, $userEmail) == 0) {
                $this->invitationModel->createInvitation();
                header('Location: ../index.php?action=groupmembers&groupid=' . $_GET['groupid']);
                exit();
            }
            header('Location: ../index.php?action=invitations');
            exit();
        }
        header('Location: ../index.php');
        exit();
    }

    public function deleteInvitationFunction()
    {
        if (isset($_GET['invitationid'])) {
            $this->invitationModel->deleteInvitation();
            header('Location: ../index.php?action=invitations');
            exit();
        }
        header('Location: ../index.php');
        exit();
    }

    public function acceptInvitationFunction()
    {
        if (isset($_GET['invitationid']) AND isset($_GET['groupid']) AND isset($_GET['useremail'])) {

            $user = $this->userModel->getUserByEmail($_GET['useremail']);
            foreach ($user as $key) {
                $this->invitationModel->acceptInvitation(intval($key->getId()));
            }
            header('Location: ../index.php?action=invitations');
            exit();
        }
        header('Location: ../index.php');
        exit();
    }


}
