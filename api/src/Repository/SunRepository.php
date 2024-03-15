<?php

namespace App\Repository;

use App\Entity\Sun;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sun>
 *
 * @method Sun|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sun|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sun[]    findAll()
 * @method Sun[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SunRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sun::class);
    }

    //    /**
    //     * @return Sun[] Returns an array of Sun objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Sun
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
