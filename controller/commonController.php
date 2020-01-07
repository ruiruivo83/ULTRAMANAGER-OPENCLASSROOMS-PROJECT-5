<?php


class commonController
{

    public function login()
    {
        $view = file_get_contents('view/frontend/login.html');
        echo $view;
    }

    public function register()
    {
        $view = file_get_contents('view/frontend/register.html');
        echo $view;
    }

}
