<?php

declare(strict_types=1);

namespace App\Model;

use PDO;

include "../public/Config.php";

// CLASSE DATABASE
class Database
{
    private static $bdd = null;

    // MAIN DATABASE CONNECTION USED BY ALL METHODS
    public static function getBdd()
    {

        if (self::$bdd == null) {
            $config = new Config;
            self::$bdd = new PDO('mysql:host=localhost; dbname=' . $config->Database_Name, $config->Database_User, $config->Database_Password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        }

        return self::$bdd;
    }

}