<?php

declare(strict_types=1);

namespace App\View;

use App\Tools\SuperGlobals;
use App\Model\UserModel;

class View
{

    private $twig;
    private $superGlobals;
    private $userModel;

    public function __construct()
    {
        $this->superGlobals = new SuperGlobals();
        $this->userModel = new UserModel();

        $loader = new \Twig\Loader\FilesystemLoader('../templates');
        $this->twig = new \Twig\Environment($loader, [
            /*'cache' => '/path/to/compilation_cache'*/
        ]);
    }

    public function render(string $template, array $data): void
    {
        if ($this->superGlobals->ISSET_SESSION("user")) {
            // TODO - UPDATE SESSION USER DATA ON EVERY REFRESH OF THE PAGE
            $currentUser = $this->superGlobals->_SESSION("user");
            // FORCES TO UPDATE PROFILE FROM DATABASE EVERY REFRESH OF THE PAGE
            $currentUser = $this->userModel->getUserById((int)$currentUser['id']);
            $data = array_merge($data, ['profile' => $currentUser]);
            echo $this->twig->render('frontend/' . $template . '.html.twig', $data);
        } else {
            echo $this->twig->render('frontend/' . $template . '.html.twig', $data);
        }


    }


}
