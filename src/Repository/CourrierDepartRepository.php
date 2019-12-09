<?php

namespace App\Repository;

use App\Entity\CourrierDepart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CourrierDepart|null find($id, $lockMode = null, $lockVersion = null)
 * @method CourrierDepart|null findOneBy(array $criteria, array $orderBy = null)
 * @method CourrierDepart[]    findAll()
 * @method CourrierDepart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CourrierDepartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CourrierDepart::class);
    }

    // /**
    //  * @return CourrierDepart[] Returns an array of CourrierDepart objects
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
    public function findOneBySomeField($value): ?CourrierDepart
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
