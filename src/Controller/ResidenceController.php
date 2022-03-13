<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResidenceController extends AbstractController
{
    #[Route('/residence', name: 'app_residence')]
    public function index(): Response
    {
        return $this->render('residence/index.html.twig', [
            'controller_name' => 'ResidenceController',
        ]);
    }
}
