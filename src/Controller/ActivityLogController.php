<?php

declare(strict_types=1);

namespace App\Controller;

use App\View\View;

// require '../src/View/View.php';

class ActivityLogController
{
    public function activityLogPage()
    {
        $contentTitle = "Activity Log";
        // TODO
        $content = "";
        $view = new View();
        $view->pageBuilder(null, $content, $contentTitle);
    }
}
