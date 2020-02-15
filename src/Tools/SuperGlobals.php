<?php

declare(strict_types=1);

namespace App\Tools;


class SuperGlobals
{

    public function if_IssetGet(string $var): bool
    {
        if (isset($_GET[$var])) {
            return true;
        } else {
            return false;
        }
    }

    public function if_IssetPost(string $var): bool
    {
        if (isset($_POST[$var])) {
            return true;
        } else {
            return false;
        }
    }

    public function if_IssetSession(string $var): bool
    {
        if (isset($_SESSION[$var])) {
            return true;
        } else {
            return false;
        }
    }

    public function getGlobal_Get(string $var): string
    {
        return $_GET[$var];
    }

    public function getGlobal_Post(string $var): string
    {
        return $_GET[$var];
    }

}