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
            
        }

        return $this->render('registro/index.html.twig', [
            'controller_name' => 'RegistroController',
            'form' => $form,
        ]);
    }
    #[Route('/lista', name: 'app_lista')]
    public function lista(EntityManagerInterface $entityManager, Request $request): Response
    {
        $lista=$entityManager->getRepository(Registro::class)->findAll();


        return $this->render('registro/lista.html.twig', [
            'lista' => $lista,  // Pasamos la lista de registros a la vista
        ]);
    }
}
