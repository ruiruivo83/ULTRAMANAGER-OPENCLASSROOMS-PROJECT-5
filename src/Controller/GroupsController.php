<?php

declare(strict_types=1);

namespace App\Controller;

use App\View\View;
use App\Model\Group;

class GroupsController
{

    public function groups()
    {
        // TODO        
        $contentTitle = "Groups";
        $commonController = new CommonController();

        // DEFINE AND BUILD BUTTONS TO SHOW
        $buttons = "";
        $buttons .= $commonController->buttonsBuilder("Create New Group", "../index.php?action=creategroup");

        // BUILD CONTENT
        $content = $commonController->groupContentBuilder($contentTitle, $buttons);

        // GET MY GROUPS
        $group = new Group(null, null, null, null, null, null);
        $myGroups = $group->getMyGroups();

        // GET HTML TABLE TO SHOW
        $view = new View;
        $htmlTableIndex = ["id", "group_admin", "creation_date", "group_name", "group_description", "group_status"];        
        $content = str_replace("{HTML_TABLE_RESULT}", $view->htmlTableBuilder($htmlTableIndex, $myGroups), $content);

        // SEND HTML TABLE RESULT TO THE VIEW
        $view->pageBuilder(null, $content, $contentTitle);
    }

    public function groupMembers()
    {
        $contentTitle = "Group Members";
        $content = "";
        $view = new View;
        $view->pageBuilder(null, $content, $contentTitle);
    }

    public function memberDetails()
    {
        $contentTitle = "Member Details";
        $content = "";
        $view = new View;
        $view->pageBuilder(null, $content, $contentTitle);
    }

    public function sharedGroups()
    {
        $contentTitle = "Shared Groups";
        $content = "";
        $view = new View;
        $view->pageBuilder(null, $content, $contentTitle);
    }

    public function sharedGroupMembers()
    {
        $contentTitle = "Shared Group Members";
        $content = "";
        $view = new View;
        $view->pageBuilder(null, $content, $contentTitle);
    }

    public function sharedMemberDetails()
    {
        $contentTitle = "Shared Member Details";
        $content = "";
        $view = new View;
        $view->pageBuilder(null, $content, $contentTitle);
    }

    // GROUP CONTENT BUILDER
    public function groupContentBuilder($info)
    {
        // groups() - LIST ALL GROUPS
        if ($info = "groups") {
        }
    }

    public function globalGroups()
    {

        $contentTitle = "Global Groups";
        $commonController = new CommonController();

        // DEFINE AND BUILD BUTTONS TO SHOW
        $buttons = "";
        $buttons .= $commonController->buttonsBuilder("Create New Group", "../index.php?action=creategroup");

        // BUILD CONTENT
        $content = $commonController->groupContentBuilder($contentTitle, $buttons);

        // GET MY GROUPS
        $group = new Group(null, null, null, null, null, null);
        $myGroups = $group->getGroups();

      
         // GET HTML TABLE TO SHOW
        $view = new View;
        $htmlTableIndex = ["id", "group_admin", "creation_date", "group_name", "group_description", "group_status"];        
        $content = str_replace("{HTML_TABLE_RESULT}", $view->htmlTableBuilder($htmlTableIndex, $myGroups), $content);
       
        $view->pageBuilder(null, $content, $contentTitle);
    }

    public function displayCreateGroupPage()
    {
        $contentTitle = "Create New Group";
        $content = file_get_contents('../src/View/backend/content/newgroup.html');
        $content = str_replace("{GROUP_TYPE}", "(Private)", $content);
        $view = new View;
        $view->pageBuilder(null, $content, $contentTitle);
    }

    public function createGroupFunction()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["Title"]) and isset($_POST["Description"])) {
            $title = $_POST["Title"];
            $description = $_POST["Description"];
            $group_admin = $_SESSION['user']->getEmail();
            $group_status = "open";
            // INSERT INTO DATABASE
            // Create class instance
            $Group = new Group(null, $group_admin, null, $title, $description, $group_status);
            // Execute method addTicket
            $Group->createNewGroup();
            header('Location: ../index.php?action=groups');
            // exit();
        }
    }

    public function replaceGroupList($status)
    {
        $group_list_final_code = null;
        $group_admin = $_SESSION['user']->getEmail();
        if (isset($_SESSION['user'])) {
            $group = new Group(null, null, null, null, null, null);
            $groupList = $group->getGroups($status);
            foreach ($groupList as $current_group) {
                $group = null;
                $group = file_get_contents('../src/View/backend/groups/group_list_default_code.html');
                $group = str_replace("{GROUP_ADMIN}", $current_group["group_admin"], $group);
                $group = str_replace("{GROUP_ID}", $current_group["id"], $group, $count);
                $group = str_replace("{GROUP_DESCRIPTION}", $current_group["group_description"], $group);
                $group = str_replace("{GROUP_NAME}", $current_group["group_name"], $group);
                $group = str_replace("{CURRENT_USER_EMAIL}", $group_admin, $group);
                $group_list_final_code .= $group;
            }
            $group_list_final_code = str_replace("{GROUP_LIST}", $group_list_final_code, $group_list_final_code);
            $group_list_final_code = "<div>{GROUP_STATUS_TITLE}</div>" . $group_list_final_code;
            if ($status == "open") {
                $group_list_final_code = str_replace("{GROUP_STATUS_TITLE}", "Open", $group_list_final_code);
            } else {
                $group_list_final_code = str_replace("{GROUP_STATUS_TITLE}", "Closed", $group_list_final_code);
            }
        }
        return $group_list_final_code;
    }
}
