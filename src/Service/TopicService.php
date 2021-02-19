<?php


namespace App\Service;


use App\Entity\Topic;
use App\Repository\TopicRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\Security\Core\Security;

class TopicService
{
    /**
     * @var TopicRepository
     */
    private TopicRepository $repository;

    /**
     * @var Security $security
     */
    private Security $security;

    /**
     * TopicService constructor.
     * @param TopicRepository $repository
     * @param Security $security
     */
    public function __construct(TopicRepository $repository, Security $security)
    {
        $this->repository = $repository;
        $this->security = $security;
    }


    /**
     * @param Topic $topic
     */
    public function save(Topic $topic):void
    {
        try {
            $this->repository->createOrUpdate($topic);
        } catch (ORMException $e) {
            error_log("Error caught with ORMException ".$e->getMessage());
        }
    }

    /**
     * @return Topic[]|Collection|null
     */
    public function getAll(){
        return $this->repository->findAllByUser($this->security->getUser());
    }

    /**
     * @param $id
     * @return Topic|null
     */
    public function getById($id):?Topic{
        return $this->repository->findOneBy(["id"=>$id]);
    }

    /**
     * @param Topic $topic
     */
    public function remove(Topic $topic):void{
        try {
            $this->repository->delete($topic);
        } catch (OptimisticLockException| ORMException $e) {
            error_log($e->getMessage());
        }
    }
}