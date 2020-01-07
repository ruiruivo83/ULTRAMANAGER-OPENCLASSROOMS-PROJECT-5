<?php

class indexController
{

    public function index()
    {
        $view = file_get_contents('view/frontend/appLayout.html');
        echo $view;
    }

    public function frontPage()
    {
        $view = file_get_contents('view/frontend/frontPage.html');
        echo $view;
    }

}
