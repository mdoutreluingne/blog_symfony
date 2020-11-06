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

    /**
     * @Route("/articles/{slug}-{id}", name="blog_show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Article $properties
     * @return Response
     */
    public function show(Article $articles, string $slug): Response
    {

        if ($articles->getSlug() !== $slug) {
            return $this->redirectToRoute('blog.show', [
                'id' => $articles->getId(),
                'slug' => $articles->getSlug()
            ], 301);
        }

        return $this->render('blog/show.html.twig', [
            'articles' => $articles
        ]);
    }
}
