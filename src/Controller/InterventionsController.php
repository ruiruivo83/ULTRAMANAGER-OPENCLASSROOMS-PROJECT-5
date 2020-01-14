<?php
namespace App\Controller;
class InterventionsController
{

    public function interventions()
    {
        $contentTitle = "Interventions";
        // TODO
        $content = "";
        $commonController = new CommonController();
        $view = $commonController->pageBuilder(null, $content, $contentTitle);
        echo $view;
    }

    public function interventionDetails()
    {
        $contentTitle = "Intervention Details";
        // TODO
        $content = "";
        $commonController = new CommonController();
        $view = $commonController->pageBuilder(null, $content, $contentTitle);
        echo $view;
    }

    public function sharedInterventions()
    {
        $contentTitle = "Shared Interventions";
        // TODO
        $content = "";
        $commonController = new CommonController();
        $view = $commonController->pageBuilder(null, $content, $contentTitle);
        echo $view;
    }

    public function sharedInterventionDetails()
    {
        $contentTitle = "Shared Intervention Details";
        // TODO
        $content = "";
        $commonController = new CommonController();
        $view = $commonController->pageBuilder(null, $content, $contentTitle);
        echo $view;
    }


    public function globalInterventions()
    {

        $contentTitle = "Global Interventions";
        // TODO
        $content = "";
        $commonController = new CommonController();
        $view = $commonController->pageBuilder(null, $content, $contentTitle);

        echo $view;
    }

}