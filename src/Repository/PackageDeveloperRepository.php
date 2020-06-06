<?php

namespace App\Repository;

use App\Entity\PackageDeveloper;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PackageDeveloper|null find($id, $lockMode = null, $lockVersion = null)
 * @method PackageDeveloper|null findOneBy(array $criteria, array $orderBy = null)
 * @method PackageDeveloper[]    findAll()
 * @method PackageDeveloper[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PackageDeveloperRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PackageDeveloper::class);
    }

    // /**
    //  * @return PackageDeveloper[] Returns an array of PackageDeveloper objects
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
    public function findOneBySomeField($value): ?PackageDeveloper
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
