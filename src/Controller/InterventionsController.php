<?php

declare(strict_types=1);

namespace App\Controller;

use App\View\View;
use App\Model\Intervention;

class InterventionsController
{

    public function interventions()
    {
        $contentTitle = "Interventions";
        $commonController = new CommonController();

        // DEFINE BUTTONS TO SHOW
        $buttons = "";
        $buttons .= $commonController->buttonsBuilder("Create New Intervention", "../index.php?action=createintervention");

        // BUILD CONTENT
        $content = $commonController->interventionContentBuilder($contentTitle, $buttons);

        // GET Interventions
        $content = str_replace(" {OPEN_CONTENT}", $this->replaceInterventionList("open"), $content);

        // GET CLOSED TICKETS
        /*
        $content = str_replace(" {CLOSED_CONTENT}", "", $content);
        */

        $view = new View;
        $view->pageBuilder(null, $content, $contentTitle);
    }

    public function interventionDetails()
    {
        $contentTitle = "Intervention Details";
        $content = "";
        $view = new View;
        $view->pageBuilder(null, $content, $contentTitle);
    }

    public function sharedInterventions()
    {
        $contentTitle = "Shared Interventions";
        $content = "";
        $view = new View;
        $view->pageBuilder(null, $content, $contentTitle);
    }

    public function sharedInterventionDetails()
    {
        $contentTitle = "Shared Intervention Details";
        $content = "";
        $view = new View;
        $view->pageBuilder(null, $content, $contentTitle);
    }


    public function globalInterventions()
    {
        $contentTitle = "Global Interventions";
        $content = "";
        $view = new View;
        $view->pageBuilder(null, $content, $contentTitle);
    }

    public function displayCreateInterventionsPage()
    {
        $contentTitle = "Create New Intervention";
        $content = file_get_contents('../src/View/backend/content/newintervention.html');
        $content = str_replace("{INTERVENTION_TYPE}", "(Private)", $content);
        $view = new View;
        $view->pageBuilder(null, $content, $contentTitle);
    }

    public function replaceinterventionList(string $status):string
    {
        $intervention_list_final_code = null;

        if (isset($_SESSION['user'])) {
            $intervention = new intervention(null, null, null, null, null, null, null);
            $result = $intervention->getinterventions($status);
            foreach ($result as $current_result) {
                $intervention = null;
                $intervention = file_get_contents('../src/View/backend/interventions/intervention_list_default_code.html');
                $intervention = str_replace("{INTERVENTION_AUTHOR}", $current_result["intervention_author"], $intervention);
                $intervention = str_replace("{INTERVENTION_ID}", $current_result["id"], $intervention, $count);
                $intervention = str_replace("{INTERVENTION_DESCRIPTION}", $current_result["intervention_description"], $intervention);
                $intervention = str_replace("{INTERVENTION_DESCRIPTION}", $current_result["intervention_description"], $intervention);
                $intervention_list_final_code .= $intervention;
            }
            $intervention_list_final_code = str_replace("{INTERVENTION_LIST}", $intervention_list_final_code, $intervention_list_final_code);
            $intervention_list_final_code = "<div>{INTERVENTION_STATUS_TITLE}</div>" . $intervention_list_final_code;
            // NO NEED FOR STATUS
            $intervention_list_final_code = str_replace("{INTERVENTION_STATUS_TITLE}", "", $intervention_list_final_code);
        }


        return $intervention_list_final_code;
    }
}
