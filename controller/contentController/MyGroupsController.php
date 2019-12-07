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

                $current_group = str_replace("{GROUP_ADMIN}", $current_result["group_admin"], $current_group, $count);
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
    public function closeGroup($GroupId)
    {
        // Check if GroupAdmin = Current Session
        $Group = new Groups(null, null, null, null);
        $GroupResult = $Group->GetGroupWithGroupId($GroupId);

        foreach ($GroupResult as $CurrentResult) {
            $Admin  = $CurrentResult["group_admin"];
            $GroupName = $CurrentResult["group_name"];
            if ($Admin == $_SESSION['user']->getEmail()) {
                // Close All tickets inside group
                $Ticket = new Tickets(null, null, null, null, null);
                $status = "open";
                $TicketResult = $Ticket->getGroupTickets($GroupName, $status);
                foreach ($TicketResult as $CurrentResult) {
                    // Close Ticket by ticket_id
                    $Ticket->closeTicket($CurrentResult["id"]);
                }
                // Close group
                $Groups = new Groups(null, null, null, null, null);
                $Groups->closeGroup($GroupId);
                header('Location: ../index.php?action=myopengroups');
            }
        }
    }


    public function GetCompiledMemberList($GroupId)
    {
        // GET GROUP MEMBERS FOR GROUP ID
        $Groups = new Groups(null, null, null, null, null);
        $Result = $Groups->getMembers($GroupId);
        $CompiledMemberList = "";
        foreach ($Result as $CurrentResult) {
            $member = $CurrentResult['member_email'];
            $MemberList =   file_get_contents('view/backend/member_list_default_code.html');
            // ADD REMOVE BUTTON IF USER SESSION IS ADMIN OF THE GROUP, TO THIS MEMBER CODE LINE
            $RemoveThisMemberButton_DefaultCode = file_get_contents('view/backend/RemoveThisMemberFromGroupButton_DefaultCode.html');
            $ArrayObj = $Groups->GetAdminForGroupId($GroupId);
            foreach ($ArrayObj as $CurrentResult) {
                $Admin = $CurrentResult["group_admin"];
            }
            if ($_SESSION['user']->getEmail() == $Admin) {
                $MemberList = str_replace("{REMOVE_THIS_MEMBER_BUTTON}", $RemoveThisMemberButton_DefaultCode, $MemberList);
            } else {
                $MemberList = str_replace("{REMOVE_THIS_MEMBER_BUTTON}", "", $MemberList);
            }
            $MemberList = str_replace("{MEMBER_EMAIL}", $member, $MemberList);
            $MemberList = str_replace("{GROUP_ID}", $GroupId, $MemberList);
            $CompiledMemberList .= $MemberList;
        }
        return  $CompiledMemberList;
    }

    public function GetCompiledSharedGroupList()
    {
        $CompiledMemberList = "";
        // Get current user
        $CurrentUser = $_SESSION['user']->getEmail();
        // GET single list of GROUPID WHERE member_email is $CurrentUser
        $Groups = new Groups(null, null, null, null);
        $Result = $Groups->GetGroupIdListWhereMemberIsCurrentUser();

        // $RESULT LISTS NOW ALL GROUPS ASSIGNED TO CURRENT USER      
        // CHECK IF CURRENT USER IS ADMIN AND REMOVE IT   
        foreach ($Result as $CurrenResult) {
            foreach ($CurrenResult as $CurrentResult) {
                $CurrentGroupId = $CurrenResult["group_id"];
            }
            $CurrentGroupAdmin = $Groups->GetAdminForGroupId($CurrentGroupId);
            if ( $CurrentGroupAdmin != $_SESSION['user']->getEmail()) {
                // GET DEFAULT CODE FOR EACH GROUP ID TO PRESENT TO THE PAGE
                $MemberList =   file_get_contents('view/backend/shared_group_list_default_code.html');
                $MemberList = str_replace("{GROUP_ID}",  $CurrentGroupId, $MemberList);
                // GET GROUP NAME FOR GROUP ID
                $CurrentGroupName = $Groups->GetGroupNameForGroupId($CurrentGroupId);
                foreach ($CurrentGroupName as $CurrentResult) {
                    $CurrentGroupName = $CurrentResult["group_name"];
                    $CurrentGroupAdmin = $CurrentResult["group_admin"];
                }
                $MemberList = str_replace("{GROUP_NAME}",  $CurrentGroupName, $MemberList);
                $MemberList = str_replace("{GROUP_ADMIN}",  $CurrentGroupAdmin, $MemberList);
                $CompiledMemberList .= $MemberList;
            }
        }
        $Result = $CompiledMemberList;
        return $Result;
    }


    public function GetCompiledSharedGroupListForNewTicket()
    {
        $CompiledMemberList = "";
        // Get current user
        $CurrentUser = $_SESSION['user']->getEmail();
        // GET single list of GROUPID WHERE member_email is $CurrentUser
        $Groups = new Groups(null, null, null, null);
        $Result = $Groups->GetGroupIdListWhereMemberIsCurrentUser();
        // $RESULT LISTS NOW ALL GROUPS ASSIGNED TO CURRENT USER      
        // CHECK IF CURRENT USER IS ADMIN AND REMOVE IT   
        foreach ($Result as $CurrenResult) {
            $CurrentGroupId = $CurrenResult["group_id"];
            $CurrentGroupAdmin = $Groups->GetAdminForGroupId($CurrentGroupId);
            foreach ($CurrentGroupAdmin as $CurrentResult) {
                if ($CurrentResult["group_admin"] != $_SESSION['user']->getEmail()) {

                    // GET DEFAULT CODE FOR EACH GROUP ID TO PRESENT TO THE PAGE
                    $MemberList =   file_get_contents('view/backend/shared_group_list_for_new_ticket_default_code.html');
                    $MemberList = str_replace("{GROUP_ID}",  $CurrentGroupId, $MemberList);

                    // GET GROUP NAME FOR GROUP ID
                    $CurrentGroupName = $Groups->GetGroupNameForGroupId($CurrentGroupId);
                    foreach ($CurrentGroupName as $CurrentResult) {
                        $CurrentGroupName = $CurrentResult["group_name"];
                        $CurrentGroupAdmin = $CurrentResult["group_admin"];
                    }
                    $MemberList = str_replace("{GROUP_NAME}",  $CurrentGroupName, $MemberList);
                    $MemberList = str_replace("{GROUP_ADMIN}",  $CurrentGroupAdmin, $MemberList);
                    $CompiledMemberList .= $MemberList;
                } else { }
            }
        }

        $Result = $CompiledMemberList;
        return $Result;
    }
}
