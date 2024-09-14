<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OficioController extends AbstractController
{
    #[Route('/oficio', name: 'app_oficio')]
    public function index(): Response
    {
        return $this->render('oficio/index.html.twig', [
            'controller_name' => 'OficioController',
        ]);
    }
}
