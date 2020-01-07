<?php

// ROUTER FOR ROUTER PAGE
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

        if (isset($_GET['groups'])) {      
          
            if ($_GET['action'] == 'index') {
             
            }

        } else {
           
        }
    }
}


$router = new Router;
$router->main();
