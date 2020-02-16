<?php

declare(strict_types=1);

namespace App\Controller;

use App\Tools\SuperGlobals;
use App\View\View;
use App\Model\UserModel;

class UserController
{

    private $view;
    private $userModel;
    private $superGlobals;

    public function __construct()
    {
        $this->view = new View();
        $this->userModel = new UserModel();
        $this->superGlobals = new SuperGlobals();
    }

    // Search User Results Page
    public function searchUserResultsPage()
    {
        $result = $this->userModel->searchUsers($this->superGlobals->getGlobal_Post("searchtext"));
        $this->view->render("searchUserResults", ['results' => $result, 'groupid' => $this->superGlobals->getGlobal_Get("groupid")]);
    }

    // LOGIN VALIDATION FOR THE MAIN LOGIN
    public function loginValidationFunction()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" and $this->superGlobals->testIf_IssetPost("email")) {
            // GET LOGIN INFO FROM USER POST METHOD
            $login_email = $this->superGlobals->getGlobal_Post("email");
            $login_password = $this->superGlobals->getGlobal_Post("password");
            $userModel = $this->userModel->getUserByEmail($login_email);
            if ($userModel != null) {
                foreach ($userModel as $user) {
                    if (password_verify($login_password, $user->getPsw())) {   // IF PASSWORD IS OK
                        //// IMPORTANT
                        //// CREATION DE LA SESSION USER AVEC LES DONNEES EN BD DE L'UTILISATEUR
                        $_SESSION['user'] = $user;
                        header('Location: ../index.php');
                        exit();
                    } else {
                        $this->view->render("login", ['message' => "PASSWORD DO NOT MATCH"]);
                    }
                }
            } else {
                $this->view->render("login", ['message' => "INVALID EMAIL ACCOUNT"]);
            }
        }
    }

    // REGISTER A NEW USER
    public function registerNewUserFunction()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" and $this->superGlobals->testIf_IssetPost("email")) {
            if ($this->testIfEmailExists($this->superGlobals->getGlobal_Get("email"))) {
                $this->view->render("register", ['message' => "MAIL ALREADY EXISTS"]);
            } else {
                $this->userModel->createNewUser();
                header('Location: ../index.php');
                exit();
            }
        }
    }

    // MAIN LOGOUT
    public function logout()
    {
        session_destroy();
        header('Location: ../index.php');
        exit();
    }

    // TEST IF MAIL EXISTS IN THE DATABASE
    public function testIfEmailExists(string $email): bool
    {
        $emailCount = $this->userModel->getEmailCount($email);
        return $emailCount === 0 ? false : true;
    }

}
