<?php

declare(strict_types=1);

namespace App\Controller;

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
