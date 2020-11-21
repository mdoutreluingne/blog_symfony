<?php

namespace App\Controller;

use App\Entity\Newsletter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class NewsletterController extends AbstractController
{
    /**
     * @Route("/newsletter", name="newsletter")
     */
    public function index(): Response
    {
        return $this->render('newsletter/index.html.twig', [
            'controller_name' => 'NewsletterController',
        ]);
    }

    /**
     * @Route("/newsletter/unsubscribe/{email}", name="newsletter_unsubscribe")
     */
    public function unsubscribeNewsletter(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $email = $request->attributes->get('email'); //get value of the parameters email
        $emailNewsletter = $this->getDoctrine()->getRepository(Newsletter::class)->findOneBy(['email' => $email]);

        $emailNewsletter->setRegistered(false);

        $em->persist($emailNewsletter);
        $em->flush();

        return $this->render('newsletter/unscribe.html.twig');
    }
}
