<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ArticleController extends AbstractController
{
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('article/index.html.twig', [
            'articles' => $articleRepository->findBy([], [
                'date' => 'desc'
            ]),
        ]);
    }

    public function show(ArticleRepository $articleRepository, int $articleId): Response
    {
        $article = $articleRepository->find($articleId);

        if (null === $article) {
            throw new NotFoundHttpException(sprintf('The article with id %d was not found.', $articleId));
        }

        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }
}
