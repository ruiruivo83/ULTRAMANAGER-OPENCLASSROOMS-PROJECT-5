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
        if ($this->superGlobals->if_IssetGet("groupid") AND $this->superGlobals->if_IssetGet("memberemail")) {
            $user = $this->userModel->getUserByEmail($this->superGlobals->getGlobal_Get("memberemail"));
            $userEmail = "";
            foreach ($user as $key) {
                $userEmail = $key->getEmail();
            }
            $groupId = (int)$this->superGlobals->getGlobal_Get("groupid");
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
        if ($this->superGlobals->if_IssetGet("invitationid") AND $this->superGlobals->if_IssetGet("groupid") AND $this->superGlobals->if_IssetGet("useremail")) {
            $user = $this->userModel->getUserByEmail($this->superGlobals->getGlobal_Get("useremail"));
            foreach ($user as $key) {
                $this->invitationModel->acceptInvitation((int)$key->getId());
            }
            header('Location: ../index.php?action=invitations');
            exit();
        }
        header('Location: ../index.php');
        exit();
    }


}
