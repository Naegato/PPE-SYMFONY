<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RepresentativeController extends AbstractController
{
    #[Route('/representatives', name: 'representatives')]
    public function list(UserRepository $userRepository): Response
    {
        $representatives = $userRepository
            ->findUserByRoles('["ROLE_REPRESENTATIVE"]');

        return $this->render('representative/index.html.twig', [
            'representatives' => $representatives,
        ]);
    }

    #[Route('/representative/{id}', name: 'representative')]
    public function show(int $id, UserRepository $userRepository): Response
    {
        $representative = $userRepository
            ->findUserById($id);

        return $this->render('representative/index.html.twig', [
            'representative' => $representative['0'],
        ]);
    }
}
