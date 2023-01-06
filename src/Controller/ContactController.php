<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function displayContactPage(): Response
    {
        return $this->render('contact/contact.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }
    #[Route('/contact/handler', name:'app_contact_handler')]
    public function contact_handler(MailerInterface $mailer){
        $contact_message = (new Email())
        ->from($_POST['email-sender'])
        ->to('christopherprojects.mail@gmail.com')
        ->subject($_POST['contact-subject'])
        ->text(
            'Sender : ' . $_POST['email-sender'] . \PHP_EOL
            . 'Full Name : ' . $_POST['full-name'] . \PHP_EOL
            . 'Subject : ' . $_POST['contact-subject'] .\PHP_EOL
            . 'Message : ' . $_POST['contact-message'],
            'text/plain');
            $mailer->send($contact_message);

            return new Response('Message sent successfully', 200);
    }
}
