<?php


namespace App\DTO\Mapper;


use App\DTO\MockUserDTO;
use App\DTO\NoteDTO;
use App\Entity\MockUser;
use App\Entity\Note;
use Doctrine\Common\Collections\Collection;

class NoteMapper
{

    /**
     * @param Note $note
     * @return NoteDTO
     */
    public static function mapNoteDTO(Note $note):NoteDTO
    {
        $noteDTO = new NoteDTO();
        $noteDTO->setScale($note->getScale());
        $noteDTO->setGrade($note->getGrade());
        $noteDTO->setComment($note->getComment());
        $noteDTO->setFirstname($note->getMockUser()->getFirstname());
        $noteDTO->setFamilyname($note->getMockUser()->getFamilyname());
        $noteDTO->setRuleDescription($note->getRule()->getDescription());
        $noteDTO->setRuleTitle($note->getRule()->getTitle());
        $noteDTO->setId($note->getId());
        return  $noteDTO;
    }

    /**
     * @param Collection|Note[] $notes
     * @return Collection|NoteDTO[]
     */
    public static function mapNoteDTOs(Collection $notes):Collection
    {
        return $notes->map(function ($note){
            return self::mapNoteDTO($note);
        });
    }
}