<?php

namespace App\Repository;

use App\Entity\Registre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Registre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Registre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Registre[]    findAll()
 * @method Registre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegistreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Registre::class);
    }

    // /**
    //  * @return Registre[] Returns an array of Registre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Registre
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
