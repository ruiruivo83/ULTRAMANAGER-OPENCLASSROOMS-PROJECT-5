<?php



class ProfileController
{

    public function profile()
    {

        $targetPage = "profile";
        $commonController = new CommonController();
        $view = $commonController->pageBuilder($targetPage);

        echo $view;
    }
}
