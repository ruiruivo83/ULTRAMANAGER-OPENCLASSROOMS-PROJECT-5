<?php

class commonController
{

    public function login()
    {
        $noSessionTargetPage = file_get_contents('view/frontend/pagecontent/login.html');
        $view = $this->pageBuilder($noSessionTargetPage, null, null);
        echo $view;
    }

    public function register()
    {
        $noSessionTargetPage = file_get_contents('view/frontend/pagecontent/register.html');
        $view = $this->pageBuilder($noSessionTargetPage, null, null);
        echo $view;
    }


    public function pageBuilder($noSessionTargetPage, $content, $contentTitle)
    {

        $view = file_get_contents('view/frontend/appLayout.html');
        // $content = file_get_contents('view/frontend/pagecontent/' . $targetPage . '.html');

        if (isset($_SESSION["user"])) {
            $view = str_replace("{USER_TOPBAR}", file_get_contents('view/backend/user_topbar.html'), $view);
            $view = str_replace("{FRONTPAGE_TOPBAR}", "", $view);
            $view = str_replace("{SIDEBAR}", file_get_contents('view/backend/sidebar.html'), $view);

            // USER INFO
            $view = str_replace("{FIRST_NAME}", $_SESSION['user']->getFirstname() . "&nbsp", $view);
            $view = str_replace("{LAST_NAME}", $_SESSION['user']->getLastname() . "&nbsp", $view);
            // REPLACE TOTALS
            // TODO
            // REPLACE CONTENT TITLE
            $view = str_replace("{CONTENT_TITLE}", file_get_contents('view/backend/content/content_title.html'), $view);
            $view = str_replace("{CONTENT_TITLE_text}", $contentTitle, $view);
            // REPLACE CONTENT
            //...

            // REPLACE CONTENT
            $view = str_replace("{CONTENT}", $content, $view);
            //...
            //...

        } else {
            //
            $view = str_replace("{USER_TOPBAR}", "", $view);
            $view = str_replace("{FRONTPAGE_TOPBAR}", file_get_contents('view/backend/frontpage_topbar.html'), $view);
            //
            $view = str_replace("{SIDEBAR}", "", $view);
            //
            $view = str_replace("{CONTENT_TITLE}", "", $view);
            $view = str_replace("{CONTENT}", $noSessionTargetPage, $view);
        }

        return $view;
    }


    public function buttonsBuilder($buttonTitle, $buttonLink)
    {
        $button = file_get_contents('view/backend/buttons.html');
        $button = str_replace("{BUTTON_TITLE}", $buttonTitle, $button);
        $button = str_replace("{BUTTON_LINK}", $buttonLink, $button);
        return $button;
    }


    public function contentBuilder($contentTitle, $buttons)
    {
        if ($contentTitle == "Groups") {
            $content = file_get_contents('view/backend/content/content.html');
            $content = str_replace("{BUTTONS}", $buttons, $content);
            return $content;
        }
    }
}
