<?php

namespace App\Repository;

use App\Entity\Toulouse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Toulouse|null find($id, $lockMode = null, $lockVersion = null)
 * @method Toulouse|null findOneBy(array $criteria, array $orderBy = null)
 * @method Toulouse[]    findAll()
 * @method Toulouse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ToulouseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Toulouse::class);
    }

    // /**
    //  * @return Toulouse[] Returns an array of Toulouse objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Toulouse
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
