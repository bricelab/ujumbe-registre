<?php

namespace App\Repository;

use App\Entity\Classeur;
use App\Entity\Secretariat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\Types\Type;

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

    public function findAllBySecretariat(Secretariat $secretariat)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.secretariat = :secretariat')
            ->setParameter('secretariat', $secretariat)
            ->orderBy('c.id', 'ASC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
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
