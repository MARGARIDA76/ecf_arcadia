<?php

namespace App\Controller;

use App\Entity\AlimentationJour;
use App\Form\AlimentationJourType;
use App\Repository\AlimentationJourRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/alimentation/jour')]
class AlimentationJourController extends AbstractController
{
    #[Route('/', name: 'app_alimentation_jour_index', methods: ['GET'])]
    public function index(AlimentationJourRepository $alimentationJourRepository): Response
    {
        return $this->render('alimentation_jour/index.html.twig', [
            'alimentation_jours' => $alimentationJourRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_alimentation_jour_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $alimentationJour = new AlimentationJour();
        $form = $this->createForm(AlimentationJourType::class, $alimentationJour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($alimentationJour);
            $entityManager->flush();

            return $this->redirectToRoute('app_alimentation_jour_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('alimentation_jour/new.html.twig', [
            'alimentation_jour' => $alimentationJour,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_alimentation_jour_show', methods: ['GET'])]
    public function show(AlimentationJour $alimentationJour): Response
    {
        return $this->render('alimentation_jour/show.html.twig', [
            'alimentation_jour' => $alimentationJour,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_alimentation_jour_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AlimentationJour $alimentationJour, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AlimentationJourType::class, $alimentationJour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_alimentation_jour_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('alimentation_jour/edit.html.twig', [
            'alimentation_jour' => $alimentationJour,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_alimentation_jour_delete', methods: ['POST'])]
    public function delete(Request $request, AlimentationJour $alimentationJour, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$alimentationJour->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($alimentationJour);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_alimentation_jour_index', [], Response::HTTP_SEE_OTHER);
    }
}
