<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    #[Route('/hello',name:'app_hello')]
    public function bonjour():Response{

        return new Response("Hello word !");
    }

    #[Route('/bonjour/{nom}',name:'app_hello_bonjour')]
    
    public function bonjour2(string $nom):Response{

        return new Response("Bonjour $nom !");
    }

    #[Route('/calculatrice/{a}/{b}/{operation}', name: 'app_calculatrice')]
    public function calculatrice(int $a, int $b, string $operation): Response
    {
        $resulta = null;

        switch ($operation) {
            case 'add':
                $resulta = $a + $b;
                $message = "Addition $a et $b résultat : $resulta";
                break;
            case 'sous':
                $resulta = $a - $b;
                $message = "Soustraction de $a et $b résultat : $resulta";
                break;
            case 'multi':
                $resulta= $a * $b;
                $message = "Multiplication de $a et $b  résultat : $resulta";
                break;
            case 'div':
                if ($b === 0) {
                    $message = "division par zero non autorisé";
                    break;
                } else {
                    $resulta = $a / $b;
                    $message = "Division $a par $b  résultat : $resulta";
                }
                break;
            default:
                $message = "Opérateur incorrect.";
                break;
        }

        return new Response("<p>$message</p>");
    }


}
