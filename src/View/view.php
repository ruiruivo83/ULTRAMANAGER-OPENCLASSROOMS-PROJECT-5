<?php
declare(strict_types=1);

namespace App\View;

class View {

    public function pageBuilder($noSessionTargetPage, $content, $contentTitle)
    {

        $view = file_get_contents('../src/view/frontend/appLayout.html');
        // $content = file_get_contents('view/frontend/pagecontent/' . $targetPage . '.html');

        if (isset($_SESSION["user"])) {
            $view = str_replace("{USER_TOPBAR}", file_get_contents('../src/view/backend/user_topbar.html'), $view);
            $view = str_replace("{FRONTPAGE_TOPBAR}", "", $view);
            $view = str_replace("{SIDEBAR}", file_get_contents('../src/view/backend/sidebar.html'), $view);

            // USER INFO
            $view = str_replace("{FIRST_NAME}", $_SESSION['user']->getFirstname() . "&nbsp", $view);
            $view = str_replace("{LAST_NAME}", $_SESSION['user']->getLastname() . "&nbsp", $view);
            // REPLACE TOTALS
            // TODO
            // REPLACE CONTENT TITLE
            $view = str_replace("{CONTENT_TITLE}", file_get_contents('../src/view/backend/content/content_title.html'), $view);
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
            $view = str_replace("{FRONTPAGE_TOPBAR}", file_get_contents('../src/view/backend/frontpage_topbar.html'), $view);
            //
            $view = str_replace("{SIDEBAR}", "", $view);
            //
            $view = str_replace("{CONTENT_TITLE}", "", $view);
            $view = str_replace("{CONTENT}", $noSessionTargetPage, $view);
        }

        echo $view;
    }


}