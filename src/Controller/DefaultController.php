<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    public function index(Request $request): Response
    {
        $user = $request->query->get('user', 'world');

        return $this->redirectToRoute('bonjour',[
            'prenom' => $user,
        ]);

        // return new Response('Hello ' . $user . ' !');
    }


    public function bonjour(string $prenom = 'world'): Response
    {
        return $this->render('default/bonjour.html.twig', [
            'prenom' => $prenom,
        ]);
        // return new Response('Hello ' . $prenom . ' !');
    }
}