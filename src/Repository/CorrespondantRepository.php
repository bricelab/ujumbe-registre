<?php

namespace App\Repository;

use App\Entity\Correspondant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Correspondant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Correspondant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Correspondant[]    findAll()
 * @method Correspondant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CorrespondantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Correspondant::class);
    }

    // /**
    //  * @return Correspondant[] Returns an array of Correspondant objects
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
    public function findOneBySomeField($value): ?Correspondant
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
