<?php


namespace App\AbstractClasses;


use App\Entity\MockUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

class AbstractRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, $className)
    {
        parent::__construct($registry, $className);
    }

    /**
     * @param object $entity
     * @throws ORMException
     */
    public function createOrUpdate(object $entity):void{
        $this->_em->persist($entity);
        $this->_em->flush();
    }

    /**
     * @param object $entity
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(object $entity):void{
        $this->_em->remove($entity);
        $this->_em->flush();
    }
}