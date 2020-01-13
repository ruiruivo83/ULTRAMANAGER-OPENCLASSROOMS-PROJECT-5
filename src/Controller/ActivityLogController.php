<?php

class ActivityLogController
{
    public function activityLog()
    {
        $contentTitle = "Activity Log";
        // TODO
        $content = "";
        $commonController = new CommonController();
        $view = $commonController->pageBuilder(null, $content, $contentTitle);

        echo $view;
    }
}
