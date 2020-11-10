<?php

namespace App\Repository;

use App\Entity\PersonCovid;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PersonCovid|null find($id, $lockMode = null, $lockVersion = null)
 * @method PersonCovid|null findOneBy(array $criteria, array $orderBy = null)
 * @method PersonCovid[]    findAll()
 * @method PersonCovid[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonCovidRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PersonCovid::class);
    }

    // /**
    //  * @return PersonCovid[] Returns an array of PersonCovid objects
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
    public function findOneBySomeField($value): ?PersonCovid
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
