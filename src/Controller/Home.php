<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * @Route(path="/", name="home")
 */
final class Home
{
    public function __invoke(Environment $twig)
    {
        return new Response($twig->render('base.html.twig'));
    }
}
