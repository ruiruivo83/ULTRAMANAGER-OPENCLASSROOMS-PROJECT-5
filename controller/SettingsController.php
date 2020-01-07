<?php

class SettingsController
{

    public function settings()
    {
        $targetPage = "settings";
        $commonController = new CommonController();
        $view = $commonController->pageBuilder($targetPage);
        echo $view;
    }
}
