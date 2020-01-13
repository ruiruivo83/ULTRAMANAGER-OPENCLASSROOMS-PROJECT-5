<?php

class MessagesController
{

    public function showAllMessages()
    {
        $contentTitle = "Message Center";
        // TODO
        $content = "";
        $commonController = new CommonController();
        $view = $commonController->pageBuilder(null, $content, $contentTitle);

        echo $view;
    }

}
