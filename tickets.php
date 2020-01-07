<?php

// ROUTER FOR TICKETS PAGE
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

        if (isset($_GET['tickets'])) {      
          
            if ($_GET['action'] == 'index') {
             
            }

        } else {
           
        }
    }
}


$router = new Router;
$router->main();
