<?php

namespace App\Repository;

use App\AbstractClasses\AbstractRepository;
use App\Entity\Rule;
use App\Entity\User;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Rule|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rule|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rule[]    findAll()
 * @method Rule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RuleRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rule::class);
    }

    /**
     * @param User $user
     * @return Rule[]|null
     */
    public function findAllByUser(User $user): ?Collection
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param string $title
     * @param User $user
     * @return Rule|null
     */
    public function findByTitleAndUser(string $title, User $user):?Rule
    {
        try {
            return $this->createQueryBuilder('r')
                ->andWhere('r.title = :title')
                ->setParameter('title', $title)
                ->andWhere('r.user = :user')
                ->setParameter('user', $user)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            error_log("Error - NonUniqueResultException ".$e->getMessage());
            return null;
        }
    }
}
