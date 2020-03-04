<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\User;
use App\View\View;
use App\Model\GroupModel;
use App\Model\UserModel;
use App\Model\TicketModel;
use App\Model\InterventionModel;
use App\Model\MemberModel;
use App\Tools\SuperGlobals;

class StatsController
{
    private $superGlobals;
    private $ticketModel;
    private $interventionsModel;
    private $view;

    public function __construct()
    {
        $this->view = new View();
        $this->ticketModel = new TicketModel();
        $this->interventionsModel = new InterventionModel();
        $this->superGlobals = new SuperGlobals();
    }

    public function ajaxGetTotalOpenTicketsThisMonthFunction()
    {
        $CreationYear = date("Y");
        $CreationMonth = date("m");
        $status = "open";
        $ticketsForThisMonth = $this->ticketModel->getMyTicketsForYearAndMonth($CreationYear, $CreationMonth, $status);
        echo json_encode($ticketsForThisMonth);
    }

    public function getTotalClosedTicketsThisMonthFunction()
    {
        echo "running getTotalClosedTicketsThisMonthFunction";
    }

    public function ajaxGetTotalInterventionsThisMonthFunction()
    {
        $CreationYear = date("Y");
        $CreationMonth = date("m");
        $interventionsForThisMonth = $this->interventionsModel->getMyInterventionsForYearAndMonth($CreationYear, $CreationMonth);
        echo json_encode($interventionsForThisMonth);
    }
}