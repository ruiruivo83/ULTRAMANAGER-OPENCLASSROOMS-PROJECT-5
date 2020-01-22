<?php

declare(strict_types=1);

namespace App\Controller;

use App\View\View;

class IndexController
{

    // NO SESSION
    public function frontPage()
    {
        $noSessionTargetPage = file_get_contents('../src/View/frontend/pagecontent/frontpage.html');
        $view = new View;
        $view->pageBuilder($noSessionTargetPage, null, null);
    }

    // WITH SESSION
    public function dashboard()
    {
        $content = file_get_contents('../src/View/frontend/pagecontent/dashboard.html');
        $contentTitle = "Dashboard";
        $view = new View;
        $view->pageBuilder(null, $content, $contentTitle);
    }
}
