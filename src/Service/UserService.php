<?php


namespace App\Service;


use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class UserService
{

    /**
     * @var UserRepository
     */
    private UserRepository $repository;

    /**
     * TopicService constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param User $user
     */
    public function save(User $user):void
    {
        try {
            $this->repository->createOrUpdate($user);
        } catch (ORMException $e) {
            error_log("Error caught with ORMException ".$e->getMessage());
        }
    }

    /**
     * @param User $user
     */
    public function remove(User $user):void{
        try {
            $this->repository->delete($user);
        } catch (OptimisticLockException| ORMException $e) {
            error_log($e->getMessage());
        }
    }
}