<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ModifyFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
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
        return $this->redirectToRoute('index');
    }

    #[Route('/user/{id}', name: 'userId')]
    public function userId(int $id): Response
    {
        $user = $this->userRepository->findUserById($id);

        if ($user) {
            return $this->render('user/index.html.twig', ['user' => $user,] );
        }

        return $this->redirectToRoute('index');
    }

    #[Route('/owners', name: 'owners')]
    public function owners(): Response
    {
        if ($this->isGranted('ROLE_ADMINISTRATOR', $this->getUser()->getRoles())) {

            $owners = $this->userRepository
                ->findUserByRoles('["ROLE_ADMINISTRATOR"]');

            return $this->render('user/list.html.twig', [
                'type' => 'ROLE_ADMINISTRATOR',
                'users' => $owners,
            ]);
        }
        return $this->redirectToRoute('index');
    }
    #[Route('/tenants', name: 'tenants')]
    public function tenants(): Response
    {
        if ($this->isGranted('ROLE_REPRESENTATIVE', $this->getUser()->getRoles())) {
            $users = $this->userRepository
            ->findUserByRoles('["ROLE_TENANT"]');

            return $this->render('user/list.html.twig', [
                'type' => 'ROLE_TENANT',
                'users' => $users,
            ]);
        }
        return $this->redirectToRoute('index');

    }

    #[Route('/representatives', name: 'representatives')]
    public function representatives(): Response
    {
        if ($this->isGranted('ROLE_ADMINISTRATOR', $this->getUser()->getRoles())) {
            $users = $this->userRepository ->findUserByRoles('["ROLE_REPRESENTATIVE"]');

            return $this->render('user/list.html.twig', [
                'type' => 'ROLE_REPRESENTATIVE',
                'users' => $users,
            ]);
        }
        return $this->redirectToRoute('index');
    }

    #[Route('/modify', name: 'modify')]
    public function modify(): Response
    {
        return $this->render('user/modify.html.twig');
    }

    #[Route('/modify/{id}', name: 'modifyId')]
    public function modifyId(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager,int $id): Response
    {
        $connected = $this->getUser();
        $user = $this->userRepository->findUserById($id);

        if ($connected->getRoles()[0] == "ROLE_TENANT") {
            if ($connected->getUserIdentifier() !== $user->getUserIdentifier() ){
                throw new \Error("Acces non autoriser");
            }
        }
        $form = $this->createForm(ModifyFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $form->get('plainPassword')->getData() ?
                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('plainPassword')->getData()
                    )
                ) :
            null;

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('index');
        }

        return $this->render('user/modify.html.twig', [
            'modifyForm' => $form->createView(),
            'user' => $user,
        ]);
    }

    #[Route('/delete/{id}', name: 'deleteId')]
    public function deleteId(int $id): Response
    {
        $user = $this->userRepository->findUserById($id);
        if ($this->getUser()->getRoles()[0] == "ROLE_ADMINISTRATOR"){
            $this->userRepository->remove($user);
        } else if ($this->getUser()->getRoles()[0] == "ROLE_REPRESENTATIVE") {
            if ($user->getRoles()[0] == "ROLE_TENANT" || $this->getUser()->getUserIdentifier() == $user->getUserIdentifier()) {
                $this->userRepository->remove($user);
            } else {
                throw new \Error("Acces non autoriser");
            }
        } else {
            if ($this->getUser()->getUserIdentifier() == $user->getUserIdentifier()) {
                $this->userRepository->remove($user);
            } else {
                throw new \Error("Acces non autoriser");
            }
        }
        return $this->redirectToRoute('index');
    }

}
