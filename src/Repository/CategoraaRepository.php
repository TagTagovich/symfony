<?php

namespace App\Repository;

use App\Entity\Categoraa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Categoraa|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categoraa|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categoraa[]    findAll()
 * @method Categoraa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoraaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categoraa::class);
    }

    // /**
    //  * @return Categoraa[] Returns an array of Categoraa objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Categoraa
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
