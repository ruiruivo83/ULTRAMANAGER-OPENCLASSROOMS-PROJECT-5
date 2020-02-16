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

    public function dashboardPage()
    {
        $this->view->render("frontpage", []);
    }

    public function noLoginFrontPage()
    {
        $this->view->render("noLoginFrontPage", []);
    }

}
