<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * @Route("/who", name="who")
     */
    public function index(): Response
    {
        return $this->render('poitiers/home.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }
}

