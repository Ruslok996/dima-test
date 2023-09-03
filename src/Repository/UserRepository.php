<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @return User[] Returns an array of UserFixture objects
     */
    public function exec($value): int
    {
        return $this->getEntityManager()->createQuery('UPDATE App\Entity\User u
SET u.value = (
    SELECT (COALESCE(SUM(c.value), 0)) + (COALESCE(SUM(b.value), 0))
    FROM App\Entity\Coconut c
    LEFT JOIN App\Entity\Banana b WITH c.users = b.users
    WHERE u.id = c.users OR u.id = b.users
)
WHERE u.id = :userId')->setParameter('userId', $value)->execute();
    }

//    public function findOneBySomeField($value): ?UserFixture
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
