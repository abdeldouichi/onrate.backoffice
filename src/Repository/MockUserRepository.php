<?php

namespace App\Repository;

use App\AbstractClasses\AbstractRepository;
use App\Entity\MockUser;
use App\Entity\Note;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MockUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method MockUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method MockUser[]    findAll()
 * @method MockUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MockUserRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MockUser::class);
    }

    /**
     * @param User $user
     * @return MockUser[]|null
     */
    public function findAllByUser(User $user): ?Collection
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param string $firstname
     * @param string $familyname
     * @param User $user
     * @return MockUser|null
     */
    public function findByNameAndUser(string $firstname,string $familyname,User $user):?MockUser{
        try {
            return $this->createQueryBuilder('u')
                ->andWhere('u.firstname = :val')
                ->setParameter('val', $firstname)
                ->andWhere('u.familyname = :val')
                ->setParameter('val', $familyname)
                ->andWhere('u.user = :val')
                ->setParameter('val', $user)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            error_log("Error - NonUniqueResultException ".$e->getMessage());
            return null;
        }
    }


}
