<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    /**
     *
     * @var ArticleRepository
     */
    private $repository;

    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/article", name="article_index")
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {

        $articles = $paginator->paginate(
            $this->repository->findAll(),
            $request->query->getInt('page', 1),
            12
        );

        return $this->render('article/index.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/articles/{slug}-{id}", name="blog_show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Article $articles
     * @param string $slug
     * @return Response
     */
    public function show(Article $articles, string $slug): Response
    {

        if ($articles->getSlug() !== $slug) {
            return $this->redirectToRoute('property.show', [
                'id' => $articles->getId(),
                'slug' => $articles->getSlug()
            ], 301);
        }

        return $this->render('property/show.html.twig', [
            'articles' => $articles,
            'current_menu' => 'properties',
        ]);
    }
}
