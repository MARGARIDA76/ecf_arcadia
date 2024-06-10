<?php

namespace App\Controller;

use App\Entity\Service;
use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver\ServiceValueResolver;
use Symfony\Component\Routing\Attribute\Route;



class ServiceController extends AbstractController
{
    #[Route('/service', name: 'app_service')]
    public function index(ServiceRepository $serviceRepository): Response
    {
        $services = $serviceRepository->findBy([], ['id' => 'DESC']);
        return $this->render('service/index.html.twig', [
            'services' => $services,
        ]);
    }
    #[Route('/service/{id}', name: 'app_service_show')]
    public function show(Service $service): Response
    {
        
        return $this->render('service/show.html.twig', [
            'service' => $service,
        ]);
    }
}