<?php

declare(strict_types=1);

namespace App\Controller;

use App\View\View;
use App\Model\GroupModel;
use App\Model\TicketModel;
use App\Model\MemberModel;

class GroupsController
{
    private $view;
    private $groupModel;
    private $memberModel;
    private $ticketModel;

    public function __construct()
    {
        $this->view = new View();
        $this->groupModel = new GroupModel();
        $this->memberModel = new MemberModel();
        $this->ticketModel = new TicketModel();
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
            $this->view->render("groupmembers", ['memberresults' => $groupMembers]);
        } else {
            echo "Missing Group ID";
            exit();
        }
    }

    // DISPLAY PAGE - Ticket Details
    public function myGroupMembersPage()
    {
        echo "MyGroupMembers Page";
        die();
        $result = $this->groupModel->getMyGroupMembers();
        foreach ($result as $mygroup) {
            // getmembers
            //merge with my members all list
        }
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
            $title = $_POST["Title"];
            $description = $_POST["Description"];
            $group_admin = $_SESSION['user']->getEmail();
            $group_status = "open";
            // INSERT INTO DATABASE
            // Create class instance
            $GroupModel = new GroupModel(null, $group_admin, null, $title, $description, $group_status);
            // Execute method addTicket
            $GroupModel->createNewGroup();
            header('Location: ../index.php?action=mygroups');
            // exit();
        }
    }

}
