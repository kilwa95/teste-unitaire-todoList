<?php

namespace App\Repository;

use App\Entity\Calcule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Calcule|null find($id, $lockMode = null, $lockVersion = null)
 * @method Calcule|null findOneBy(array $criteria, array $orderBy = null)
 * @method Calcule[]    findAll()
 * @method Calcule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CalculeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Calcule::class);
    }

    // /**
    //  * @return Calcule[] Returns an array of Calcule objects
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
    public function findOneBySomeField($value): ?Calcule
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
