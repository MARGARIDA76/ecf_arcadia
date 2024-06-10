<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\AlimentationJour;
use App\Entity\Avis;
use App\Repository\AlimentationJourRepository;
use App\Repository\AnimalRepository;
use App\Repository\AvisRepository;
use App\Repository\RapportAnimalRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Document\visitAnimal;
use App\Entity\Habitat;
use App\Repository\HabitatRepository;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\SecurityBundle\Security;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Animal;
use App\Form\AvisType;

class AnimalController extends AbstractController
{
    
     #[Route('/animal', name: 'app_animal')]
    public function index(AnimalRepository $animalRepository, HabitatRepository  $habitatRepository, Request $request): Response
    {
        $animals = $animalRepository->findBy([], ['id' => 'DESC']);
        $habitats = $habitatRepository->findAll();




        return $this->render('animal/index.html.twig', [
            'animals' => $animals,
            'habitats' => $habitats,
        ]);
    }
    #[Route('/animal/{id}', name: 'app_animal_show')]
    public function show(Animal $animal, Request $request, EntityManagerInterface $entityManager, AvisRepository $avisRepository, AlimentationJourRepository $alimentationJour, RapportAnimalRepository $rapportAnimal, DocumentManager $documentManager, Security $security): Response
    {
        $visitAnimalRepository = $documentManager->getRepository(visitAnimal::class);
        $visitAnimal = $visitAnimalRepository->findOneBy(['animalId' => $animal->getId()]);

        if (!$visitAnimal) {
            $visitAnimal = new visitAnimal();
            $visitAnimal->setAnimalId($animal->getId());
            $visitAnimal->setAnimalName($animal->getNom());
        }

        // Incrémentez le compteur de visites
        $visitAnimal->incrementVisits();

        // Enregistrez les modifications dans la base de données MongoDB
        $documentManager->persist($visitAnimal);
        $documentManager->flush();



        $alimentation = $alimentationJour->findOneBy(['animal' => $animal], ['id' => 'DESC']);
        $rapport = $rapportAnimal->findOneBy(['animal' => $animal], ['id' => 'DESC']);

        $avisValides = $avisRepository->findBy(['animal' => $animal, 'valide' => true]);
        $avis = new Avis();
        $avis->setAnimal($animal);

        $form = $this->createForm(AvisType::class, $avis);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $avis->setNom(strip_tags($avis->getNom()));
            $avis->setCommentaire(strip_tags($avis->getCommentaire()));

            $entityManager->persist($avis);
            $entityManager->flush();
        }

        $isAdmin = $security->isGranted('ROLE_ADMIN');
        return $this->render('animal/show.html.twig', [
            'animal' => $animal,
            'form' => $form,
            'avisValides' => $avisValides,
            'alimentation' => $alimentation,
            'rapport' => $rapport,
            'visitAnimal' => $visitAnimal,
            'isAdmin' => $isAdmin,


        ]);
    }
}
