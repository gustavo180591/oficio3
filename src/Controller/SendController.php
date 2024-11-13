<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;

class SendController extends AbstractController
{
    #[Route('/send', name: 'app_send')]
    public function index(MailerInterface $mailer, Request $request): Response
    {
        // Obtener el nombre del parámetro de la solicitud
        $nombre = $request->query->get('nombre');

        // Enviar el correo con el nombre personalizado
        $this->sendEmail($mailer, $nombre);

        // Renderizar una vista de confirmación o redirigir
        return $this->render('send/index.html.twig', [
            'controller_name' => 'SendController',
            'nombre' => $nombre,
        ]);
    }

    private function sendEmail(MailerInterface $mailer, $nombre)
    {
        $email = (new Email())
            ->from('registrodeoficios.ar@gmail.com')
            ->to('gustavo.faccendini@gmail.com') // Reemplazar por el destinatario real
            ->subject('Registro Exitoso')
            ->text("Hola $nombre,\n\nGracias por registrarte. Tu solicitud fue registrada con éxito y será verificada en las próximas 24 horas.");

        $mailer->send($email);
    }
}
