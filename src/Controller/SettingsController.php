<?php

declare(strict_types=1);

namespace App\Controller;

use App\View\View;

class SettingsController
{
    public function settings()
    {
        $contentTitle = "Settings";
        // TODO
        $content = "";
        $commonController = new CommonController();
        $view = new View;
        $view->pageBuilder(null, $content, $contentTitle);
        echo $view;
    }
}
