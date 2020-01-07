<?php

require 'controller/indexController.php';
require 'controller/commonController.php';
require 'controller/userController.php';
require 'controller/profileController.php';
require 'controller/activityLogController.php';
require 'controller/settingsController.php';


// ROUTER FOR INDEX PAGE
class Router
{
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // ROUTER MAIN FUNCTION
    public function main()
    {

        $indexController = new IndexController();
        $commonController = new CommonController();
        $userController = new UserController();
        $profileController = new ProfileController();
        $activityLogController = new activityLogController();
        $settingsController = new SettingsController();


        // FOR TEST
        /*
        if (isset($_SESSION["user"])) {
            echo ("SESSION IS OPEN");
            die;
        } else {
            echo ("SESSION IS CLOSED");
            die;
        }
        */


        if (isset($_GET['action'])) {

            // LOGIN PAGE
            if ($_GET['action'] == 'login') {
                $commonController->login();
            }

            // REGISTER PAGE
            if ($_GET['action'] == 'register') {
                $commonController->register();
            }

            // INDEX PAGE
            if ($_GET['action'] == 'index') {
                if (isset($_SESSION["user"])) {
                    $indexController->dashboard();
                } else {
                    header('Location: ../index.php');
                }
            }

            // ACTIVITY LOG PAGE
            if ($_GET['action'] == 'activitylog') {
                if (isset($_SESSION["user"])) {
                    $activityLogController->activityLog();
                } else {
                    // TODO
                    header('Location: ../index.php');
                }
            }

            // PROFILE PAGE
            if ($_GET['action'] == 'profile') {
                if (isset($_SESSION["user"])) {
                    $profileController->profile();
                } else {
                    header('Location: ../index.php');
                }
            }

            // SETTINGS PAGE
            if ($_GET['action'] == 'settings') {
                if (isset($_SESSION["user"])) {
                    $settingsController->settings();
                } else {
                    header('Location: ../index.php');
                }
            }

            ////////////////////////////////////////////////////////////////////
            ////////////////////// ROUTER FUNCTIONS ////////////////////////////
            ////////////////////////////////////////////////////////////////////

            // LOGOUT FUNCTION
            if ($_GET['action'] == 'logout') {
                if (isset($_SESSION["user"])) {
                    $userController->logout();
                } else {
                    header('Location: ../index.php');
                }
            }

            // LOGIN VALIDATION FUNCTION
            if (!isset($_SESSION["user"])) {
                if ($_GET['action'] == 'login_validation') {
                    $userController->loginValidation();
                }
            }

            // REGISTER NEW USER FUNCTION
            if (!isset($_SESSION["user"])) {
                if ($_GET['action'] == 'registernewuser') {
                    $userController->registerNewUser();
                }
            }
        } else  if (isset($_SESSION["user"])) {
            $indexController->dashboard();
        } else {
            $indexController->frontPage();
        }
    }
}


$router = new Router;
$router->main();
