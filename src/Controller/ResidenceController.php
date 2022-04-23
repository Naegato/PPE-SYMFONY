<?php

namespace App\Controller;

use App\Entity\Residence;
use App\Form\ResidenceFormType;
use App\Repository\RentRepository;
use App\Repository\ResidenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

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
        dd($this->residenceRepository->findAllocatedByCity("Senlis"));

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

    #[Route('/bien/registration', name: 'bienRegistration')]
    public function registration(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger) {

        if(!$this->isGranted("ROLE_ADMINISTRATOR",$this->getUser())){
            return $this->redirectToRoute('index');
        }

        $residence = new Residence();

        $form = $this->createForm(ResidenceFormType::class, $residence);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $inventoryFile = $form->get('inventory_file_form')->getData();

//            if ($inventoryFile) {
                $inventoryFileoriginalFilename = pathinfo($inventoryFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $inventoryFilesafeFilename = $slugger->slug($inventoryFileoriginalFilename);
                $inventoryFilenewFilename = $inventoryFilesafeFilename.'-'.uniqid().'.'.$inventoryFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $inventoryFile->move(
                        $this->getParameter('file_upload'),
                        $inventoryFilenewFilename
                    );
                } catch (FileException $e) { }

                $residence->setInventoryFile($inventoryFilenewFilename);
//            }

            $image = $form->get('image_form')->getData();

//            if ($image) {
                $imageoriginalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $imagesafeFilename = $slugger->slug($imageoriginalFilename);
                $imagenewFilename = $imagesafeFilename.'-'.uniqid().'.'.$image->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $image->move(
                        $this->getParameter('file_upload'),
                        $imagenewFilename
                    );
                } catch (FileException $e) { }

                $residence->setImage($imagenewFilename);
//            }


            $entityManager->persist($residence);
            $entityManager->flush();

            return $this->redirectToRoute('biens');
        }

        return $this->render('residence/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/bien', name: 'bien')]
    public function bien(Request $request, EntityManagerInterface $entityManager): Response
    {
        if(!$this->isGranted("ROLE_REPRESENTATIVE",$this->getUser())){
            return $this->redirectToRoute('biens');
        }


        $id = $request->request->get("id");

        if (!$id) {
            return $this->redirectToRoute('biens');
        }

        $residence = $this->residenceRepository->findById($id);
        $rent = $this->rentRepository->findAllRentByResidence($id);

        $form = $this->createForm(ResidenceFormType::class, $residence);

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
