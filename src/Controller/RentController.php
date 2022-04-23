<?php

namespace App\Controller;

use App\Entity\Residence;
use App\Form\ResidenceFormType;
use App\Repository\RentRepository;
use App\Repository\ResidenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RentController extends AbstractController
{
    private RentRepository $rentRepository;

    public function __construct(RentRepository $rentRepository)
    {
        $this->rentRepository = $rentRepository;
    }

    #[Route('/rent', name: 'rent')]
    public function rent(Request $request): Response
    {
        $id = $request->request->get("id");
        $rent = $this->rentRepository->findById($id);

        return $this->render('rent/index.html.twig', [
            'rent' => $rent,
        ]);
    }
}
