<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\User;
use App\View\View;
use App\Model\GroupModel;
use App\Model\UserModel;
use App\Model\TicketModel;
use App\Model\MemberModel;

class GroupsController
{
    private $view;
    private $groupModel;
    private $memberModel;
    private $ticketModel;
    private $userModel;

    public function __construct()
    {
        $this->view = new View();
        $this->groupModel = new GroupModel();
        $this->memberModel = new MemberModel();
        $this->ticketModel = new TicketModel();
        $this->userModel = new UserModel();
    }

    // DISPLAY PAGE - My Groups
    public function myGroupsPage()
    {
        $result = $this->groupModel->getMyGroups();
        $this->view->render("mygroups", ['results' => $result]);
    }

    // DISPLAY PAGE - Group Details
    public function groupDetailsPage()
    {
        if (isset($_GET['id'])) {
            $groupResult = $this->groupModel->getGroupDetails(intval($_GET['id']));
            foreach ($groupResult as $group) {
                $ticketResults = $this->ticketModel->getTicketsWithGroupId($group->getId());
            }
            var_dump($ticketResults);
            $this->view->render("groupdetails", ['groupresults' => $groupResult, 'ticketresults' => $ticketResults]);
        } else {
            echo "Missing ID";
            exit();
        }
    }

    public function groupMembersPage()
    {
        if (isset($_GET['groupid'])) {
            $groupMembers = $this->memberModel->getGroupMembers(intval($_GET['groupid']));
            $memberDetailsResults = array();
            foreach ($groupMembers as $member) {
                $memberDetailsResults = array_merge($memberDetailsResults, $this->userModel->getUserById(intval($member->getId())));
            }


            $this->view->render("groupmembers", ['memberresults' => $memberDetailsResults, 'groupid' => intval($_GET['groupid'])]);
        } else {
            echo "Missing Group ID";
            exit();
        }
    }

    // DISPLAY PAGE - Ticket Details
    public function myGroupMembersPage()
    {
        $result = $this->groupModel->getMyGroupMembers();
        /*
        foreach ($result as $mygroup) {
            // getmembers
            // merge with my members all list
        }
        */
        $this->view->render("mygroups", ['results' => $result]);
    }

    public function memberDetails()
    {

    }

    public function sharedGroupsPage()
    {

    }

    public function globalGroupsPage()
    {
        $result = $this->groupModel->getAllGroups();
        $this->view->render("globalgroups", ['results' => $result]);
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

}
