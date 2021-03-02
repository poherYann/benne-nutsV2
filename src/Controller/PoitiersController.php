<?php

namespace App\Controller;

use App\Entity\Poitier;
use App\Repository\PoitierRepository;
use App\Repository\PoitiersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\DataFixtures\AppFixtures;

class PoitiersController extends AbstractController
{
    /**
     * @Route("/poitiers", name="poitiers")
     * @param PoitiersRepository $poitiersRepository
     * @return Response
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function index(PoitierRepository $poitierRepository): Response
    {

        $response = $this->client->request(
            'GET',
            'https://www.data.gouv.fr/fr/datasets/r/3f154ac8-f2a5-4788-8eba-0753dcc2390d'
        );


        $content = $response->getContent();

        $decode = json_decode($content, true);

        dump($decode["features"]);

        $entityManager = $this->getDoctrine()->getManager();


        if (count($decode["features"]) !== count($poitierRepository->findAll())) {


            for ($i = 0; $i <= count($decode["features"]) - 1; $i++) {
//                $key = $decode["features"][$i]["properties"];

                // verif si données dja existantes en bdd & comparer a celles deja présentes sur le json à insert
                // si données > existantes et = > rien à faire
                // insertion =/= inserré > update

                if (isset($decode["features"][$i]["geometry"]["coordinates"][1]) && isset($decode["features"][$i]["geometry"]["coordinates"][0])) {
                    $benne = new Poitier();
                    $benne->setLatitude($decode["features"][$i]["geometry"]["coordinates"][1]);
                    $benne->setLongitude($decode["features"][$i]["geometry"]["coordinates"][0]);

                    $entityManager->persist($benne);
                }

            }
            $entityManager->flush();
            return $this->render('poitiers/index.html.twig', [
                'controller_name' => 'PoitiersController',
            ]);
        } else {
            return new JsonResponse('Data already up to date');
        }
    }

    private
        $client;

    public
    function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

}
