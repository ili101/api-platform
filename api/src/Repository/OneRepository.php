<?php

namespace App\Repository;

use App\Entity\One;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<One>
 *
 * @method One|null find($id, $lockMode = null, $lockVersion = null)
 * @method One|null findOneBy(array $criteria, array $orderBy = null)
 * @method One[]    findAll()
 * @method One[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, One::class);
    }

    //    /**
    //     * @return One[] Returns an array of One objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('o.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?One
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
