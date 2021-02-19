<?php


namespace App\Service\converter;


use App\DTO\MockUserDTO;
use App\DTO\NoteDTO;
use App\Entity\MockUser;
use App\Entity\Note;
use App\Repository\MockUserRepository;
use App\Repository\RuleRepository;
use Symfony\Component\Security\Core\Security;


class NoteConverterService
{

    /**
     * @var Security $security
     */
    private Security $security;

    /**
     * @var MockUserRepository $mockUserRepo
     */
    private MockUserRepository $mockUserRepo;

    /**
     * @var RuleRepository $ruleRepo
     */
    private RuleRepository $ruleRepo;

    /**
     * NoteConverterService constructor.
     * @param Security $security
     * @param MockUserRepository $mockUserRepo
     * @param RuleRepository $ruleRepo
     */
    public function __construct(Security $security, MockUserRepository $mockUserRepo, RuleRepository $ruleRepo)
    {
        $this->security = $security;
        $this->mockUserRepo = $mockUserRepo;
        $this->ruleRepo = $ruleRepo;
    }

    /**
     * @param NoteDTO $noteDTO
     * @return Note
     */
    public function convertToEntityFromDTO(NoteDTO $noteDTO):Note{

        $note = new Note();
        $note->setComment($noteDTO->getComment());
        $note->setGrade($noteDTO->getGrade());
        $note->setScale($noteDTO->getScale());
        $note->setUser($this->security->getUser());
        $note->setMockUser($this->mockUserRepo->findByNameAndUser($noteDTO->getFirstname(),$noteDTO->getFamilyname(),$this->security->getUser()));
        $note->setRule($this->ruleRepo->findByTitleAndUser($noteDTO->getRuleTitle(),$this->security->getUser()));

        return $note;
    }


}