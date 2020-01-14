<?php
namespace App\Controller;
class SettingsController
{
    public function settings()
    {
        $contentTitle = "Settings";
        // TODO
        $content = "";
        $commonController = new CommonController();
        $view = $commonController->pageBuilder(null, $content, $contentTitle);
        echo $view;
    }
}
