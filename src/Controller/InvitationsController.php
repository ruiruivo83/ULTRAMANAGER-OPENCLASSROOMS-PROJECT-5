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

        // $invitationsForMe = $this->invitationModel->getInvitationsForMe();
        var_dump($invitationsFromMe);
        // var_dump($invitationsForMe);
        // REMOVE UNDERSCORES FROM KEYS

        $this->view->render("invitations", ['invitationsisent' => $invitationsFromMe]);
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
