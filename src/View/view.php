<?php

declare(strict_types=1);

namespace App\View;

class View
{

    private $twig;

    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../templates');
        $this->twig = new \Twig\Environment($loader, [
            /*'cache' => '/path/to/compilation_cache'*/
        ]);
    }

    public function render(string $template, array $data): void
    {
        echo $this->twig->render('frontend/'.$template.'.html.twig', $data);
    }




















}
