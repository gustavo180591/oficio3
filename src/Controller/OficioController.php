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
        #[Route('/', name: 'app_oficio', methods: ['GET'])]
    public function index(): Response
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
    #[Route('/oficio/{id}/toggle-status', name: 'oficio_toggle_status', methods: ['POST'])]
    public function toggleStatus($id, Request $request, EntityManagerInterface $em): JsonResponse
    {
        $oficio = $em->getRepository(Oficio::class)->find($id);

        if (!$oficio) {
            return new JsonResponse(['error' => 'Oficio no encontrado'], 404);
        }

        $data = json_decode($request->getContent(), true);
        if (!isset($data['status'])) {
            return new JsonResponse(['error' => 'Estado no proporcionado'], 400);
        }

        $oficio->setStatus($data['status']);
        $em->persist($oficio);
        $em->flush();

        return new JsonResponse(['success' => true]);
    }
}

