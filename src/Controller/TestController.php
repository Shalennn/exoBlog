<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TestController extends AbstractController
{
    // #[Route('/test', name: 'app_test')]
    // public function index(): Response
    // {
    //     return $this->render('test/index.html.twig', [
    //         'controller_name' => 'TestController',
    //     ]);
    // }
    // #[Route('/test/{nom}', name: 'app_test')]
    // public function affichage(string $nom): Response
    // {
    //     return new Response("La valeur saisi est $nom");
    // }

    #[Route('/addition/{a}/{b}', name: 'app_addition')]
    public function addition(int $a, int $b): Response
    {
        if ($a < 0 || $b < 0) {
            return new Response('<p>Les nombres sont négatifs</p>');
        }

        $resulta = $a + $b;

        return new Response("<p>L’addition de $a et $b est égale au résultat : $resulta</p>");
    }
}
