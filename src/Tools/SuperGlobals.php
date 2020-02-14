<?php

declare(strict_types=1);

namespace App\Tools;


class SuperGlobals
{

    public function testIfIsset(string $var): bool
    {
        if (isset($_GET[$var])) {
            return true;
        } else {
            return false;
        }
    }

    public function getGlobalGet(string $var): string
    {
        return $_GET[$var];
    }

    public function getGlobalPost(string $var): string
    {
        return $_GET[$var];
    }

}