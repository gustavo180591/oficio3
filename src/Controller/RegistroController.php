<?php

namespace App\Controller;
//
use App\Entity\Registro;
use App\Form\RegistroType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\BusquedaType;


class RegistroController extends AbstractController
{
    #[Route('/registro', name: 'app_registro')]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        $registro = new Registro();
        // ...
        $form = $this->createForm(RegistroType::class, $registro);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($registro);
            $entityManager->flush();
            $nombre=$registro->getName();
            return $this->render('registro/success.html.twig', ['nombre' => $nombre]);
        }
        return $this->render('registro/index.html.twig', [
            'controller_name' => 'RegistroController',
            'form' => $form,
        ]);
    }
    
    #[Route('/', name: 'app_lista')]
    public function lista(EntityManagerInterface $entityManager, Request $request): Response
    {
        // Obtenemos todos los registros de la entidad 'Registro'
        $registro = new Registro();
        $form = $this->createForm(BusquedaType::class, $registro);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $oficio=$registro->getOficio();
            $delegacion=$registro->getDelegacion(); 
            $delegaciones = $registro->getDelegacion()->toArray(); 
            $lista = $entityManager->getRepository(Registro::class)->buscar($oficio, $delegaciones);
                        return $this->render('registro/lista.html.twig', [
                            'lista' => $lista,
                'form' => $form,
            ]);
        }

        
         $lista = $entityManager->getRepository(Registro::class)->findAll();
        // Renderizamos la vista y pasamos la lista de registros
        return $this->render('registro/lista.html.twig', [
            'lista' => null,
            'form' => $form,
        ]);
    }



}
