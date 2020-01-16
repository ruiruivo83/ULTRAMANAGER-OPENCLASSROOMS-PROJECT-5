<?php

declare(strict_types=1);

namespace App\Controller;

use App\View\View;

class commonController
{

    public function login()
    {
        $noSessionTargetPage = file_get_contents('../src/view/frontend/pagecontent/login.html');
        $view = new View;
        $view->pageBuilder($noSessionTargetPage, null, null);
       
    }

    public function register()
    {
        $noSessionTargetPage = file_get_contents('../src/view/frontend/pagecontent/register.html');
        $view = new View;
        $view->pageBuilder($noSessionTargetPage, null, null);
        echo $view;
    }

    public function buttonsBuilder($buttonTitle, $buttonLink)
    {
        $button = file_get_contents('../src/view/backend/buttons.html');
        $button = str_replace("{BUTTON_TITLE}", $buttonTitle, $button);
        $button = str_replace("{BUTTON_LINK}", $buttonLink, $button);
        return $button;
    }


    public function groupContentBuilder($contentTitle, $buttons)
    {
        if ($contentTitle == "Groups") {
            $content = file_get_contents('../src/view/backend/content/content.html');
            $content = str_replace("{BUTTONS}", $buttons, $content);
            return $content;
        }
    }

    public function ticketContentBuilder($contentTitle, $buttons)
    {
        if ($contentTitle == "Tickets") {
            $content = file_get_contents('../src/view/backend/content/content.html');
            $content = str_replace("{BUTTONS}", $buttons, $content);
            return $content;
        }
    }





}
