<?php

namespace App\Repository;

use App\Entity\CourrierArrive;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CourrierArrive|null find($id, $lockMode = null, $lockVersion = null)
 * @method CourrierArrive|null findOneBy(array $criteria, array $orderBy = null)
 * @method CourrierArrive[]    findAll()
 * @method CourrierArrive[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CourrierArriveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CourrierArrive::class);
    }

    // /**
    //  * @return CourrierArrive[] Returns an array of CourrierArrive objects
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
    public function findOneBySomeField($value): ?CourrierArrive
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
