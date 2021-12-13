<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ArticleController extends AbstractController
{
    public function index()
    {
        die('xxx');
    }

    public function create(Request $request): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($article);
            $manager->flush();

            $this->addFlash('success', sprintf('L\'article %s a bien été ajouté.', $article->getTitle()));

            return $this->redirectToRoute('admin_articles_edit', [
                'id' => $article->getId(),
            ]);
        }

        return $this->render('admin/article/create.html.twig', [
           'form' => $form->createView(),
        ]);
    }

    public function edit(ArticleRepository $articleRepository, Request $request, int $id): Response
    {
        $article = $articleRepository->find($id);

        if (null === $article) {
            throw new NotFoundHttpException(sprintf('The article with id %s was not found.', $id));
        }

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', sprintf('L\'article %s a bien été édité.', $article->getTitle()));

            return $this->redirectToRoute('admin_articles_edit', [
                'id' => $article->getId(),
            ]);
        }

        return $this->render('admin/article/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}