<?php

declare(strict_types=1);

namespace App\View;

class View
{

    public function pageBuilder($noSessionTargetPage, $content, $contentTitle)
    {

        $view = file_get_contents('../src/View/frontend/appLayout.html');
        // $content = file_get_contents('view/frontend/pagecontent/' . $targetPage . '.html');

        if (isset($_SESSION["user"])) {
            $view = str_replace("{USER_TOPBAR}", file_get_contents('../src/View/backend/user_topbar.html'), $view);
            $view = str_replace("{FRONTPAGE_TOPBAR}", "", $view);
            $view = str_replace("{SIDEBAR}", file_get_contents('../src/View/backend/sidebar.html'), $view);

            // USER INFO
            $view = str_replace("{FIRST_NAME}", $_SESSION['user']->getFirstname() . "&nbsp", $view);
            $view = str_replace("{LAST_NAME}", $_SESSION['user']->getLastname() . "&nbsp", $view);
            // REPLACE TOTALS
            // TODO
            // REPLACE CONTENT TITLE
            $view = str_replace("{CONTENT_TITLE}", file_get_contents('../src/View/backend/content/content_title.html'), $view);
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
            $view = str_replace("{FRONTPAGE_TOPBAR}", file_get_contents('../src/View/backend/frontpage_topbar.html'), $view);
            //
            $view = str_replace("{SIDEBAR}",  file_get_contents('../src/View/backend/sidebar.html'), $view);
            //
            $view = str_replace("{CONTENT_TITLE}", "", $view);
            if (isset($_GET['action']) and $_GET['action'] == 'register') {
                $view = str_replace("{CONTENT}", $noSessionTargetPage, $view);
            } else  if (isset($_GET['action']) and $_GET['action'] == 'login') {
                $view = str_replace("{CONTENT}", $noSessionTargetPage, $view);
            } else {
                $dashboard = file_get_contents('../src/View/frontend/pagecontent/dashboard.html');
                $view = str_replace("{CONTENT}", $dashboard, $view);
            }
        }

        echo $view;
    }

    // TESTING
    public function testingHtmlTableBuilder(array $htmlTableIndex, array $data): string
    {

        // IMPORT TABLE HTML COMPONENTS
        $htmlTable = "";
        $htmlTable = file_get_contents('../src/View/backend/htmlcomponents/table/html_table.html');
        $htmlThead = file_get_contents('../src/View/backend/htmlcomponents/table/html_table_thead.html');
        $htmlTheadTr = file_get_contents('../src/View/backend/htmlcomponents/table/html_table_thead_tr.html');
        $htmlTbody = file_get_contents('../src/View/backend/htmlcomponents/table/html_table_tbody.html');
        $htmlTr = file_get_contents('../src/View/backend/htmlcomponents/table/html_table_tr.html');
        $htmlTh = file_get_contents('../src/View/backend/htmlcomponents/table/html_table_th.html');
        $htmlTd = file_get_contents('../src/View/backend/htmlcomponents/table/html_table_td.html');

        // BUILD INDEX
        $indexCount = count($htmlTableIndex);

        $htmlTable = str_replace("{THEAD}", $htmlThead, $htmlTable);
        $htmlTable = str_replace("{TR}", $htmlTheadTr, $htmlTable);
        $htmlTable = str_replace("{TD}", "", $htmlTable);
        // BUILD INDEX TITLES
        $htmlThCompiled = "";
        for ($i = 0; $i < $indexCount; $i++) {
            $htmlThCompiled .= $htmlTh;
            $htmlThCompiled = str_replace("{CONTENT}", $htmlTableIndex[$i], $htmlThCompiled);
        }

        // ADD ONE COLUMN FOR BUTTON OPTIONS
        $htmlThCompiled .= $htmlTh;
        $htmlThCompiled = str_replace("{CONTENT}", "OPTIONS", $htmlThCompiled);
        //..
        $htmlTable = str_replace("{TH}", $htmlThCompiled, $htmlTable);
        $htmlTable = str_replace("{TBODY}", $htmlTbody, $htmlTable);

        // BUILDS CONTENT FOR EVERY ITEM LINE BY LINE
        $htmlTrCompiled = "";


        $htmlTrCompiled .= $htmlTr;

        $htmlTdCompiled = "";
        for ($i = 0; $i < $indexCount; $i++) {
            $htmlTdCompiled .= $htmlTd;
            $htmlTdCompiled = str_replace("{CONTENT}", $data[$i], $htmlTdCompiled);
        }
        // ADD OPTIONS PER LINE EACH ITEM
        $htmlTdCompiled .= $htmlTd;
        $htmlTdCompiled = str_replace("{CONTENT}", $this->getCompiledButtons($data[0]), $htmlTdCompiled);
        //...
        $htmlTrCompiled = str_replace("{TD}", $htmlTdCompiled, $htmlTrCompiled);
        $htmlTrCompiled = str_replace("{TH}", "", $htmlTrCompiled);


        $htmlTable = str_replace("{TR}", $htmlTrCompiled, $htmlTable);

        // RETURN THE FULL HTML TABLE READY TO DISPLAY
        return $htmlTable;
    }


