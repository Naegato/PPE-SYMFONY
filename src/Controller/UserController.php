<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ModifyFormType;
use App\Repository\RentRepository;
use App\Repository\ResidenceRepository;
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
    private RentRepository $rentRepository;
    private ResidenceRepository $residenceRepository;

    public function __construct(UserRepository $userRepository, RentRepository $rentRepository, ResidenceRepository $residenceRepository)
    {
        $this->userRepository = $userRepository;
        $this->rentRepository = $rentRepository;
        $this->residenceRepository = $residenceRepository;
    }

    #[Route('/user', name: 'user')]
    public function user(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $id = $request->request->get('id');
        if ($id) {
            $user = $this->userRepository->findUserById($id);
            $connected = $this->getUser();
            if ($connected->getRoles()[0] == "ROLE_TENANT") {
                if ($connected->getUserIdentifier() !== $user->getUserIdentifier()){
                    return $this->redirectToRoute('index');
                }
            }
            $form = $this->createForm(ModifyFormType::class, $user);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                try {
                    if ($form->get('plainPassword')->getData()) {
                        $user->setPassword(
                            $userPasswordHasher->hashPassword(
                                $user,
                                $form->get('plainPassword')->getData()
                            )
                        );
                    }
                } catch (\Exception) {

                }
                $entityManager->persist($user);
                $entityManager->flush();

                return $this->redirectToRoute('index');
            }

            $rent = $this->rentRepository->findByTenant($user);

            $allRent = $this->rentRepository->findAll();

            $residences = [];

            if ($user->getRoles()[0] == "ROLE_REPRESENTATIVE"){
                $residences = $this->residenceRepository->findByRepresentative($user);
            } else if ($user->getRoles()[0] == "ROLE_ADMINISTRATOR") {
                $residences = $this->residenceRepository->findByOwner($user);
            }

            return $this->render('user/index.html.twig', [
                'modifyForm' => $form->createView(),
                'user' => $user,
                'rents' => $rent,
                'residences' => $residences,
                'alocated' => $allRent,
            ]);
        } else {
            return $this->redirectToRoute('index');
        }
    }

    #[Route('/users', name: 'users')]
    public function users(): Response
    {
        return $this->redirectToRoute('index');
    }

    #[Route('/users/{roles}/{page}', name: 'usersRolesPage')]
    public function usersRolesPage(string $roles, int $page = 1): Response
    {
        $roles = strtoupper($roles);
        if ($roles != 'TENANT') {
            if (!$this->isGranted("ROLE_$roles", $this->getUser()->getRoles())) {
                return $this->redirectToRoute('index');
            }
        }
        $count = $this->userRepository->findUserByRolesCount('["ROLE_'.$roles.'"]');
        $users = $this->userRepository->pageFindUserByRoles('["ROLE_'.$roles.'"]');

        if ($page > count($users)){
            return $this->redirectToRoute('usersRolesPage', ['roles' => $roles, 'page' => count($users)]);
        }

        if ($page < 1){
            return $this->redirectToRoute('usersRolesPage', ['roles' => $roles, 'page' => 1]);
        }

        return $this->render('user/list.html.twig', [
            'type' => "$roles",
            'users' => $users,
            'page' => $page
        ]);
    }

    #[Route('/users/{roles}/', name: 'usersRoles')]
    public function usersRoles(string $roles): Response
    {
        return $this->redirectToRoute('usersRolesPage', ['roles' => $roles, 'page' => 1]);
    }

//    #[Route('/owners', name: 'owners')]
//    public function owners(): Response
//    {
//        if ($this->isGranted('ROLE_ADMINISTRATOR', $this->getUser()->getRoles())) {
//
//            $owners = $this->userRepository->findUserByRoles('["ROLE_ADMINISTRATOR"]');
//
//            return $this->render('user/list.html.twig', [
//                'type' => 'ROLE_ADMINISTRATOR',
//                'users' => $owners,
//            ]);
//        }
//        return $this->redirectToRoute('index');
//    }
//    #[Route('/tenants', name: 'tenants')]
//    public function tenants(): Response
//    {
//        if ($this->isGranted('ROLE_REPRESENTATIVE', $this->getUser()->getRoles())) {
//            $users = $this->userRepository->findUserByRoles('["ROLE_TENANT"]');
//
//            return $this->render('user/list.html.twig', [
//                'type' => 'ROLE_TENANT',
//                'users' => $users,
//            ]);
//        }
//        return $this->redirectToRoute('index');
//
//    }
//
//    #[Route('/representatives', name: 'representatives')]
//    public function representatives(): Response
//    {
//        if ($this->isGranted('ROLE_ADMINISTRATOR', $this->getUser()->getRoles())) {
//            $users = $this->userRepository ->findUserByRoles('["ROLE_REPRESENTATIVE"]');
//
//            return $this->render('user/list.html.twig', [
//                'type' => 'ROLE_REPRESENTATIVE',
//                'users' => $users,
//            ]);
//        }
//        return $this->redirectToRoute('index');
//    }

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
