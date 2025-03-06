<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mime\Email;

final class ContactController extends AbstractController{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            // Envoi de l'email
            $email = (new Email())
                ->from($data['email'])
                ->to('contact@mlh.fr')
                ->subject('Nouveau message de contact')
                ->text("Nom : {$data['name']}\nEmail : {$data['email']}\n\nMessage :\n{$data['message']}");

            $mailer->send($email);

            // Ajout d'un message flash et redirection
            $this->addFlash('success', 'Votre message a bien été envoyé !');
            return $this->redirectToRoute('app_contact');
        }
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'form' => $form->createView(),
        ]);
    }
}
