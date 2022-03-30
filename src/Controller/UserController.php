<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ModifyFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use mysql_xdevapi\Exception;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
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
    public function user(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $id = $request->request->get('id');
//        dd($id);
        if ($id) {
//            dd("a");
            $user = $this->userRepository->findUserById($id);
            $connected = $this->getUser();
            if ($connected->getRoles()[0] == "ROLE_TENANT") {
                if ($connected->getUserIdentifier() !== $user->getUserIdentifier() ){
                    return $this->redirectToRoute('index');
                }
            }
//            dd($user);
            $form = $this->createForm(ModifyFormType::class, $user);
//            dd("a");
//            dd($form);
            $form->handleRequest($request);
//            dd($form->get('password')->getData());
//            dd($request,$form);
//            dd('a');
            if ($form->isSubmitted() && $form->isValid()) {
//                dd('submited');
                try {
                    if ($form->get('password')->getData()) {
                        $user->setPassword(
                            $userPasswordHasher->hashPassword(
                                $user,
                                $form->get('password')->getData()
                            )
                        );
                    }
                } catch (\Exception) {

                }
                $entityManager->persist($user);
                $entityManager->flush();

                return $this->redirectToRoute('index');
            }

            return $this->render('user/index.html.twig', [
                'modifyForm' => $form->createView(),
                'user' => $user,
            ]);
        } else {
            return $this->redirectToRoute('index');
        }
    }

    #[Route('/owners', name: 'owners')]
    public function owners(): Response
    {
        if ($this->isGranted('ROLE_ADMINISTRATOR', $this->getUser()->getRoles())) {

            $owners = $this->userRepository->findUserByRoles('["ROLE_ADMINISTRATOR"]');

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
            $users = $this->userRepository->findUserByRoles('["ROLE_TENANT"]');

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
