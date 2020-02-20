<?php

declare(strict_types=1);

namespace App\Controller;

use App\Tools\SuperGlobals;
use App\View\View;
use App\Model\UserModel;
use App\Model\InvitationModel;

class InvitationsController
{

    private $view;
    private $invitationModel;
    private $userModel;
    private $superGlobals;

    public function __construct()
    {
        $this->view = new View();
        $this->invitationModel = new InvitationModel();
        $this->userModel = new UserModel();
        $this->superGlobals = new SuperGlobals();
    }

    public function invitationsPage()
    {
        $invitationsFromMe = $this->invitationModel->getInvitationsFromMe();
        $invitationsForMe = $this->invitationModel->getInvitationsForMe();
        $this->view->render("invitations", ['invitationsFromMe' => $invitationsFromMe, 'invitationsForMe' => $invitationsForMe]);
    }

    public function createInvitationFunction()
    {
        if ($this->superGlobals->ISSET_GET("groupid") AND $this->superGlobals->ISSET_GET("memberid")) {
            // $user = $this->userModel->getUserByEmail($this->superGlobals->_GET("memberemail"));
            $userId = (int)$this->superGlobals->_GET("memberid");
            $user = $this->userModel->getUserById($userId);

            foreach ($user as $key) {
                $userId = (int)$key->getId();
            }
            $groupId = (int)$this->superGlobals->_GET("groupid");
            if ($this->invitationModel->getUserCount($groupId, $userId) === 0) {
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

        if ($this->superGlobals->ISSET_GET("invitationid") AND $this->superGlobals->ISSET_GET("groupid") AND $this->superGlobals->ISSET_GET("userid")) {
            $user = $this->userModel->getUserById((int)$this->superGlobals->_GET("userid"));
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
