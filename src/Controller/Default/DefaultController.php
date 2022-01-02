<?php

namespace App\Controller\Default;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route(name="index", path="/")
     */
    public function index(): Response
    {
//        return new Response('Hello world');
        return $this->render('Default/index.html.twig');
    }
}