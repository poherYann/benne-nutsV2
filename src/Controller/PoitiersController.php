<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PoitiersController extends AbstractController
{
    /**
     * @Route("/poitiers", name="poitiers")
     */
    public function index(): Response
    {

        $response = $this->client->request(
            'GET',
            'https://www.data.gouv.fr/fr/datasets/r/3f154ac8-f2a5-4788-8eba-0753dcc2390d'
        );
        $content = $response->getContent();
        $decode = json_decode($content, true);
        for ($i = 0; $i <= count($decode["features"]) -1; $i++)
            {
                dump($decode["features"][$i]);
            }
        return $this->render('poitiers/index.html.twig', [
            'controller_name' => 'PoitiersController',
        ]);
    }

    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

}
