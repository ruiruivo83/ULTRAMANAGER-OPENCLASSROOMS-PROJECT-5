<?php

class indexController
{

    // WITH SESSION
    public function dashboard()
    {
        $content = file_get_contents('view/frontend/pagecontent/dashboard.html');
        $contentTitle = "Dashboard";
        $commonController = new CommonController();
        $view = $commonController->pageBuilder(null, $content, $contentTitle);
        echo $view;
    }

    // NO SESSION
    public function frontPage()
    {
        $noSessionTargetPage = file_get_contents('view/frontend/pagecontent/frontpage.html');
        $commonController = new CommonController();
        $view = $commonController->pageBuilder($noSessionTargetPage, null, null);
        echo $view;
    }
}
