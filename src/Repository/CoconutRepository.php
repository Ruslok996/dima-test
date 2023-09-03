<?php

namespace App\Repository;

use App\Entity\Coconut;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Coconut>
 *
 * @method Coconut|null find($id, $lockMode = null, $lockVersion = null)
 * @method Coconut|null findOneBy(array $criteria, array $orderBy = null)
 * @method Coconut[]    findAll()
 * @method Coconut[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoconutRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Coconut::class);
    }

//    /**
//     * @return CoconutFixture[] Returns an array of CoconutFixture objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CoconutFixture
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
