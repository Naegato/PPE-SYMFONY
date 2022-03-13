<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;

class TenantController extends AbstractController
{
//    #[Route('/tenant', name: 'app_tenant')]
//    public function index(): Response
//    {
//        return $this->render('tenant/index.html.twig', [
//            'controller_name' => 'TenantController',
//        ]);
//    }

//    #[Route('/tenant', name: 'tenant')]
//    public function createTenant(ManagerRegistry $doctrine): Response
//    {
//        $entityManager = $doctrine->getManager();
//
//        $tenant = new User();
//        $tenant->setEmail('test2@gmail.com');
//        $tenant->setRoles(['tenant']);
//        $tenant->setPassword('1234');
//
//        // tell Doctrine you want to (eventually) save the Product (no queries yet)
//        $entityManager->persist($tenant);
//
//        // actually executes the queries (i.e. the INSERT query)
//        $entityManager->flush();
//    }

    #[Route('/tenant', name: 'tenants')]
    public function list(UserRepository $userRepository): Response
    {
        $tenant = $userRepository
            ->findUserByRoles('["ROLE_TENANT"]');

        return $this->render('tenant/index.html.twig', [
            'tenants' => $tenant,
        ]);
    }

    #[Route('/tenant/{id}', name: 'tenant')]
    public function show(int $id, UserRepository $userRepository): Response
    {
        $tenant = $userRepository
            ->findUserById($id);

       return $this->render('tenant/index.html.twig', [
                'tenant' => $tenant['0'],
            ]);
    }
}
