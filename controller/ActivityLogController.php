
<?php



class ActivityLogController
{

    public function activityLog()
    {
        $targetPage = "activityLog";
        $commonController = new CommonController();
        $view = $commonController->pageBuilder($targetPage);
        echo $view;
    }

}
