<?php

declare(strict_types=1);

namespace App\Controller;

use App\View\View;
use App\Model\UserModel;

class UserController
{

    private $view;

    public function __construct()
    {
        $this->view = new View();
    }

    // LOGIN VALIDATION FOR THE MAIN LOGIN
    public function loginValidation()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["email"])) {
            // GET LOGIN INFO FROM USER POST METHOD
            $login_email = $_POST["email"];
            $login_password = $_POST["password"];
            $userModel = new UserModel();
            $userModel = $userModel->getUserByEmail($login_email);
            //
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
    public function registerNewUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["email"])) {
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $email = $_POST["email"];
            $country = $_POST["country"];
            $psw = password_hash($_POST["psw"], PASSWORD_DEFAULT);
            $user = new User($firstname, $lastname, $email, $psw, null, null, $country, null, null);
            // Test if email exists in database
            if ($this->testIfEmailExists($email)) {
                $message = '<div class="alert alert-danger " role="alert">YOU ALREADY HAVE AN ACCOUNT</div>';
                $view = file_get_contents('../src/view/frontend/appLayout.html');
                $content = file_get_contents('../src/view/frontend/pagecontent/register.html.twig');
                $view = new View;
                $view->pageBuilder(null, $content, null);
                $view = str_replace("<!--{MESSAGEALERT}-->", $message, $view);
                echo $view;
            } else {
                // Add User to Database
                $user->createNewUser();
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
        $user = new User(null, null, $email, null, null, null, null, null, null);
        $emailCount = $user->getEmailCount();
        return $emailCount === 0 ? false : true;
    }
}
