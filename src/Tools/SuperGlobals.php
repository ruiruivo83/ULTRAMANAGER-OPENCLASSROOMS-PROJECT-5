<?php

declare(strict_types=1);

namespace App\Tools;


class SuperGlobals
{

    public function testIf_IssetGet(string $var): bool
    {
        if (isset($_GET[$var])) {
            return true;
        } else {
            return false;
        }
    }

    public function testIf_IssetPost(string $var): bool
    {
        if (isset($_POST[$var])) {
            return true;
        } else {
            return false;
        }
    }

    public function testIf_IssetSession(string $var): bool
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
        return $_POST[$var];
    }

    public function getGlobal_Session(string $var): string
    {
        return $_SESSION[$var];
    }


}