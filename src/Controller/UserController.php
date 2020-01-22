<?php

declare(strict_types=1);

namespace App\Controller;

use App\View\View;
use App\Model\User;

class UserController
{

    // LOGIN VALIDATION FOR THE MAIN LOGIN
    public function loginValidation()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST["email"])) {
            // GET LOGIN INFO FROM USER POST METHOD
            $login_email = $_POST["email"];
            $login_password = $_POST["password"];
            $user = new User(null, null, $login_email, $login_password, null, null, null, null, null);
            $user = $user->getUserByEmail($login_email);
            if ($user != null) {
                if (password_verify($login_password, $user->getPsw())) {   // IF PASSWORD IS OK
                    //// IMPORTANT
                    //// CREATION DE LA SESSION USER AVEC LES DONNEES EN BD DE L'UTILISATEUR   
                    $_SESSION['user'] = $user;
                    header('Location: ../index.php');
                } else {
                    $message = '<div class="alert alert-danger " role="alert">PASSWORD DO NOT MATCH</div>';

                    $appLayout = file_get_contents('../src/view/frontend/appLayout.html');
                    $content = file_get_contents('../src/view/frontend/pagecontent/login.html');
                    $view = new View;
                    $view->pageBuilder(null, $appLayout, $content);

                    $view = str_replace("<!--{MESSAGEALERT}-->", $message, $view);
                    echo $view;
                }
            } else {
                $message = '<div class="alert alert-danger " role="alert">INVALID EMAIL ACCOUNT</div>';

                $appLayout = file_get_contents('../src/view/frontend/appLayout.html');
                $content = file_get_contents('../src/view/frontend/pagecontent/login.html');
                $view = new View;
                $view->pageBuilder(null, $appLayout, $content);              

                // $view = str_replace("<!--{MESSAGEALERT}-->", $message, $view);
                // echo $view;
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
                 $content = file_get_contents('../src/view/frontend/pagecontent/register.html');
                 $view = new View;
                 $view->pageBuilder(null, $content, null); 
                 // $view = str_replace("<!--{MESSAGEALERT}-->", $message, $view); 
                 // echo $view;
             } else {
                 // Add User to Database
                 $user->createNewUser();
                 header('Location: ../index.php');
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
    public function testIfEmailExists(string $email):bool
    {
        $user = new User(null, null, $email, null, null, null, null, null, null);
        $emailCount = $user->getEmailCount();
        return $emailCount === 0 ? false : true;
        // return $emailCount === 0 ? false : true;
    }
}
