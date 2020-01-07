<?php

require 'controller/indexController.php';
require 'controller/commonController.php';
require 'controller/userController.php';

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

        $indexController = new indexController();
        $commonController = new commonController();
        $userController = new userController();

        if (isset($_GET['action'])) {

            // INDEX PAGE
            if ($_GET['action'] == 'index') {
                if (isset($_SESSION["user"])) {
                    $indexController->index();
                } else {
                    $indexController->frontPage();
                }
            }

            // LOGIN PAGE
            if ($_GET['action'] == 'login') {
                if (isset($_SESSION["user"])) {
                    $commonController->login();
                } else {
                    // TODO
                    $commonController->login();
                }
            }

            // REGISTER PAGE
            if ($_GET['action'] == 'register') {
                if (isset($_SESSION["user"])) {
                    $commonController->register();
                } else {
                    // TODO
                    $commonController->register();
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

        } else {


            if (isset($_SESSION["user"])) {
                $indexController->index();
            } else {
                $indexController->frontPage();
            }
        }
    }
}

$router = new Router;
$router->main();
