<?php

declare(strict_types=1);

namespace App\Controller;

use App\View\View;

class InvitationsController
{

    public function invitations()
    {
        $contentTitle = "Invitations";
        // TODO
        $content = "";        
        $view = new View;
        $view->pageBuilder(null, $content, $contentTitle);
        echo $view;
    }
}
