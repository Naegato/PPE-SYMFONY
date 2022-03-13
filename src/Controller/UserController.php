<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    #[Route('/user', name: 'user')]
    public function user(): Response
    {
        return $this->render('user/index.html.twig', [
            'error' => 'noid',
        ]);
    }

    #[Route('/user/{id}', name: 'userId')]
    public function userId(int $id): Response
    {
        $user = $this->userRepository->findUserById($id);

        return $this->render('user/index.html.twig', $user ? ['user' => $user,] : ['error' => 'unexist',] );
    }

    #[Route('/owners', name: 'owners')]
    public function owners(UserRepository $userRepository): Response
    {
        $owners = $userRepository
            ->findUserByRoles('["ROLE_ADMINISTRATOR"]');

        return $this->render('user/list.html.twig', [
            'type' => 'owner',
            'users' => $owners,
        ]);
    }
    #[Route('/tenants', name: 'tenants')]
    public function tenants(UserRepository $userRepository): Response
    {
        $users = $userRepository
            ->findUserByRoles('["ROLE_TENANT"]');

        return $this->render('user/list.html.twig', [
            'type' => 'tenant',
            'users' => $users,
        ]);
    }

    #[Route('/representatives', name: 'representatives')]
    public function representatives(UserRepository $userRepository): Response
    {
        $users = $userRepository ->findUserByRoles('["ROLE_REPRESENTATIVE"]');

        return $this->render('user/list.html.twig', [
            'type' => 'representative',
            'users' => $users,
        ]);
    }

    #[Route('/modify', name: 'modify')]
    public function modify(UserRepository $userRepository): Response
    {
        $users = $userRepository ->findUserByRoles('["ROLE_REPRESENTATIVE"]');

        return $this->render('user/list.html.twig', [
            'type' => 'representative',
            'users' => $users,
        ]);
    }
}
