<?php

namespace App\Controller;

use App\Entity\Poitiers;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PoitiersRepository;


class MapboxController extends AbstractController
{
    /**
     * @Route("/poitiers", name="poitiers")
     */
    public function index(): Response
    {
        return $this->render('mapbox/index.html.twig', [
            'controller_name' => 'MapboxController',
            'showAllBenne' => $this->showAllBenne(),
        ]);
    }

    public function showAllBenne()
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer\Serializer($normalizers, $encoders);

        $bennes = $this->getDoctrine()
            ->getRepository(Poitiers::class)
            ->findAll();
    }
    /**
     * @Route("/mapbox/ajax", name="mapbox_ajax")
     */
    public function ajax(Request $request, PoitiersRepository $poitiersRepository)
    {
        $bennes = $poitiersRepository->findAll();
        if ($request->isXmlHttpRequest() || $request->query->get('json') == 1 )
        {
            $jsondata =  [];
            $index = 0;
            foreach ($bennes as $benne){
                $tab = array(
                  'latitude' => $benne->getLatitude(),
                  'longitude' => $benne->getLongitude(),
                );

                $jsondata[$index++] = $tab;
            }
            return new JsonResponse($jsondata);
        } else {
            return $this->render('mapbox/index.html.twig');
        }
    }
}

