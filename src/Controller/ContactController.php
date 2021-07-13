<?php

namespace App\Controller;

use App\Form\ContactFormType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactFormType::class);
        $contact = $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()) {
            $email = (new TemplatedEmail())
            ->from($contact->get('email')->getData())
            ->to('maelgut@hotmail.fr')
            ->subject($contact->get('object')->getData())
            ->htmlTemplate('contact/mail.html.twig')
            ->context([
                'isPro' => $contact->get('isPro')->getData(),
                'name' =>$contact->get('name')->getData(),
                'firstName' => $contact->get('firstName')->getData(),
                'society' => $contact->get('society')->getData(),
                'mail' => $contact->get('email')->getData(),
                'phone' => $contact->get('phone')->getData(),
                'comment' => $contact->get('comment')->getData()
            ]);
            $mailer->send($email);
            $this->addFlash('message', 'votre demande d\'informations  a bien été envoyée');
            return $this->redirectToRoute('main', [
                'contact' => $contact,
            ]);
        }

        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'form' =>$form->createView()
        ]);
    }
}
