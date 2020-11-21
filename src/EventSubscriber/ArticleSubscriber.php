<?php

namespace App\EventSubscriber;

use App\Event\ArticlePostEvent;
use App\Repository\NewsletterRepository;
use App\Service\MailerService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ArticleSubscriber implements EventSubscriberInterface
{
    private $mailer;
    private $newsletterRepository;

    public function __construct(MailerService $mailer, NewsletterRepository $newsletterRepository)
    {
        $this->mailer = $mailer;
        $this->newsletterRepository = $newsletterRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            ArticlePostEvent::NAME => 'onNewArticle',
        ];
    }

    public function onNewArticle(ArticlePostEvent $event)
    {
        //Récupération de la table newsletter inscrit
        $newsletterBdd = $this->newsletterRepository->findVisibleQuery();

        //Envoie chaque email pour les utilisateurs abonné
        foreach ($newsletterBdd as $newsletter) {

            $this->mailer->send($newsletter->getEmail(), 'noreplay@gmail.com', 'Un nouveau poste a été publié', 'newsletter/send_new_post.html.twig', [
                'article' => $event->getArticle(),
                'email_newsletter' => $newsletter->getEmail()
            ]);
        }
    }
}
