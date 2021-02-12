<?php

namespace App\Controller;

use App\Entity\Poitiers;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\DataFixtures\AppFixtures;

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

        dump($decode);

        $entityManager = $this->getDoctrine()->getManager();

        for ($i = 0; $i <= count($decode["features"]) - 1; $i++) {
            $key = $decode["features"][$i]["properties"];

            if (isset($key["Adresse"]) && isset($key["Observation"]) && isset($decode["features"][$i]["geometry"]["coordinates"][1]) && isset($decode["features"][$i]["geometry"]["coordinates"][0])) {
                $benne = new Poitiers();
                $benne->setAdresse($key["Adresse"]);
                $benne->setObservation($key["Observation"]);
//              $benne->setAdresse($decode["features"][$i]["properties"]["Adresse"]);
//              $benne->setObservation($decode["features"][$i]["properties"]["Observation"]);
                $benne->setLatitude($decode["features"][$i]["geometry"]["coordinates"][1]);
                $benne->setLongitude($decode["features"][$i]["geometry"]["coordinates"][0]);

                $entityManager->persist($benne);
            }

        }


        $entityManager->flush();


        return $this->render('poitiers/index.html.twig', [
            'controller_name' => 'PoitiersController',
        ]);
    }

    private
        $client;

    public
    function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

}
