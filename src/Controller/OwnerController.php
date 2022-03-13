<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OwnerController extends AbstractController
{
    #[Route('/owners', name: 'owners')]
    public function list(UserRepository $userRepository): Response
    {
        $owners = $userRepository
            ->findUserByRoles('["ROLE_ADMINISTRATOR"]');

        return $this->render('owner/index.html.twig', [
            'owners' => $owners,
        ]);
    }

    #[Route('/owner/{id}', name: 'owner')]
    public function show(int $id, UserRepository $userRepository): Response
    {
        $owner = $userRepository
            ->findUserById($id);

        return $this->render('owner/index.html.twig', [
            'owner' => $owner['0'],
        ]);
    }
}
