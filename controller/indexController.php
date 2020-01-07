<?php

class indexController
{

    // WITH SESSION
    public function dashboard()
    {
        $targetPage = "dashboard";
        $commonController = new CommonController();
        $view = $commonController->pageBuilder($targetPage);
        echo $view;
    }

    // NO SESSION
    public function frontPage()
    {
        $targetPage = "frontPage";
        $commonController = new CommonController();
        $view = $commonController->pageBuilder($targetPage);
        echo $view;
    }
}
