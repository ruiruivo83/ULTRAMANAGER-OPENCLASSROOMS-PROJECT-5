<?php

declare(strict_types=1);

namespace App\Controller;

use App\View\View;

class IndexController
{
    private $view;

    public function __construct()
    {
        $this->view = new View();
    }

    // NO SESSION
    public function frontPage()
    {
        $noSessionTargetPage = file_get_contents('../templates/frontend/pagecontent/frontpage.html');
        $this->view->pageBuilder($noSessionTargetPage, null, null);
    }

    // WITH SESSION
    // FAIRE AVEC TWIG LE DASHBOARD
    public function dashboard()
    {
        $content = file_get_contents('../src/View/frontend/pagecontent/noLoginFrontPage.html.twig');
        $contentTitle = "Dashboard";
        $this->view->pageBuilder(null, $content, $contentTitle);
    }

    public function noLoginFrontPage()
    {
        $this->view->render("noLoginFrontPage", []);
    }

}
