<?php

namespace App\Repository;

use App\Entity\ToDoListService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ToDoListService|null find($id, $lockMode = null, $lockVersion = null)
 * @method ToDoListService|null findOneBy(array $criteria, array $orderBy = null)
 * @method ToDoListService[]    findAll()
 * @method ToDoListService[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ToDoListServiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ToDoListService::class);
    }

    // /**
    //  * @return ToDoListService[] Returns an array of ToDoListService objects
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
    public function findOneBySomeField($value): ?ToDoListService
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
