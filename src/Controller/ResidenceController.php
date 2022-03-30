<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResidenceController extends AbstractController
{
    #[Route('/biens', name: 'biens')]
    public function biens(): Response
    {
        return $this->render('residence/list.html.twig', [
            'controller_name' => 'ResidenceController',
        ]);
    }
}
