<?php


namespace App\Service;


use App\Entity\Note;
use App\Repository\NoteRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\Security\Core\Security;

class NoteService
{
    /**
     * @var NoteRepository
     */
    private NoteRepository $repository;

    /**
     * @var Security $security
     */
    private Security $security;

    /**
     * NoteService constructor.
     * @param NoteRepository $repository
     * @param Security $security
     */
    public function __construct(NoteRepository $repository, Security $security)
    {
        $this->repository = $repository;
        $this->security = $security;
    }


    /**
     * @param Note $note
     */
    public function save(Note $note):void
    {
        try {
            $this->repository->createOrUpdate($note);
        } catch (ORMException $e) {
            error_log("Error caught with ORMException ".$e->getMessage());
        }
    }

    /**
     * @return Note[]|Collection|null
     */
    public function getAll(){
        return $this->repository->findAllByUser($this->security->getUser());
    }

    /**
     * @param $id
     * @return Note|null
     */
    public function getById($id):?Note{
        return $this->repository->findOneBy(["id"=>$id]);
    }

    /**
     * @param Note $note
     */
    public function remove(Note $note):void{
        try {
            $this->repository->delete($note);
        } catch (OptimisticLockException | ORMException $e) {
            error_log($e->getMessage());
        }
    }
}