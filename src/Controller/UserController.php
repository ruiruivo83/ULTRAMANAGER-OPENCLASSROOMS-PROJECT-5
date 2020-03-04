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

    // DISPLAY PAGE - My Profile
    public function userProfilePage()
    {
        $currentUserId = (int)$this->superGlobals->_SESSION("user")['id'];
        $currentUser = $this->userModel->getUserById((int)$currentUserId);
        $this->view->render("userprofile", ['results' => $currentUser]);
    }

    // Search User Results Page
    public function searchUserResultsPage()
    {
        $result = $this->userModel->searchUsers($this->superGlobals->_POST("searchtext"));
        $this->view->render("searchUserResults", ['results' => $result, 'groupid' => $this->superGlobals->_GET("groupid")]);
    }

    // LOGIN VALIDATION FOR THE MAIN LOGIN
    public function loginValidationFunction()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" and $this->superGlobals->ISSET_POST("email")) {
            // GET LOGIN INFO FROM USER POST METHOD
            $login_email = $this->superGlobals->_POST("email");
            $login_password = $this->superGlobals->_POST("password");

            if ($this->userModel->getEmailCount($login_email) == 1) {
                $currentUser = $this->userModel->getUserByEmail($login_email);
                if ($currentUser != null) {
                    if (password_verify($login_password, $currentUser['psw'])) {   // IF PASSWORD IS OK
                        //// IMPORTANT
                        //// CREATION DE LA SESSION USER AVEC LES DONNEES EN BD DE L'UTILISATEUR
                        $_SESSION['user'] = $currentUser;
                        header('Location: ../index.php');
                        exit();
                    } else {
                        $this->view->render("login", ['message' => "PASSWORD DO NOT MATCH"]);
                    }
                    // }
                } else {
                    $this->view->render("login", ['message' => "INVALID EMAIL ACCOUNT"]);
                }
            } else {
                $this->view->render("login", ['message' => "INVALID EMAIL ACCOUNT"]);
            }

        }
    }

    // REGISTER A NEW USER
    public function registerNewUserFunction()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" and $this->superGlobals->ISSET_POST("email")) {
            if ($this->testIfEmailExists($this->superGlobals->_POST("email"))) {
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

    public function addAvatarToUserProfile()
    {
        if (isset($_FILES['image'])) {
            $errors = array();
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];

            $string = explode('.', $_FILES['image']['name']);
            $date = date("Y-m-d h:i:sa");
            $string[0] = $date . $string[0];
            $string[0] = preg_replace("/[^A-Za-z0-9]/", "", $string[0]);
            $file_ext = strtolower(end($string));
            $extensions = array("jpeg", "jpg", "png");

            if (in_array($file_ext, $extensions) === false) {
                $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
            }
            if ($file_size > 2097152) {
                $errors[] = 'File size must be excately 2 MB';
            }
            $rand = rand(0, 1000);
            $fileName = "photo" . $string[0] . "_" . $rand . "." . $string[1];
            if (empty($errors) == true) {
                move_uploaded_file($file_tmp, "upload_files/" . $fileName);
                $this->userModel->atachPhotoFileNameToUser((int)$_SESSION['user']['id'], $fileName);
                header("Location: ../index.php?action=userprofile");
                exit();
            } else {
                header("Location: ../index.php");
                exit();
            }
        } else {
            header("Location: ../index.php?action=userprofile");
            exit();
        }
    }

    public function saveCompanyAndCountryFunction()
    {
        $country = $this->superGlobals->_POST("country");
        $company = $this->superGlobals->_POST("company");
        $userId = (int)$this->superGlobals->_SESSION("user")['id'];
        $this->userModel->saveCompanyAndCountryFunction($country, $company, $userId);
        header("Location: ../index.php?action=userprofile");
        exit();
    }


}
