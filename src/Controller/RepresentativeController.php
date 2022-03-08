<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RepresentativeController extends AbstractController
{
    #[Route('/representative', name: 'app_representative')]
    public function index(): Response
    {
        return $this->render('representative/index.html.twig', [
            'controller_name' => 'RepresentativeController',
        ]);
    }
}
