<?php

namespace App\Repository;

use App\Entity\Registre;
use App\Entity\Secretariat;
use App\Utils\Enum;
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

    public function findAllIncoming(Secretariat $secretariat = null)
    {
        if(!is_null($secretariat)){
            return $this->createQueryBuilder('r')
            ->andWhere('r.secretariat = :secretariat')
            ->andWhere('r.type = :type')
            ->setParameter('secretariat', $secretariat)
            ->setParameter('type', Enum::REGISTRE_TYPE_INCOMING)
            ->orderBy('r.createdAt', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
        }else{
            return $this->createQueryBuilder('r')
            ->andWhere('r.type = :type')
            ->setParameter('type', Enum::REGISTRE_TYPE_INCOMING)
            ->orderBy('r.createdAt', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
        }
        
    }

    public function findAllIncomingOpened(Secretariat $secretariat = null)
    {
        if(!is_null($secretariat)){
            return $this->createQueryBuilder('r')
            ->andWhere('r.secretariat = :secretariat')
            ->andWhere('r.type = :type')
            ->andWhere('r.status = :status')
            ->setParameter('status', Enum::REGISTRE_STATUS_OPENED)
            ->setParameter('secretariat', $secretariat)
            ->setParameter('type', Enum::REGISTRE_TYPE_INCOMING)
            ->orderBy('r.createdAt', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
        }else{
            return $this->createQueryBuilder('r')
            ->andWhere('r.type = :type')
            ->andWhere('r.status = :status')
            ->setParameter('status', Enum::REGISTRE_STATUS_OPENED)
            ->setParameter('type', Enum::REGISTRE_TYPE_INCOMING)
            ->orderBy('r.createdAt', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
        }
        
    }

    public function findAllIncomingClosed(Secretariat $secretariat = null)
    {
        if(!is_null($secretariat)){
            return $this->createQueryBuilder('r')
            ->andWhere('r.secretariat = :secretariat')
            ->andWhere('r.type = :type')
            ->andWhere('r.status = :status')
            ->setParameter('status', Enum::REGISTRE_STATUS_CLOSED)
            ->setParameter('secretariat', $secretariat)
            ->setParameter('type', Enum::REGISTRE_TYPE_INCOMING)
            ->orderBy('r.createdAt', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
        }else{
            return $this->createQueryBuilder('r')
            ->andWhere('r.type = :type')
            ->andWhere('r.status = :status')
            ->setParameter('status', Enum::REGISTRE_STATUS_CLOSED)
            ->setParameter('type', Enum::REGISTRE_TYPE_INCOMING)
            ->orderBy('r.createdAt', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
        }
        
    }

    public function findAllIncomingArchived(Secretariat $secretariat = null)
    {
        if(!is_null($secretariat)){
            return $this->createQueryBuilder('r')
            ->andWhere('r.secretariat = :secretariat')
            ->andWhere('r.type = :type')
            ->andWhere('r.status = :status')
            ->setParameter('status', Enum::REGISTRE_STATUS_ARCHIVED)
            ->setParameter('secretariat', $secretariat)
            ->setParameter('type', Enum::REGISTRE_TYPE_INCOMING)
            ->orderBy('r.createdAt', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
        }else{
            return $this->createQueryBuilder('r')
            ->andWhere('r.type = :type')
            ->andWhere('r.status = :status')
            ->setParameter('status', Enum::REGISTRE_STATUS_ARCHIVED)
            ->setParameter('type', Enum::REGISTRE_TYPE_INCOMING)
            ->orderBy('r.createdAt', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
        }
        
    }

    public function findAllIncomingDelected(Secretariat $secretariat = null)
    {
        if(!is_null($secretariat)){
            return $this->createQueryBuilder('r')
            ->andWhere('r.secretariat = :secretariat')
            ->andWhere('r.type = :type')
            ->setParameter('secretariat', $secretariat)
            ->andWhere('r.status = :status')
            ->setParameter('status', Enum::REGISTRE_STATUS_DELECTED)
            ->setParameter('type', Enum::REGISTRE_TYPE_INCOMING)
            ->orderBy('r.createdAt', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
        }else{
            return $this->createQueryBuilder('r')
            ->andWhere('r.type = :type')
            ->andWhere('r.status = :status')
            ->setParameter('status', Enum::REGISTRE_STATUS_DELECTED)
            ->setParameter('type', Enum::REGISTRE_TYPE_INCOMING)
            ->orderBy('r.createdAt', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
        }
        
    }

    public function findAllIncomingTrashed(Secretariat $secretariat = null)
    {
        if(!is_null($secretariat)){
            return $this->createQueryBuilder('r')
            ->andWhere('r.secretariat = :secretariat')
            ->andWhere('r.type = :type')
            ->andWhere('r.status = :status')
            ->setParameter('status', Enum::REGISTRE_STATUS_TRASHED)
            ->setParameter('secretariat', $secretariat)
            ->setParameter('type', Enum::REGISTRE_TYPE_INCOMING)
            ->orderBy('r.createdAt', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
        }else{
            return $this->createQueryBuilder('r')
            ->andWhere('r.type = :type')
            ->andWhere('r.status = :status')
            ->setParameter('status', Enum::REGISTRE_STATUS_TRASHED)
            ->setParameter('type', Enum::REGISTRE_TYPE_INCOMING)
            ->orderBy('r.createdAt', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
        }
        
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
