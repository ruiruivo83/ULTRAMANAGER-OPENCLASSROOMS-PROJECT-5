<?php

declare(strict_types=1);

namespace App\Controller;

use App\View\View;

class TicketsController
{

    public function tickets()
    {
        $contentTitle = "Tickets";
        // TODO
        $content = "";
        $commonController = new CommonController();
        $view = new View();
        $view->pageBuilder(null, $content, $contentTitle);
        echo $view;
    }

    public function ticketDetails()
    {
        $contentTitle = "Ticket Details";
        // TODO
        $content = "";
        $commonController = new CommonController();
        $view = new View();
        $view->pageBuilder(null, $content, $contentTitle);
        echo $view;
    }

    public function sharedTickets()
    {
        $contentTitle = "Shared Tickets";
        // TODO
        $content = "";
        $commonController = new CommonController();
        $view = new View();
        $view->pageBuilder(null, $content, $contentTitle);
        echo $view;
    }

    public function sharedTicketDetails()
    {
        $contentTitle = "Shared Ticket Details";
        // TODO
        $content = "";
        $commonController = new CommonController();
        $view = new View();
        $view->pageBuilder(null, $content, $contentTitle);
        echo $view;
    }


    public function globalTickets()
    {

        $contentTitle = "Global Tickets";
        // TODO
        $content = "";
        $commonController = new CommonController();
        $view = new View();
        $view->pageBuilder(null, $content, $contentTitle);

        echo $view;
    }

}