    public function htmlTableBuilder(array $htmlTableIndex, array $data): string
    {
        // IMPORT TABLE HTML COMPONENTS
        $htmlTable = "";
        $htmlTable = file_get_contents('../src/View/backend/htmlcomponents/table/html_table.html');
        $htmlThead = file_get_contents('../src/View/backend/htmlcomponents/table/html_table_thead.html');
        $htmlTheadTr = file_get_contents('../src/View/backend/htmlcomponents/table/html_table_thead_tr.html');
        $htmlTbody = file_get_contents('../src/View/backend/htmlcomponents/table/html_table_tbody.html');
        $htmlTr = file_get_contents('../src/View/backend/htmlcomponents/table/html_table_tr.html');
        $htmlTh = file_get_contents('../src/View/backend/htmlcomponents/table/html_table_th.html');
        $htmlTd = file_get_contents('../src/View/backend/htmlcomponents/table/html_table_td.html');

        // BUILD INDEX
        $indexCount = count($htmlTableIndex);
        $htmlTable = str_replace("{THEAD}", $htmlThead, $htmlTable);
        $htmlTable = str_replace("{TR}", $htmlTheadTr, $htmlTable);
        $htmlTable = str_replace("{TD}", "", $htmlTable);
        // BUILD INDEX TITLES
        $htmlThCompiled = "";
        for ($i = 0; $i < $indexCount; $i++) {
            $htmlThCompiled .= $htmlTh;
            $htmlThCompiled = str_replace("{CONTENT}", $htmlTableIndex[$i], $htmlThCompiled);
        }
        // ADD ONE COLUMN FOR BUTTON OPTIONS
        $htmlThCompiled .= $htmlTh;
        $htmlThCompiled = str_replace("{CONTENT}", "OPTIONS", $htmlThCompiled);
        //..
        $htmlTable = str_replace("{TH}", $htmlThCompiled, $htmlTable);
        $htmlTable = str_replace("{TBODY}", $htmlTbody, $htmlTable);

        // BUILDS CONTENT FOR EVERY ITEM LINE BY LINE
        $htmlTrCompiled = "";
        foreach ($data as $value) {           
            $htmlTrCompiled .= $htmlTr;

            $htmlTdCompiled = "";
            for ($i = 0; $i < $indexCount; $i++) {
                $htmlTdCompiled .= $htmlTd;
                $htmlTdCompiled = str_replace("{CONTENT}", $value[$i], $htmlTdCompiled);
            }
            // ADD OPTIONS PER LINE EACH ITEM
            $htmlTdCompiled .= $htmlTd;
            $htmlTdCompiled = str_replace("{CONTENT}", $this->getCompiledButtons($value[0]), $htmlTdCompiled);
            //...
            $htmlTrCompiled = str_replace("{TD}", $htmlTdCompiled, $htmlTrCompiled);
            $htmlTrCompiled = str_replace("{TH}", "", $htmlTrCompiled);
        }
        $htmlTable = str_replace("{TR}", $htmlTrCompiled, $htmlTable);

        // RETURN THE FULL HTML TABLE READY TO DISPLAY
        return $htmlTable;
    }

