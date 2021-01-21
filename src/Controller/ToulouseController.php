<?php

namespace App\Controller;

use App\Entity\Toulouse;
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
        dump($decode);
        dump($decode["records"][0]["fields"]);

        $commune = $decode["records"][0]["fields"]["commune"];
        $zone = $decode["records"][0]["fields"]["zone"];
        $voie = $decode["records"][0]["fields"]["voie"];
        $adresse = $decode["records"][0]["fields"]["adresse"];
        $precizion = $decode["records"][0]["fields"]["precision"];
        $numero = $decode["records"][0]["fields"]["numero"];
        $type = $decode["records"][0]["fields"]["geo_shape"]["type"];
        $longitude = $decode["records"][0]["fields"]["geo_shape"]["coordinates"][0][1];
        $latitude = $decode["records"][0]["fields"]["geo_shape"]["coordinates"][0][0];

        dump(count($decode["records"]));




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

