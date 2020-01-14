<?php
namespace App\Controller;
class AlertsController
{

    public function showAllAlerts()
    {

        $contentTitle = "Alert Center";
        // TODO
        $content = "";
        $commonController = new CommonController();
        $view = $commonController->pageBuilder(null, $content, $contentTitle);

        echo $view;

    }
}
