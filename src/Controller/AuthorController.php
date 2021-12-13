<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthorController extends AbstractController
{
    public function index(AuthorRepository $authorRepository): Response
    {
        return $this->render('author/index.html.twig', [
            'authors' => $authorRepository->findBy([], [
                'lastName' => 'ASC'
            ]),
        ]);
    }

    public function show(
        AuthorRepository $authorRepository,
        ArticleRepository $articleRepository,
        int $id
    ): Response {
        $author = $authorRepository->find($id);

        if (null === $author) {
            throw new NotFoundHttpException(sprintf('The author with id %d was not found.', $id));
        }

        return $this->render('author/show.html.twig', [
            'author' => $author,
            'articles' => $articleRepository->findLastByAuthor($author),
        ]);
    }
}
