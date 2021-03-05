<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PoitiersRepository;


class MapboxController extends AbstractController
{
    /**
     * @Route("/mapbox", name="mapbox")
     */
    public function index(): Response
    {
        return $this->render('mapbox/index.html.twig', [
            'controller_name' => 'MapboxController',
        ]);

    }
}
