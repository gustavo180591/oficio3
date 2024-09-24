<?php

namespace App\Controller;

use App\Entity\Oficio;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OficioController extends AbstractController
{
        #[Route('/', name: 'app_oficio', methods: ['POST'])]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        return $this->render('oficio/index.html.twig', [
            'controller_name' => 'OficioController',
        ]);
    }
    
    #[Route('/oficio/nuevo', name: 'app_oficio_nuevo')]
    public function nuevo(): Response
    {
        return $this->render('oficio/index.html.twig');
    }
}

