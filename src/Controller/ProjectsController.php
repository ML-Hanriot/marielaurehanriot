<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/projects')]
final class ProjectsController extends AbstractController{
    #[Route('', name: 'app_projects')]
    public function projects(): Response
    {
        return $this->render('projects/index.html.twig', [
            'controller_name' => 'ProjectsController',
        ]);
    }
    #[Route('/entre_queers', name: 'app_projects/entre_queers')]
    public function show_entre_queers(): Response
    {
        return $this->render('projects/entre_queers.html.twig', [
            'controller_name' => 'ProjectsController',
        ]);
    }
}
