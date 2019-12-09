<?php

namespace App\Repository;

use App\Entity\TypeRegistre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TypeRegistre|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeRegistre|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeRegistre[]    findAll()
 * @method TypeRegistre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeRegistreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeRegistre::class);
    }

    // /**
    //  * @return TypeRegistre[] Returns an array of TypeRegistre objects
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
    public function findOneBySomeField($value): ?TypeRegistre
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
