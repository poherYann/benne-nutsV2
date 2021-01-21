<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class ToulouseController extends AbstractController
{

    /**
     * @Route("/toulouse", name="toulouse")
     */
    public function index(): Response
    {
        $response = $this->client->request(
            'GET',
            'https://data.toulouse-metropole.fr/api/records/1.0/search/?dataset=points-dapport-volontaire-dechets-et-moyens-techniques&q=&facet=commune&facet=flux&facet=centre_ville&facet=prestataire&facet=zone&facet=pole'
        );
        $content = $response->getContent();
        $decode = json_decode($content, true);
        echo '<pre>';
        var_dump($decode);
        echo '</pre>';


        return $this->render('toulouse/index.html.twig', [
            'controller_name' => 'ToulouseController',
        ]);
    }
    private $client;
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }




}

