<?php

include "config.php";

// CLASSE DATABASE
class Database
{
    private static $bdd = null;

    // MAIN DATABASE CONNECTION USED BY ALL METHODS
    public static function getBdd()
    {

        if (self::$bdd == null) {
            $Config = new config();
            self::$bdd = new PDO('mysql:host=localhost; dbname=' . $Config->Database_Name, $Config->Database_User, $Config->Database_Password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        }

        return self::$bdd;
    }

}
