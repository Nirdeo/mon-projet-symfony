<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Repository\ArticleRepository;

class ArticleController extends AbstractController
{
    private const ARTICLES = [
        [
            'id' => 12,
            'nom' => 'Rue du commerce',
            'contenu' => 'lorem ipsum dolor sit',
        ],
        [
            'id' => 13,
            'nom' => 'Amazon',
            'contenu' => 'lorem ipsum dolor sit',
        ],
        [
            'id' => 16,
            'nom' => 'Cdiscount',
            'contenu' => 'lorem ipsum dolor sit',
        ]
    ];

    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('article/index.html.twig', [
            'articles' => $articleRepository->findAll(), // findBy par date décroissante
        ]);
    }

    /*public function index(): Response
    {
        return $this->render('article/index.html.twig', [
            'articles' => self::ARTICLES,
        ]);
    }*/

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

    /*public function show(int $articleId): Response
    {
        // Retourne un tableau avec les valeurs de la clé id
        $articleIndex = array_search($articleId, array_column(self::ARTICLES, 'id'));
        // Récupère l'index/la clé d'un élément dans un tableau

        if (false === $articleIndex) {
            throw new NotFoundHttpException(sprintf('The article with id %d was not found.', $articleId));
        }

        return $this->render('article/show.html.twig', [
            'article' => self::ARTICLES[$articleIndex],
            // Récupère l'élément du tableau qui a la clé (articleIndex)
        ]);
    }*/
}

