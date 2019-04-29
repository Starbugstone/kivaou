<?php

namespace App\Repository;

use App\Entity\JourneyHasSite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method JourneyHasSite|null find($id, $lockMode = null, $lockVersion = null)
 * @method JourneyHasSite|null findOneBy(array $criteria, array $orderBy = null)
 * @method JourneyHasSite[]    findAll()
 * @method JourneyHasSite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JourneyHasSiteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, JourneyHasSite::class);
    }

    // /**
    //  * @return JourneyHasSite[] Returns an array of JourneyHasSite objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?JourneyHasSite
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
