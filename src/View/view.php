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


    public function htmlTableBuilder(array $htmlTableIndex, array $data): string
    {
        $htmlTable = "";
        $htmlTable = file_get_contents('../src/View/backend/htmlcomponents/table/html_table.html');
        
        $htmlThead = file_get_contents('../src/View/backend/htmlcomponents/table/html_table_thead.html');
        $htmlTbody = file_get_contents('../src/View/backend/htmlcomponents/table/html_table_tbody.html');
        $htmlTr = file_get_contents('../src/View/backend/htmlcomponents/table/html_table_tr.html');
        $htmlTh = file_get_contents('../src/View/backend/htmlcomponents/table/html_table_th.html');
        $htmlTd = file_get_contents('../src/View/backend/htmlcomponents/table/html_table_td.html');

        $indexCount = count($htmlTableIndex);
        
        $htmlTable = str_replace("{THEAD}", $htmlThead, $htmlTable);
        $htmlTable = str_replace("{TR}", $htmlTr, $htmlTable);
        $htmlTable = str_replace("{TD}", "", $htmlTable);
        
        $htmlThCompiled = "";
        for ($i = 0; $i < $indexCount; $i++) {
            $htmlThCompiled .= $htmlTh;            
            $htmlThCompiled = str_replace("{CONTENT}", $htmlTableIndex[$i], $htmlThCompiled);           
        }      
        $htmlTable = str_replace("{TH}", $htmlThCompiled, $htmlTable);
       



        


        foreach ($data as $item => $value) {            
            $columns = count($value) / 2;
            for ($i = 0; $i < $columns; $i++) {
               
            }            
        }

        echo $htmlTable;
        die;

        return $htmlTable;
    }
}
