<?php

declare(strict_types=1);

namespace App\Tools;


use mysql_xdevapi\DatabaseObject;

class SuperGlobals
{

    public function ISSET_GET(string $var): bool
    {
        if (isset($_GET[$var])) {
            return true;
        } else {
            return false;
        }
    }

    public function ISSET_POST(string $var): bool
    {
        if (isset($_POST[$var])) {
            return true;
        } else {
            return false;
        }
    }

    public function ISSET_SESSION(string $var): bool
    {
        if (isset($_SESSION[$var])) {
            return true;
        } else {
            return false;
        }
    }

    public function _GET(string $var): string
    {
        return $_GET[$var];
    }

    public function _POST(string $var): string
    {
        return $_POST[$var];
    }

    public function _SESSION(string $var): object
    {
        return $_SESSION[$var];
    }

    public function getGlobal_Server(string $var): string
    {
        return $_SERVER[$var];
    }


}