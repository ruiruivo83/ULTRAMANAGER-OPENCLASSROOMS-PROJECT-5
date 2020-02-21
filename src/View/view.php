<?php

declare(strict_types=1);

namespace App\View;

use App\Tools\SuperGlobals;

class View
{

    private $twig;
    private $superGlobals;

    public function __construct()
    {
        $this->superGlobals = new SuperGlobals();

        $loader = new \Twig\Loader\FilesystemLoader('../templates');
        $this->twig = new \Twig\Environment($loader, [
            /*'cache' => '/path/to/compilation_cache'*/
        ]);
    }

    public function render(string $template, array $data): void
    {
        if ($this->superGlobals->ISSET_SESSION("user")) {
            // TODO - UPDATE SESSION USER DATA ON EVERY REFRESH OF THE PAGE
            $userSessionInfo = $this->superGlobals->_SESSION("user");
            $data = array_merge($data, ['profile' => $userSessionInfo]);
            echo $this->twig->render('frontend/' . $template . '.html.twig', $data);
        } else {
            echo $this->twig->render('frontend/' . $template . '.html.twig', $data);
        }


    }


}
