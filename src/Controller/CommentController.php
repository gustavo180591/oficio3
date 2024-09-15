<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Entity\Oficio;

class CommentController extends AbstractController
{
    #[Route('/comment', name: 'app_comment')]
    public function newComment(): Response
    {
        $comment = new Comment();
    // ...
        $form = $this->createForm(CommentType::class, $comment);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($comment);
            $entityManager->flush();
            $nombre=$comment->getName();
            return $this->render('comment/success.html.twig', ['nombre' => $nombre]);
        }
        
        return $this->render('comment/index.html.twig', [
            'controller_name' => 'CommentController',
            'form' => $form,
        ]);
    }
}
