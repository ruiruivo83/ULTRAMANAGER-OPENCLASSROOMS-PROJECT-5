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
        var_dump($_SESSION);
    }

    // NO SESSION
    public function frontPage()
    {
        $noSessionTargetPage = file_get_contents('../templates/frontend/pagecontent/frontpage.html.twig');
        $this->view->pageBuilder($noSessionTargetPage, null, null);
    }

    // WITH SESSION
    // FAIRE AVEC TWIG LE DASHBOARD
    public function dashboard()
    {
        $this->view->render("frontpage", []);
        /*
        $content = file_get_contents('../templates/frontend/frontpage.html.twig');
        $contentTitle = "Dashboard";
        $this->view->pageBuilder(null, $content, $contentTitle);
        */
    }

    public function noLoginFrontPage()
    {
        $this->view->render("noLoginFrontPage", []);
    }

}
