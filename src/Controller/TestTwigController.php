<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TestTwigController extends AbstractController
{
    #[Route('/test/{nom}', name: 'app_test_twig')]
    public function index(string $nom): Response
    {
        return $this->render('test/index.html.twig', [
            'nom' => $nom,
        ]);
    }
}