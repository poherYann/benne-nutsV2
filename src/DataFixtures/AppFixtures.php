<?php

namespace App\DataFixtures;

use App\Entity\Poitiers;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $benne = new Poitiers();
        $benne->setAdresse();
        $benne->setObservation();
        $benne->setLatitude();
        $benne->setLongitude();
        $manager->persist($benne);


        $manager->flush();
    }
}
