<?php

namespace App\Repository;

use App\Entity\MockUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MockUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method MockUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method MockUser[]    findAll()
 * @method MockUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MockUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MockUser::class);
    }

    // /**
    //  * @return UserNote[] Returns an array of UserNote objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserNote
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
