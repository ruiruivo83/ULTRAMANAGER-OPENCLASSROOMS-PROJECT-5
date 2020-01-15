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

        // DEFINE BUTTONS TO SHOW
        $buttons = "";
        $buttons .= $commonController->buttonsBuilder("Create New Group", "../index.php?action=creategroup");

        // BUILD CONTENT
        $content = $commonController->contentBuilder($contentTitle, $buttons);


        // GET OPEN GROUPS
        $content = str_replace(" {OPEN_GROUP_CONTENT}", $this->replaceGroupList("open"), $content);

        // GET CLOSED GROUPS
        $content = str_replace(" {CLOSED_GROUP_CONTENT}", $this->replaceGroupList("closed"), $content);

        // FINAL RENDER OF THE FULL CONTENT
        $view = new View;
        $view->pageBuilder(null, $content, $contentTitle);

        echo $view;
    }

    public function groupMembers()
    {

        $contentTitle = "Group Members";
        // TODO
        $content = "";
        $commonController = new CommonController();
        $view = new View;
        $view->pageBuilder(null, $content, $contentTitle);

        echo $view;
    }

    public function memberDetails()
    {

        $contentTitle = "Member Details";
        // TODO
        $content = "";
        $commonController = new CommonController();
        $view = new View;
        $view->pageBuilder(null, $content, $contentTitle);

        echo $view;
    }

    public function sharedGroups()
    {

        $contentTitle = "Shared Groups";
        // TODO
        $content = "";
        $commonController = new CommonController();
        $view = new View;
        $view->pageBuilder(null, $content, $contentTitle);

        echo $view;
    }

    public function sharedGroupMembers()
    {

        $contentTitle = "Shared Group Members";
        // TODO
        $content = "";
        $commonController = new CommonController();
        $view = new View;
        $view->pageBuilder(null, $content, $contentTitle);

        echo $view;
    }

    public function sharedMemberDetails()
    {

        $contentTitle = "Shared Member Details";
        // TODO
        $content = "";
        $commonController = new CommonController();
        $view = new View;
        $view->pageBuilder(null, $content, $contentTitle);

        echo $view;
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
        // TODO
        $content = "";
        $commonController = new CommonController();

        $view = new View;
        $view->pageBuilder(null, $content, $contentTitle);

        echo $view;
    }

    public function createGroup()
    {
        $contentTitle = "Create New Group";
        // TODO
        $content = file_get_contents('view/backend/content/newgroup.html');
        $content = str_replace("{GROUP_TYPE}", "Private Group", $content);
        $commonController = new CommonController();
        $view = new View;
        $view->pageBuilder(null, $content, $contentTitle);

        echo $view;
    }

    public function createGroupFunction()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["Title"]) and isset($_POST["Description"])) {
            $title = $_POST["Title"];
            $description = $_POST["Description"];
            $group_admin = $_SESSION['user']->getEmail();
            $status = "open";
            // INSERT INTO DATABASE
            // Create class instance
            $Group = new Group(null, $group_admin, null, $title, $description, $status);
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
                $group = file_get_contents('view/backend/groups/group_list_default_code.html');
                $group = str_replace("{GROUP_ADMIN}", $current_group["group_admin"], $group);
                $group = str_replace("{GROUP_ID}", $current_group["id"], $group, $count);
                $group = str_replace("{GROUP_DESCRIPTION}", $current_group["description"], $group);
                $group = str_replace("{GROUP_NAME}", $current_group["title"], $group);
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
