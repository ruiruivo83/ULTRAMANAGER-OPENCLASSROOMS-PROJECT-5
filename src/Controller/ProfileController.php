<?php

class ProfileController
{

    public function profile()
    {

        $contentTitle = "Profile";
        // TODO
        $content = "";
        $commonController = new CommonController();
        $view = $commonController->pageBuilder(null, $content, $contentTitle);

        echo $view;
    }
}
