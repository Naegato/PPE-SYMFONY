<?php

namespace App\Controller;

use App\Repository\ResidenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResidenceController extends AbstractController
{
    private ResidenceRepository $residenceRepository;

    public function __construct(ResidenceRepository $residenceRepository)
    {
        $this->residenceRepository = $residenceRepository;
    }

    #[Route('/biens', name: 'biens')]
    public function biens(): Response
    {
//        dd($this->residenceRepository->findAllCity());
        $residence = $this->residenceRepository->findAll();

        return $this->render('residence/list.html.twig', [
            'biens' => $residence,
        ]);
    }
}
