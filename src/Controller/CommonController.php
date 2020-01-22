<?php

declare(strict_types=1);

namespace App\Controller;

use App\View\View;

class commonController
{

    public function login()
    {
        $noSessionTargetPage = file_get_contents('../src/View/frontend/pagecontent/login.html');
        $view = new View;
        $view->pageBuilder($noSessionTargetPage, null, null);
       
    }

    public function register()
    {
        $noSessionTargetPage = file_get_contents('../src/View/frontend/pagecontent/register.html');
        $view = new View;
        $view->pageBuilder($noSessionTargetPage, null, null);
        echo $view;
    }


}
