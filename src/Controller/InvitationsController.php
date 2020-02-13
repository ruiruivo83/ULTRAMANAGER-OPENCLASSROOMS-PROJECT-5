<?php

declare(strict_types=1);

namespace App\Controller;

use App\View\View;
use App\Model\InvitationModel;

class InvitationsController
{

    private $view;
    private $invitationModel;

    public function __construct()
    {
        $this->view = new View();
        $this->invitationModel = new InvitationModel();
    }

    public function invitationsPage()
    {
        $invitationsFromMe = $this->invitationModel->getInvitationsFromMe();
        var_dump($invitationsFromMe);
        $this->view->render("invitations", ['invitationsFromMe' => $invitationsFromMe]);
    }

    public function createInvitationFunction()
    {
        if (isset($_GET['groupid']) AND isset($_GET['memberemail'])) {
            $this->invitationModel->createInvitation();
            header('Location: ../index.php?action=invitations');
            exit();
        }
    }


}
