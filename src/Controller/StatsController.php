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

    public function getTotalOpenTicketsThisMonthFunction()
    {
        $CreationYear = date("Y");
        $CreationMonth = date("m");
        $status = "open";
        $ticketsForThisMonth = $this->ticketModel->getMyTicketsForYearAndMonth($CreationYear, $CreationMonth, $status);

        // FOR DEBUG ONLY
        // var_dump($ticketsForThisMonth);
        echo json_encode($ticketsForThisMonth);
    }

    public function getTotalClosedTicketsThisMonthFunction()
    {
        echo "running getTotalClosedTicketsThisMonthFunction";
    }

    public function getTotalInterventionsThisMonthFunction()
    {
        $CreationYear = date("Y");
        $CreationMonth = date("m");

        // todo
        // GET GROUPS

        // GET TICKETS

        // GET INTERVENTIONS


        $interventionsForThisMonth = $this->interventionsModel->getMyInterventionsForYearAndMonth($CreationYear, $CreationMonth);

        // FOR DEBUG ONLY
        // var_dump($ticketsForThisMonth);
        echo json_encode($interventionsForThisMonth);
    }
}