<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\User;
use App\View\View;
use App\Model\GroupModel;
use App\Model\UserModel;
use App\Model\TicketModel;
use App\Model\MemberModel;
use App\Tools\SuperGlobals;

class StatsController
{

    private $superGlobals;
    private $ticketModel;
    private $view;

    public function __construct()
    {
        $this->view = new View();
        $this->ticketModel = new TicketModel();
        $this->superGlobals = new SuperGlobals();
    }

    public function getTotalOpenTicketsThisMonthFunction()
    {
        echo "runing getTotalOpenTicketsThisMonthFunction";
    }

    public function getTotalClosedTicketsThisMonthFunction()
    {
        echo "runing getTotalClosedTicketsThisMonthFunction";
    }

    public function getTotalInterventionsThisMonthFunction()
    {
        echo "runing getTotalInterventionsThisMonthFunction";
    }
}