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

    // DISPLAY PAGE - Create New Group
    public function createGroupPage()
    {
        $this->view->render("creategroup", []);
    }

    // DISPLAY PAGE - My Groups
    public function myGroupsPage()
    {
        $result = $this->groupModel->getMyGroups();
        $this->view->render("mygroups", ['mygroups' => $result]);
    }

    // DISPLAY PAGE - Shared Groups
    public function sharedGroupsPage()
    {
        $sharedGroups = $this->groupModel->getSharedGroupsAndDetails();
        $this->view->render("sharedgroups", ['sharedgroups' => $sharedGroups]);
    }

    private function testForAccess(string $action, int $id): bool
    {
        if ($action == "groupdetails") {
            if ($this->groupModel->testGroupMemberForCurrentUser($id) >= 1 OR $this->groupModel->testGroupAdminForCurrentUser($id) >= 1) {
                return true;
            } else  return false;
        } else {
            header('Location: ../index.php');
            exit();
        }
    }

    // DISPLAY PAGE - Group Details
    public function groupDetailsPage()
    {
        if ($this->testForAccess($this->superGlobals->_GET("action"), (int)$this->superGlobals->_GET("id"))) {
            if ($this->superGlobals->ISSET_GET("ticketsstatus") AND $this->superGlobals->_GET("ticketsstatus") == "closed") {
                if ($this->superGlobals->ISSET_GET("id")) {
                    $groupResult = $this->groupModel->getGroupDetails((int)$this->superGlobals->_GET("id"));
                    $ticketResults = $this->ticketModel->getClosedTicketsWithGroupId((int)$groupResult->getId());
                    $this->view->render("groupdetails", ['group' => $groupResult, 'ticketresults' => $ticketResults]);
                } else {
                    echo "Missing ID";
                    exit();
                }
                exit();
            }
            if ($this->superGlobals->ISSET_GET("id")) {
                $groupResult = $this->groupModel->getGroupDetails((int)$this->superGlobals->_GET("id"));
                $ticketResults = $this->ticketModel->getOpenTicketsWithGroupId((int)$groupResult->getId());

                $this->view->render("groupdetails", ['group' => $groupResult, 'ticketresults' => $ticketResults]);
            } else {
                echo "Missing ID";
                exit();
            }
        } else {
            header('Location: ../index.php');
            exit();
        }
    }

    public function groupMembersPage()
    {
        if ($this->superGlobals->ISSET_GET("groupid")) {
            $groupMembersAndDetails = $this->memberModel->getGroupMembersAndDetails((int)$this->superGlobals->_GET("groupid"));
            $this->view->render("groupmembers", ['memberresults' => $groupMembersAndDetails, 'groupid' => (int)$this->superGlobals->_GET("groupid")]);
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

    public function createGroupFunction()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["Title"]) and isset($_POST["Description"])) {
            $this->groupModel->createNewGroup();
            header('Location: ../index.php?action=mygroups');
            exit();
        }
        header('Location: ../index.php');
        exit();
    }

    public function removeMemberFromGroupFunction()
    {
        if (isset($_GET['groupid']) AND isset($_GET['userid'])) {
            // $req->execute(array($_GET['groupid'], $_GET['userid']));
            $this->groupModel->removeMemberFromGroupfunction((int)($this->superGlobals->_GET("groupid")), (int)($this->superGlobals->_GET("userid")));
            header('Location: ../index.php?action=groupmembers&groupid=' . $_GET['groupid']);
            exit();
        }
        header('Location: ../index.php');
        exit();
    }


}
