<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryController extends AbstractController
{
    public function index()
    {
        die('xxx');
    }

    public function create(Request $request): Response
    {
        $category = new Category();
        $form = $this->createForm('App\Form\CategoryType', $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($category);
            $manager->flush();

            $this->addFlash('success', sprintf('La catégorie %s a bien été ajoutée.', $category->getTitle()));

            return $this->redirectToRoute('admin_categories_edit', [
                'id' => $category->getId(),
            ]);
        }

        return $this->render('admin/category/create.html.twig', [
           'form' => $form->createView(),
        ]);
    }

    public function edit(CategoryRepository $categoryRepository, Request $request, int $id): Response
    {
        $category = $categoryRepository->find($id);

        if (null === $category) {
            throw new NotFoundHttpException(sprintf('The category with id %s was not found.', $id));
        }

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', sprintf('La catégorie %s a bien été éditée.', $category->getTitle()));

            return $this->redirectToRoute('admin_categories_edit', [
                'id' => $category->getId(),
            ]);
        }

        return $this->render('admin/category/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}