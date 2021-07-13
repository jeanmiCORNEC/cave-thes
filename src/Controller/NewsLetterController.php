<?php

namespace App\Controller;

use App\Form\NewsLetterFormType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NewsLetterController extends AbstractController
{
    /**
     * @Route("/newsLetter", name="newsLetter")
     */
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(NewsLetterFormType::class);
        $contact = $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()) {
            $email = (new Email())
            ->from($contact->get('email')->getData())
            ->to('maelgut@hotmail.fr')
            ->subject('demande inscription newsletter')
            ->html("<p>Email de la personne qui demande l'inscription : " . $contact->get('email')->getData() . "</p>");

            $mailer->send($email);

            $this->addFlash('message', 'votre demande d\'adhésion à la newsletter a bien été envoyée');

            return $this->redirectToRoute('main', [
                'contact' => $contact,
            ]);
        }

        return $this->render('newsLetter/index.html.twig', [
            'controller_name' => 'NewsLetterController',
            'form' =>$form->createView()
        ]);
    }
}
