<?php

require 'model/Groups.php';

class MyGroupsController
{
    public function addGroup()
    {
        if (isset($_SESSION['user'])) {
            if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["Title"]) and isset($_POST["Description"])) {
                $Title = $_POST["Title"];
                $Description = $_POST["Description"];
                $Admin = $_SESSION['user']->getEmail();
                // INSERT INTO DATABASE
                // Create class instance
                $Groups = new Groups(null, null, null, null, null);
                // Execute method addTicket
                $Groups->addGroup($Title, $Description, $Admin);
                header('Location: ../index.php?action=myopengroups');
                // exit();
            }
        }
    }

    // REPLACE TICKET LIST AREA IN THE HTML BY ALL AVAILABLE POSTS
    public function ReplaceGroupList($view, $status)
    {

        $group_list_final_code = null;
        $Author = $_SESSION['user']->getEmail();
        if (isset($_SESSION['user'])) {
            $group = new groups(null, null, null, null, null);
            $result = $group->getMygroups($status); // FROM MODEL

            foreach ($result as $current_result) {
                $current_group = null;
                if ($status == "open") {
                    $current_group = file_get_contents('view/backend/group_list_default_code.html');
                } else {

                    $current_group = file_get_contents('view/backend/closed_group_list_default_code.html');
                }
                $current_group = str_replace("{GROUP_ID}", $current_result["id"], $current_group, $count);
                // $current_group = str_replace("{REQUESTER_NAME}", $current_result["requester"], $current_group, $count);
                $current_group = str_replace("{GROUP_DESCRIPTION}", $current_result["group_description"], $current_group);
                $current_group = str_replace("{GROUP_NAME}", $current_result["group_name"], $current_group);
                // $current_group = str_replace("{INTERVENTION_CARD}", $this->ReplaceInterventionList($current_result["id"], null), $current_group);
                // $current_group = str_replace("{LAST_INTERVENTION}", $this->ReplaceInterventionList($current_result["id"], 1), $current_group);
                $current_group = str_replace("{CURRENT_USER_EMAIL}", $Author, $current_group);
                $group_list_final_code .= $current_group;
            }
            $view = str_replace("{GROUP_LIST}", $group_list_final_code, $view);
        }

        return $view;
    }


    // CLOSE GROUP
    public function closeGroup($groupid)
    {
        $Groups = new Groups(null, null, null, null, null);        
        $Groups->closeGroup($groupid);
        header('Location: ../index.php?action=myopengroups');
    }
}
