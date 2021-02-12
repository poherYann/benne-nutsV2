<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PresentationController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index(): Response
    {
        return $this->render('presentation/index.html.twig', [
            'controller_name' => 'PresentationController',
        ]);
    }
     /**
     * @Route("/finder", name="finder")
     */
    public function finder(): Response
    {
        return $this->render('presentation/finder.html.twig', [
        ]);
    }
     /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('presentation/contact.html.twig', [
        ]);
    }
     /**
     * @Route("/about", name="about")
     */
    public function about(): Response
    {
        return $this->render('presentation/about.html.twig', [
        ]);
    }
     /**
     * @Route("/incoming", name="incoming")
     */
    public function incoming(): Response
    {
        return $this->render('presentation/incoming.html.twig', [
        ]);
    }
}
