<?php

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
