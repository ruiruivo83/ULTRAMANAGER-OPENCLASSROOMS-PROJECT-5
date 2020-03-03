<?php

declare(strict_types=1);

namespace App\Tools;

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

    public function ISSET_FILES(string $var): bool
    {
        if (isset($_FILES[$var])) {
            return true;
        } else {
            return false;
        }
    }

    public function _GET(string $var): string
    {
        return htmlentities($_GET[$var]);
    }

    public function _POST(string $var): string
    {
        return htmlentities($_POST[$var]);
    }

    public function _SESSION(string $var): array
    {
        return $_SESSION[$var];
    }

    public function SET_USER_SESSION(array $var): void
    {
        $_SESSION['user'] = $var;
    }

    public function getGlobal_Server(string $var): string
    {
        return htmlentities($_SERVER[$var]);
    }


}