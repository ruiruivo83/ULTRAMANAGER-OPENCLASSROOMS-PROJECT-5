<?php

declare(strict_types=1);

namespace App\Controller;

use App\View\View;

class ProfileController
{

    public function profilePage()
    {

        $contentTitle = "Profile";
        // TODO
        $content = "";
        $commonController = new CommonController();
        $view = new View;
        $view->pageBuilder(null, $content, $contentTitle);

        echo $view;
    }
}
