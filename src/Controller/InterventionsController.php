<?php

declare(strict_types=1);

namespace App\Controller;

use App\Tools\SuperGlobals;
use App\View\View;
use App\Model\GroupModel;
use App\Model\TicketModel;
use App\Model\InterventionModel;

class InterventionsController
{

    private $view;
    private $interventionModel;
    private $groupModel;
    private $ticketModel;
    private $superGlobals;

    public function __construct()
    {
        $this->view = new View();
        $this->interventionModel = new InterventionModel();
        $this->groupModel = new GroupModel();
        $this->ticketModel = new TicketModel();
        $this->superGlobals = new SuperGlobals();
    }


    // DISPLAY PAGE - Shared Interventions
    public function sharedInterventionsPage()
    {
        $result = $this->groupModel->getSharedGroups();
        $finalArray = array();
        foreach ($result as $key) {
            $ticketList = $this->ticketModel->getOpenTicketsWithGroupId((int)$key['group_id']);
            foreach ($ticketList as $ticket) {
                $finalArray = array_merge($finalArray, $this->interventionModel->getInterventionForTicketId((int)$ticket['id']));
            }
        }
        $this->view->render("sharedinterventions", ['results' => $finalArray]);
    }

    // DISPLAY PAGE - MY INTERVENTIONS
    public function myInterventionsPage()
    {
        $result = $this->interventionModel->getMyInterventions();
        $this->view->render("myinterventions", ['results' => $result]);
    }

    // DISPLAY PAGE - Create Interventions Page
    public function createInterventionPage()
    {
        $ticketId = $this->superGlobals->_GET("ticketid");
        $this->view->render("createintervention", ['ticketid' => $ticketId]);
    }

    // DISPLAY PAGE - Create Intervention Function
    public function createInterventionFunction()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" and $this->superGlobals->ISSET_POST("Description") and $this->superGlobals->ISSET_POST("ticketid")) {
            $this->interventionModel->createNewIntervention();
            header('Location: ../index.php?action=ticketdetails&id=' . $this->superGlobals->_POST("ticketid"));
            exit();
        }
        header('Location: ../index.php');
        exit();
    }

}
