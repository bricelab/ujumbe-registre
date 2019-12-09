<?php

namespace App\Repository;

use App\Entity\Secretariat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Secretariat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Secretariat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Secretariat[]    findAll()
 * @method Secretariat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SecretariatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Secretariat::class);
    }

    // /**
    //  * @return Secretariat[] Returns an array of Secretariat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Secretariat
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
