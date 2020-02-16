<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\User;
use App\View\View;
use App\Model\GroupModel;
use App\Model\UserModel;
use App\Model\TicketModel;
use App\Model\MemberModel;
use App\Tools\SuperGlobals;

class GroupsController
{
    private $view;
    private $groupModel;
    private $memberModel;
    private $ticketModel;
    private $userModel;
    private $superGlobals;

    public function __construct()
    {
        $this->view = new View();
        $this->groupModel = new GroupModel();
        $this->memberModel = new MemberModel();
        $this->ticketModel = new TicketModel();
        $this->userModel = new UserModel();
        $this->superGlobals = new SuperGlobals();
    }

    // DISPLAY PAGE - My Groups
    public function myGroupsPage()
    {
        $result = $this->groupModel->getMyGroups();
        $this->view->render("mygroups", ['results' => $result]);
    }

    // DISPLAY PAGE - Shared Groups
    public function sharedGroupsPage()
    {
        $result = $this->groupModel->getSharedGroups();
        $finalArray = array();
        foreach ($result as $key) {
            $finalArray = array_merge($finalArray, $this->groupModel->getGroupDetails(intval($key['group_id'])));
        }
        $this->view->render("sharedgroups", ['results' => $finalArray]);
    }


    // DISPLAY PAGE - Group Details
    public function groupDetailsPage()
    {
        if ($this->superGlobals->if_IssetGet("id")) {
            $groupResult = $this->groupModel->getGroupDetails((int)$this->superGlobals->getGlobal_Get("id"));
            foreach ($groupResult as $group) {
                $ticketResults = $this->ticketModel->getTicketsWithGroupId($group->getId());
            }
            $this->view->render("groupdetails", ['groupresults' => $groupResult, 'ticketresults' => $ticketResults]);
        } else {
            echo "Missing ID";
            exit();
        }
    }

    public function groupMembersPage()
    {
        if ($this->superGlobals->if_IssetGet("groupid")) {
            $groupMembers = $this->memberModel->getGroupMembers((int)$this->superGlobals->getGlobal_Get("groupid"));
            $memberDetailsResults = array();
            foreach ($groupMembers as $member) {
                $memberDetailsResults = array_merge($memberDetailsResults, $this->userModel->getUserById(intval($member->user_id)));
            }
            $this->view->render("groupmembers", ['memberresults' => $memberDetailsResults, 'groupid' => (int)$this->superGlobals->getGlobal_Get("groupid")]);
        } else {
            echo "Missing Group ID";
            exit();
        }
    }

    // DISPLAY PAGE - Ticket Details
    public function myGroupMembersPage()
    {
        $result = $this->groupModel->getMyGroupMembers();
        $this->view->render("mygroups", ['results' => $result]);
    }

    public function globalGroupsPage()
    {
        $finalArray = array();
        $finalTable = array();

        // GET MY GROUPS
        $myGroups = $this->groupModel->getMyGroups();
        foreach ($myGroups as $myGroup) {
            array_push($finalArray, $myGroup->getId());
        }

        // GET SHARED GROUPS
        $sharedGroups = $this->groupModel->getSharedGroups();
        foreach ($sharedGroups as $sharedGroup) {
            array_push($finalArray, $sharedGroup['group_id']);
        }

        // JOIN BOTH MY GROUPS AND GLOBAL GROUPS
        foreach ($finalArray as $id) {
            // var_dump($id);
            // var_dump($this->groupModel->getGroupDetails(intval($id)));
            $finalTable = array_merge($finalTable, $this->groupModel->getGroupDetails(intval($id)));
        }

        $this->view->render("globalgroups", ['results' => $finalTable]);
    }

    public function createGroupPage()
    {
        $this->view->render("creategroup", []);
    }

    public function createGroupFunction()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["Title"]) and isset($_POST["Description"])) {
            $this->groupModel->createNewGroup();
            header('Location: ../index.php?action=mygroups');
            exit();
        }
    }

    public function removeMemberFromGroupFunction()
    {
        if (isset($_GET['groupid']) AND isset($_GET['userid'])) {
            // $req->execute(array($_GET['groupid'], $_GET['userid']));
            $this->groupModel->removeMemberFromGroupfunction((int)($this->superGlobals->getGlobalGet('groupid')), (int)($this->superGlobals->getGlobalGet('userid')));
            header('Location: ../index.php?action=groupmembers&groupid=' . $_GET['groupid']);
            exit();
        }
    }

}
