<?php

namespace App\Controller;

use App\Entity\Residence;
use App\Form\ResidenceModifyFormType;
use App\Repository\RentRepository;
use App\Repository\ResidenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResidenceController extends AbstractController
{
    private ResidenceRepository $residenceRepository;
    private RentRepository $rentRepository;

    public function __construct(ResidenceRepository $residenceRepository, RentRepository $rentRepository)
    {
        $this->residenceRepository = $residenceRepository;
        $this->rentRepository = $rentRepository;
    }

    #[Route('/biens', name: 'biens')]
    public function biens(Request $request): Response
    {
        $selectedCity = $request->request->get("selectedCity");
        $alocated = $request->request->get("alocated");
        $rents = $this->rentRepository->findAll();

        if ($alocated) {
            $residence = $this->residenceRepository->findAllocatedByCity($selectedCity);
        } else if ($selectedCity) {
            $residence = $this->residenceRepository->findByCity($selectedCity);
        } else {
            $residence = $this->residenceRepository->findAll();
        }

        $cities = $this->residenceRepository->findAllCity();

        return $this->render('residence/list.html.twig', [
            'biens' => $residence,
            'cities' => $cities,
            'selectedCity' => $selectedCity,
            'alocated' => $alocated,
            'rents' => $rents,
        ]);
    }

    #[Route('/bien', name: 'bien')]
    public function bien(Request $request, EntityManagerInterface $entityManager): Response
    {
        $id = $request->request->get("id");

        if (!$id) {
            return $this->redirectToRoute('biens');
        }

        $residence = $this->residenceRepository->findById($id);
//        dd($id);
        $rent = $this->rentRepository->findAllRentByResidence($id);
//        dd($rent);

        $form = $this->createForm(ResidenceModifyFormType::class, $residence);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($residence);
            $entityManager->flush();

            return $this->redirectToRoute('biens');
        }

        return $this->render('residence/index.html.twig', [
                "residence" => $residence,
                "modifyForm" => $form->createView(),
                "rents" => $rent,
            ]);
    }
}
