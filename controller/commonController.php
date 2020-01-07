<?php


class commonController
{

    public function login()
    {
        $targetPage = "login";
        $view = $this->pageBuilder($targetPage);
        echo $view;
    }

    public function register()
    {
        $targetPage = "register";
        $view = $this->pageBuilder($targetPage);
        echo $view;
    }


    public function pageBuilder($targetPage)
    {

        $view = file_get_contents('view/frontend/appLayout.html');
        $content = file_get_contents('view/frontend/pagecontent/' . $targetPage . '.html');



        if (isset($_SESSION["user"])) {
            $view = str_replace("{USER_TOPBAR}", file_get_contents('view/backend/user_topbar.html'), $view);
            $view = str_replace("{FRONTPAGE_TOPBAR}", "", $view);
            $view = str_replace("{SIDEBAR}", file_get_contents('view/backend/sidebar.html'), $view);
            $view = str_replace("{CONTENT}", $content, $view);
            // USER INFO
            $view = str_replace("{FIRST_NAME}", $_SESSION['user']->getFirstname() . "&nbsp", $view);
            $view = str_replace("{LAST_NAME}", $_SESSION['user']->getLastname() . "&nbsp", $view);
            // REPLACE TOTALS
            // TODO
        } else {
            $view = str_replace("{USER_TOPBAR}", "", $view);
            $view = str_replace("{FRONTPAGE_TOPBAR}", file_get_contents('view/backend/frontpage_topbar.html'), $view);
            $view = str_replace("{SIDEBAR}", "", $view);
            $view = str_replace("{CONTENT}", $content, $view);
        }

        return $view;
    }
}
