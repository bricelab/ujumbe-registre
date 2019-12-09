<?php

namespace App\Repository;

use App\Entity\Classeur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Classeur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Classeur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Classeur[]    findAll()
 * @method Classeur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClasseurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Classeur::class);
    }

    // /**
    //  * @return Classeur[] Returns an array of Classeur objects
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
    public function findOneBySomeField($value): ?Classeur
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
