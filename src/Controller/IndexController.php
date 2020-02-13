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
        // var_dump($_SESSION);
    }


    // WITH SESSION
    // FAIRE AVEC TWIG LE DASHBOARD
    public function dashboardPage()
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
