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
            'https://data.toulouse-metropole.fr/api/records/1.0/search/?dataset=points-dapport-volontaire-dechets-et-moyens-techniques&q=&rows=50&facet=commune&facet=flux&facet=centre_ville&facet=prestataire&facet=zone&facet=pole'
        );
        $content = $response->getContent();
        $decode = json_decode($content, true);
            foreach ($decode as $test) {
                var_dump($test);
            }
//            for ($i = 0; $i <= count($decode["records"]) -1; $i++)
//            {
//                dump($decode["records"][$i]);
//            }
//        foreach ($decode["records"] as $benne) {
//            $ben = $benne["fields"];
//            dump($ben);

//            if (array_key_exists("commune", $ben)) {
//                dump($ben["commune"]);
//            } else {
//                dump('commune not found');
//            }
//              //
////            if (array_key_exists("numero", $ben)) {
////                dump($ben["numero"]);
////            } else {
////                dump('numero not found');
////            }
///
//            if (array_key_exists("voie", $ben)) {
//                dump($ben["voie"]);
//            } else {
//                dump('voie not found');
//            }
//            if (array_key_exists("1", $ben['geo_shape']['coordinates'][0]) && (array_key_exists("0", $ben['geo_shape']['coordinates'][0]))) {
//                dump($ben['geo_shape']['coordinates'][0][0].' '.$ben['geo_shape']['coordinates'][0][1] );
//            } else {
//                dump('latitude and longitude not found');
//            }
//        }

        /*vérifier si la donnée existe ou pas*/
        /*$commune = $decode["records"][0]["fields"]["commune"];
        $longitude = $decode["records"][0]["fields"]["geo_shape"]["coordinates"][0][1];
        $latitude = $decode["records"][0]["fields"]["geo_shape"]["coordinates"][0][0];
        $zone = $decode["records"][0]["fields"]["zone"];
        $voie = $decode["records"][0]["fields"]["voie"];
        $precizion = $decode["records"][0]["fields"]["precision"];
        $numero = $decode["records"][0]["fields"]["numero"];
        $type = $decode["records"][0]["fields"]["geo_shape"]["type"];*/


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

