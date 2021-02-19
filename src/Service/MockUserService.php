<?php


namespace App\Service;


use App\Entity\MockUser;
use App\Repository\MockUserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\Security\Core\Security;

class MockUserService
{
    /**
     * @var MockUserRepository $repository
     */
    private MockUserRepository $repository;

    /**
     * @var Security $security
     */
    private Security $security;

    /**
     * MockUserService constructor.
     * @param MockUserRepository $repository
     * @param Security $security
     */
    public function __construct(MockUserRepository $repository, Security $security)
    {
        $this->repository = $repository;
        $this->security = $security;
    }

    /**
     * @param MockUser $mockUser
     */
    public function save(MockUser $mockUser):void
    {
        try {
            $this->repository->createOrUpdate($mockUser);
        } catch (ORMException $e) {
            error_log("Error caught with ORMException ".$e->getMessage());
        }
    }

    /**
     * @return MockUser[]|Collection|null
     */
    public function getAll(){
        return $this->repository->findAllByUser($this->security->getUser());
    }

    /**
     * @param $id
     * @return MockUser|null
     */
    public function getById($id):?MockUser{
        return $this->repository->findOneBy(["id"=>$id]);
    }

    /**
     * @param MockUser $mockUser
     */
    public function remove(MockUser $mockUser):void{
        try {
            $this->repository->delete($mockUser);
        } catch (OptimisticLockException | ORMException $e) {
            error_log($e->getMessage());
        }
    }
}