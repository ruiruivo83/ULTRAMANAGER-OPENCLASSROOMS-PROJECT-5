<?php

// ROUTER FOR PROFIL PAGE
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

        if (isset($_GET['action'])) {      
          
            if ($_GET['action'] == 'profil') {
             
            }

        } else {
           
        }
    }
}


$router = new Router;
$router->main();
