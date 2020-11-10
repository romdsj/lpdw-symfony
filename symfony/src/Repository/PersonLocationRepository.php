<?php

namespace App\Repository;

use App\Entity\PersonLocation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PersonLocation|null find($id, $lockMode = null, $lockVersion = null)
 * @method PersonLocation|null findOneBy(array $criteria, array $orderBy = null)
 * @method PersonLocation[]    findAll()
 * @method PersonLocation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonLocationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PersonLocation::class);
    }

    // /**
    //  * @return PersonLocation[] Returns an array of PersonLocation objects
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
    public function findOneBySomeField($value): ?PersonLocation
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