    public function getCompiledButtons($itemId)
    {
        $buttonDefaultCode = "";

        // Get Project type (Group, Ticket or Intervention...)
        // TICKETS
        if ($_GET['action'] == 'tickets') {
            // HREF FOR TICKET DETAILS
            $href = "../index.php?action=ticketdetails&id=" . $itemId;
            $buttonDefaultCode = file_get_contents('../src/View/backend/htmlcomponents/button/html_button.html');
            $buttonDefaultCode = str_replace("{BUTTON_HREF}", $href, $buttonDefaultCode);
            $buttonDefaultCode = str_replace("{BUTTON_TITLE}", "Details ", $buttonDefaultCode);
        }

        // GROUPS
        if ($_GET['action'] == 'groups') {
            // HREF FOR GROUP DETAILS
            $href = "../index.php?action=groupdetails&id=" . $itemId;
            $buttonDefaultCode = file_get_contents('../src/View/backend/htmlcomponents/button/html_button.html');
            $buttonDefaultCode = str_replace("{BUTTON_HREF}", $href, $buttonDefaultCode);
            $buttonDefaultCode = str_replace("{BUTTON_TITLE}", "Details", $buttonDefaultCode);
        }

        // GROUPS
        if ($_GET['action'] == 'groupdetails') {
            // HREF FOR GROUP DETAILS
            $href = "../index.php?action=ticketdetails&id=" . $itemId;
            $buttonDefaultCode = file_get_contents('../src/View/backend/htmlcomponents/button/html_button.html');
            $buttonDefaultCode = str_replace("{BUTTON_HREF}", $href, $buttonDefaultCode);
            $buttonDefaultCode = str_replace("{BUTTON_TITLE}", "Details", $buttonDefaultCode);
        }

        // GLOBAL TICKETS
        if ($_GET['action'] == 'globaltickets') {
            $buttonDefaultCode = file_get_contents('../src/View/backend/htmlcomponents/button/html_button.html');
            $buttonDefaultCode = str_replace("{BUTTON_HREF}", "../index.php", $buttonDefaultCode);
            $buttonDefaultCode = str_replace("{BUTTON_TITLE}", "Details", $buttonDefaultCode);
        }

        // GLOBAL GROUPS
        if ($_GET['action'] == 'globalgroups') {
            $buttonDefaultCode = file_get_contents('../src/View/backend/htmlcomponents/button/html_button.html');
            $buttonDefaultCode = str_replace("{BUTTON_HREF}", "../index.php", $buttonDefaultCode);
            $buttonDefaultCode = str_replace("{BUTTON_TITLE}", "Details", $buttonDefaultCode);
        }

        /*
        echo "id";
        die;
        // DISPLAY BUTTONS FOR TICKETS
        if ($_GET['action'] == 'tickets') {

        }

        // DISPLAY BUTTONS FOR GROUPS
        if ($_GET['action'] == 'groups') {

        }
        */
        return $buttonDefaultCode;
    }

    public function buttonsBuilder($buttonTitle, $buttonLink)
    {

        // LOAD BUTTONS FOR PAGE MY GROUPS
        if ($_GET['action'] == 'groups') {
            $button = file_get_contents('../src/View/backend/buttons.html');
            $button = str_replace("{BUTTON_TITLE}", $buttonTitle, $button);
            $button = str_replace("{BUTTON_LINK}", $buttonLink, $button);
            return $button;
        }

        // LOAD BUTTONS FOR PAGE MY TICKETS
        if ($_GET['action'] == 'tickets') {
            $button = file_get_contents('../src/View/backend/buttons.html');
            $button = str_replace("{BUTTON_TITLE}", $buttonTitle, $button);
            $button = str_replace("{BUTTON_LINK}", $buttonLink, $button);
            return $button;
        }

        // LOAD BUTTONS FOR PAGE TICKET DETAILS
        if ($_GET['action'] == 'ticketdetails') {
            $button = file_get_contents('../src/View/backend/buttons.html');
            $button = str_replace("{BUTTON_TITLE}", $buttonTitle, $button);
            $button = str_replace("{BUTTON_LINK}", $buttonLink, $button);
            return $button;
        }
    }


    public function groupContentBuilder($content, $buttons)
    {
        $content = file_get_contents('../src/View/backend/content/content.html');
        $content = str_replace("{BUTTONS}", $buttons, $content);
        return $content;
    }

    public function ticketContentBuilder($contentTitle, $buttons)
    {
        if ($contentTitle == "Tickets") {
            $content = file_get_contents('../src/View/backend/content/content.html');
            $content = str_replace("{BUTTONS}", $buttons, $content);
            return $content;
        }

        if ($contentTitle == "Ticket Details") {
            $content = file_get_contents('../src/View/backend/content/content.html');
            $content = str_replace("{BUTTONS}", $buttons, $content);
            return $content;
        }
    }

    public function interventionContentBuilder($contentTitle, $buttons)
    {
        if ($contentTitle == "Interventions") {
            $content = file_get_contents('../src/View/backend/content/content.html');
            $content = str_replace("{BUTTONS}", $buttons, $content);
            return $content;
        }
    }
}
