<?php


namespace App\Service;


use App\Entity\Rule;
use App\Repository\RuleRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\Security\Core\Security;

class RuleService
{

    /**
     * @var RuleRepository
     */
    private RuleRepository $repository;

    /**
     * @var Security $security
     */
    private Security $security;

    /**
     * RuleService constructor.
     * @param RuleRepository $repository
     * @param Security $security
     */
    public function __construct(RuleRepository $repository, Security $security)
    {
        $this->repository = $repository;
        $this->security = $security;
    }

    /**
     * @param Rule $rule
     */
    public function save(Rule $rule):void
    {
        try {
            $this->repository->createOrUpdate($rule);
        } catch (ORMException $e) {
            error_log("Error caught with ORMException ".$e->getMessage());
        }
    }

    /**
     * @return Rule[]|Collection|null
     */
    public function getAll(){
        return $this->repository->findAllByUser($this->security->getUser());
    }

    /**
     * @param $id
     * @return Rule|null
     */
    public function getById($id):?Rule{
        return $this->repository->findOneBy(["id"=>$id]);
    }

    /**
     * @param Rule $rule
     */
    public function remove(Rule $rule):void{
        try {
            $this->repository->delete($rule);
        } catch (OptimisticLockException| ORMException $e) {
            error_log($e->getMessage());
        }
    }
}