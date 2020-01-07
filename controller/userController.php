<?php

// require "controller/sessionController.php";
require "model/user.php";

class UserController
{

    // REGISTER A NEW USER
    public function registerNewUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["email"])) {
            //
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $email = $_POST["email"];
            $country = $_POST["country"];
            $psw = password_hash($_POST["psw"], PASSWORD_DEFAULT);
            //
            $user = new User($firstname, $lastname, $email, $psw, null, null, $country, null, null);
            // Test if email exists in database
            if ($this->testIfEmailExists($email)) {
                $message = '<div class="alert alert-danger " role="alert">YOU ALREADY HAVE AN ACCOUNT</div>';

                $view = file_get_contents('view/frontend/appLayout.html');
                $content = file_get_contents('view/frontend/pagecontent/register.html');
                $commonController = new CommonController();
                $view = $commonController->pageBuilder($view, $content);

                $view = str_replace("<!--{MESSAGEALERT}-->", $message, $view);

                echo $view;
            } else {
                // Add User to Database
                $user->createNewUser();
                header('Location: ../index.php');
            }
        }
    }

    // LOGIN VALIDATION FOR THE MAIN LOGIN
    public function loginValidation()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["email"])) {
            // GET LOGIN INFO FROM USER POST METHOD
            $login_email = $_POST["email"];
            $login_password = $_POST["password"];
            $user = User::getUserByEmail($login_email);
            if ($user != null) {
                if (password_verify($login_password, $user->getPsw())) {   // IF PASSWORD IS OK
                    //// IMPORTANT
                    //// CREATION DE LA SESSION USER AVEC LES DONNEES EN BD DE L'UTILISATEUR   
                    $_SESSION['user'] = $user;
                    header('Location: ../index.php');
                } else {
                    $message = '<div class="alert alert-danger " role="alert">PASSWORD DO NOT MATCH</div>';

                    $view = file_get_contents('view/frontend/appLayout.html');
                    $content = file_get_contents('view/frontend/pagecontent/login.html');
                    $commonController = new CommonController();
                    $view = $commonController->pageBuilder($view, $content);

                    $view = str_replace("<!--{MESSAGEALERT}-->", $message, $view);
                    echo $view;
                }
            } else {
                $message = '<div class="alert alert-danger " role="alert">INVALID EMAIL ACCOUNT</div>';

                $view = file_get_contents('view/frontend/appLayout.html');
                $content = file_get_contents('view/frontend/pagecontent/login.html');
                $commonController = new CommonController();
                $view = $commonController->pageBuilder($view, $content);              

                $view = str_replace("<!--{MESSAGEALERT}-->", $message, $view);
                echo $view;
            }
        }
    }

    // MAIN LOGOUT
    public function logout()
    {
        session_destroy();
        header('Location: ../index.php');
    }

    // TEST IF MAIL EXISTS IN THE DATABASE
    public function testIfEmailExists($email)
    {
        $user = new User(null, null, $email, null, null, null, null, null, null);
        $emailCount = $user->getEmailCount();
        if ($emailCount == 0) {
            $result = false;
            return $result;
        } else {
            $result = true;
            return $result;
        }
    }
}
