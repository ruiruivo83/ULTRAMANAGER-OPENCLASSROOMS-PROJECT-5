<?php

declare(strict_types=1);

namespace App\Controller;

class InvitationsController
{

    public function invitations()
    {
        $contentTitle = "Invitations";
        // TODO
        $content = "";
        $commonController = new CommonController();
        $view = $commonController->pageBuilder(null, $content, $contentTitle);
        echo $view;
    }
}
