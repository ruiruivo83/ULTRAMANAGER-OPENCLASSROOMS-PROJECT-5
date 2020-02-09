<?php

declare(strict_types=1);

namespace App\Controller;

use App\View\View;
use App\Model\InterventionModel;

class InterventionsController
{

    private $view;
    private $interventionModel;

    public function __construct()
    {
        $this->view = new View();
        $this->interventionModel = new InterventionModel();
    }

    public function myInterventionsPage()
    {

    }


    public function globalInterventionsPage()
    {
        $result = $this->interventionModel->getAllInterventions();
        $this->view->render("globalinterventions", ['interventions' => $result]);
    }

    public function interventionDetailsPage()
    {

    }

    public function sharedInterventionsPage()
    {

    }

    public function sharedInterventionDetailsPage()
    {

    }


    public function createInterventionPage()
    {
        $result = $this->interventionModel->getAllInterventions();
        $this->view->render("createintervention", ['interventions' => $result]);
    }


}
