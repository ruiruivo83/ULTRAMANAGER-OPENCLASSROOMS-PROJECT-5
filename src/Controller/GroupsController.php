<?php

declare(strict_types=1);

namespace App\Controller;

use App\View\View;
use App\Model\GroupModel;
use App\Model\TicketModel;

class GroupsController
{
    private $view;
    private $groupModel;
    private $ticketModel;

    public function __construct()
    {
        $this->view = new View();
        $this->groupModel = new GroupModel();
        $this->ticketModel = new TicketModel();
    }

    // DISPLAY PAGE - My Groups
    public function myGroupsPage()
    {
        $result = $this->groupModel->getMyGroups();
        $this->view->render("groups", ['groups' => $result]);
    }


    // DISPLAY PAGE - Group Details
    public function groupDetailsPage()
    {
        if (isset($_GET['id'])) {
            $groupModel = $this->groupModel->getGroupDetails(intval($_GET['id']));
            foreach ($groupModel as $value) {
                $result = $this->ticketModel->getTicketsWithGroupId($value->getId());
            }
            $this->view->render("groupdetails", ['groupdetails' => $result]);
        } else {
            echo "Missiong ID";
            exit();
        }
    }

    // DISPLAY PAGE - TICKET DETAILS
    public function groupMembersPage()
    {

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
        $this->view->render("globalgroups", ['groups' => $result]);
    }

    public function createGroupPage()
    {

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

}
