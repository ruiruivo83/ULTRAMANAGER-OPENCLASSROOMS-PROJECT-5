<?php

declare(strict_types=1);

namespace App\Model;

// COMPOSER AUTOLOAD
require '../vendor/autoload.php';

// ROUTER FOR CONFIG PAGE
class Config
{
    // LOCAL DATABASE
    public $Database_Name = "power";
    public $Database_User = "root";
    public $Database_Password = "";
}

/*

// REMOTE DATABASE
    public $Database_Name = "powermanager";
    public $Database_User = "p5root";
    public $Database_Password = "ycvms74b";
 */
