<?php

declare(strict_types=1);

namespace App\Controller;

use App\View\View;

class commonController
{
    private $view;

    public function __construct() {
        $this->view = new View();
    }

    public function loginPage()
    {
        $this->view->render("login", []);
    }

    public function registerPage()
    {
        $this->view->render("register", []);
    }
}
