<?php

declare(strict_types=1);

namespace App\Controller;

class AlertsController
{

    public function showAllAlertsPage()
    {

        $contentTitle = "Alert Center";
        // TODO
        $content = "";
        $commonController = new CommonController();
        $view = $commonController->pageBuilder(null, $content, $contentTitle);

        echo $view;

    }
}
