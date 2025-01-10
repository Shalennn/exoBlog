<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AccueilController extends AbstractController
{
    //#[Route('/affichage/{nom}', name: 'app_affichage')]
    public function affichage(string $nom): Response
    {
        return new Response("La valeur saisi est $nom");
    }

    //#[Route('/addition/{a}/{b}', name: 'app_addition')]
    public function addition(int $a, int $b): Response
    {
        //dd(gettype($a),gettype($b));
        if ($a < 0 || $b < 0) {
            return new Response('<p>Les nombres sont négatifs</p>');
        }
        $resultat = $a + $b;
        return new Response("L’addition de $a et $b est égale au résultat : $resultat");
    }
}
