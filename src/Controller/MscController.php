<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MscController extends AbstractController
{
    public function index(): Response

    {
        return $this->render('msc.html.twig');
    }

}