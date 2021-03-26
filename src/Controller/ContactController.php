<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/formulaire", name="formulaire")
     */
    public function contact(EntityManagerInterface $entityManager, Request $request): Response
    {
        $send = false;
        $contact = new Contact();
        $form = $this->createFormBuilder($contact)
            ->add('nom', TextType::class, array('required' => true))
            ->add('email', EmailType::class)
            ->add('message', TextareaType::class)
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            $entityManager->persist($contact);
            $entityManager->flush();
            $send = true;
        }


        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'form' => $form->createView(),
            'send' => $send,
        ]);
    }
}
