<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/", name="blog_index")
     */
    public function index(ArticleRepository $repository): Response
    {
        $articles = $repository->findLatest();
        return $this->render('blog/index.html.twig', [
            'articles' => $articles,
        ]);
    }
}
