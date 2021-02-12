<?php

namespace App\Repository;

use App\Entity\Poitiers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Poitiers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Poitiers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Poitiers[]    findAll()
 * @method Poitiers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PoitiersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Poitiers::class);
    }

    // /**
    //  * @return Poitiers[] Returns an array of Poitiers objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Poitiers
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
