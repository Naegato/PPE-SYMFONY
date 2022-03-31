<?php

namespace App\Controller;

use App\Repository\ResidenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function biens(Request $request): Response
    {
        $selectedCity = $request->request->get("selectedCity");

        if ($selectedCity) {
            $residence = $this->residenceRepository->findByCity($selectedCity);
        } else {
            $residence = $this->residenceRepository->findAll();
        }

        $cities = $this->residenceRepository->findAllCity();

        return $this->render('residence/list.html.twig', [
            'biens' => $residence,
            'cities' => $cities,
            'selectedCity' => $selectedCity,
        ]);
    }
}
