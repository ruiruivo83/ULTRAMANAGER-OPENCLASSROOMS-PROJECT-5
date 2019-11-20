<?php

class SessionTestController
{

    public function replaceMenuIfSessionIsOpen($view)
    {  // REPLACE MENU OPTIONS - {LOGIN} {REGISTER} {ADMIN} {USER_INFO}
        $loginURL = file_get_contents('view/backend/loginurl.html');
        $registerURL = file_get_contents('view/backend/registerurl.html');
        // $adminURL = '<a class="nav-link active" href="index.php?action=admin">Admin</a>';
        // IF SESSION IS OPEN
        if (isset($_SESSION["user"])) {
            // $userInfoANDlogout_button = "<i class=\"fas fa-user\"></i> &nbsp;&nbsp; " . $_SESSION['user']->getEmail() ;
            // $userInfoANDlogout_button = "<span class=\"nav-link active\" style=\" color: lightslategrey;\">" . $_SESSION['user']->getEmail() . "</span>";
            $userInfo_button = file_get_contents('view/backend/user_info_default_code.html');
            $userInfo_button = str_replace("{USER_EMAIL}", $_SESSION['user']->getEmail(),  $userInfo_button);
            $logout_button = file_get_contents('view/backend/button_logout.html');
            $view = str_replace("{LOGIN}", "", $view);
            $view = str_replace("{REGISTER}", "", $view);
            // $view = str_replace("{ADMIN}", "", $view);
            $view = str_replace("{USER_INFO}", $userInfo_button, $view);
            $view = str_replace("{LOGOUT}", $logout_button, $view);
        } else {
            // IF SESSION IS NOT OPEN
            $view = str_replace("{LOGIN}", $loginURL, $view);
            $view = str_replace("{REGISTER}", $registerURL, $view);
            // $view = str_replace("{ADMIN}", "", $view);
            $view = str_replace("{USER_INFO}", "", $view);
            $view = str_replace("{LOGOUT}", "", $view);
        }
        return $view;
    }
}
