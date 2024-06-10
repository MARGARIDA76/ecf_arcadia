<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\AnimalRepository;
use App\Repository\HabitatRepository;
use App\Repository\ServiceRepository;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
     public function index(ServiceRepository $serviceRepository, HabitatRepository $habitatRepository, AnimalRepository $animalRepository): Response
    {
        $services = $serviceRepository->findBy([], ['id' => 'DESC'],3);
        $habitats = $habitatRepository->findBy([], ['id' => 'DESC'],3);
        $animals = $animalRepository->findBy([], ['id' => 'DESC'],3);
        return $this->render('page/index.html.twig', [
            'controller_name' => 'PageController',
            'services' => $services,
            'habitats' => $habitats,
            'animals' => $animals,
        ]);
    }
}
