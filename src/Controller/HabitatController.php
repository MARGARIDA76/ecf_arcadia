<?php

namespace App\Controller;

use App\Entity\Habitat;
use App\Repository\AnimalRepository;
use App\Repository\HabitatRepository;
use App\Repository\RapportHabitatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HabitatController extends AbstractController
{
    #[Route('/habitat', name: 'app_habitat')]
    public function index(HabitatRepository $habitatRepository): Response
    {
        $habitats = $habitatRepository->findBy([], ['id' => 'DESC'], 3);
       
        return $this->render('habitat/index.html.twig', [
            'habitats' => $habitats,
        ]);
    }
    #[Route('/habitat/{id}', name: 'app_habitat_show')]
    public function show(Habitat $habitat, RapportHabitatRepository $rapportHabitat, AnimalRepository $animalRepository): Response
    {
        $rapport = $rapportHabitat->findOneBy(['Habitat' => $habitat], ['id' => 'DESC']);
        $animaux = $animalRepository->findBy(['habitat' => $habitat]);
        return $this->render('habitat/show.html.twig', [
            'habitat' => $habitat,
            'rapport' => $rapport,
            'animaux' => $animaux,
        ]);
    }
    
}