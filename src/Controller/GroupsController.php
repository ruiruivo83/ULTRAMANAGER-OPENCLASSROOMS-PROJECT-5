<?php

declare(strict_types=1);

namespace App\Controller;

use App\View\View;
use App\Model\GroupModel;
use App\Model\TicketModel;

class GroupsController
{

    public function groups()
    {
        // TODO        
        $contentTitle = "Groups";
        $view = new View;

        // DEFINE AND BUILD BUTTONS TO SHOW
        $buttons = "";
        $buttons .= $view->buttonsBuilder("Create New Group", "../index.php?action=creategroup");

        // BUILD CONTENT
        $content = $view->groupContentBuilder($contentTitle, $buttons);

        // GET MY GROUPS
        $groupModel = new GroupModel();
        $result = $groupModel->getMyGroups();

        // var_dump($result);
        // die;

        $total = count($result);
        $compiledArray = array();

        // NOT NECESSARY IF TO REBUILD THE $view->htmlTableBuilder() method
        for ($i = 0; $i < $total; $i++) {
            foreach ($result as $value) {
                $currentArray = array($value->getId(), $value->getGroup_admin(), $value->getCreation_date(), $value->getGroup_name(), $value->getGroup_description(), $value->getGroup_status(), $value->getGroup_status());
                $compiledArray[$i] = $currentArray;
                $i++;
            }
        }

        $view = new View;
        
        // $view->render('listgroup', ['groups' => $result, 'ticket' => $ticket ]);


        $htmlTableIndex = ["id", "Group Admin", "Creation Date", "Groupe Name", "Description", "Status"];
        $content = str_replace("{HTML_TABLE_RESULT}", $view->htmlTableBuilder($htmlTableIndex, $compiledArray), $content);

        // SEND HTML TABLE RESULT TO THE VIEW
        $view->pageBuilder(null, $content, $contentTitle);
    }

    function objToArray($obj, $arr): array
    {

        if (!is_object($obj) && !is_array($obj)) {
            $arr = $obj;
            return $arr;
        }

        foreach ($obj as $key => $value) {
            if (!empty($value)) {
                $arr[$key] = array();
                $this->objToArray($value, $arr[$key]);
            } else {
                $arr[$key] = $value;
            }
        }
        return $arr;
    }

    // DISPLAY TICKET DETAILS PAGE
    public function groupDetails()
    {

        if (isset($_GET['id'])) {

            $groupModel = new GroupModel();
            $ticketModel = new TicketModel(null, null, null, null, null, null, null, null, null);

            $view = new View();

            $id = $_GET['id'];

            $contentTitle = "Group Details";

            // DEFINE BUTTONS TO SHOW
            $buttons = "";
            $buttons .= $view->buttonsBuilder("Close Group", "../index.php?action=closegroup&id=" . $id);

            // BUILD CONTENT
            $content = $view->groupContentBuilder($contentTitle, $buttons);

            // REPLACE {HTML_TABLE_RESULT} BY TICKET DETAILS PAGE
            $groupDetailsContentPage = file_get_contents('../src/View/backend/content/groupdetails.html');
            $content = str_replace("{HTML_TABLE_RESULT}",  $groupDetailsContentPage, $content);

            // GET GROUP DETAILS

            $groupModel = $groupModel->getGroupDetails(intval($id));


      
            // REPLACE TICKET DETAILS
            foreach ($groupModel as $value) {
                // {ID}            
                $content = str_replace("{GROUP_ID}",  $value->getId(), $content);

                // {TICKET_TITLE}
                $content = str_replace("{GROUP_TITLE}",  $value->getGroup_name(), $content);

                // {GROUP_ADMIN}
                $content = str_replace("{GROUP_ADMIN}",  $value->getGroup_admin(), $content);

                // {GROUP_STATUS}
                $content = str_replace("{GROUP_STATUS}",  $value->getGroup_status(), $content);

                // {CREATION_DATE}
                $content = str_replace("{CREATION_DATE}",  $value->getCreation_Date(), $content);

                // {DESCRIPTION}
                $content = str_replace("{DESCRIPTION}",  $value->getGroup_description(), $content);

                // {MY_GROUP_LIST}
                $content = str_replace("{MY_GROUP_LIST}",  "<option>#" . $value->getId() . ", " .  $value->getGroup_name() . "</option>", $content);
            }
            // {TICKET_LIST}

            $result = $ticketModel->getTicketsWithGroupId($value->getId());



            $htmlTableIndex = ["id", "author", "requester", "status", "creation_date", "title", "description",  "group_id", "close_date"];
            $content = str_replace("{TICKET_LIST}", $view->htmlTableBuilder($htmlTableIndex, $result), $content);

            $view->pageBuilder(null, $content, $contentTitle);
        } else {
            echo "Missiong ID";
            die;
        }
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
        $view = new View;

        // DEFINE AND BUILD BUTTONS TO SHOW
        $buttons = "";
        $buttons .= $view->buttonsBuilder("Create New Group", "../index.php?action=creategroup");
        // BUILD CONTENT
        $content = $view->groupContentBuilder($contentTitle, $buttons);

        // GET MY GROUPS
        $groupModel = new GroupModel();
        $myGroups = $groupModel->getAllGroups();


        $total = count($myGroups);
        $compiledArray = array();


        // NOT NECESSARY IF TO REBUILD THE $view->htmlTableBuilder() method
        for ($i = 0; $i < $total; $i++) {
            foreach ($myGroups as $group) {
                $currentArray = array($group->getId(), $group->getGroup_admin(), $group->getCreation_date(), $group->getGroup_name(), $group->getGroup_description(), $group->getGroup_status(), $group->getGroup_status());
                $compiledArray[$i] = $currentArray;
                $i++;
            }
        }


        // GET HTML TABLE TO SHOW
        $view = new View;
        $htmlTableIndex = ["id", "group_admin", "creation_date", "group_name", "group_description", "group_status"];
        $content = str_replace("{HTML_TABLE_RESULT}", $view->htmlTableBuilder($htmlTableIndex, $compiledArray), $content);

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
            $GroupModel = new GroupModel(null, $group_admin, null, $title, $description, $group_status);
            // Execute method addTicket
            $GroupModel->createNewGroup();
            header('Location: ../index.php?action=groups');
            // exit();
        }
    }

    /*
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
    */
}
