<?php


namespace App\DTO;


/**
 * Class NoteDTO
 * @package App\DTO
 */
class NoteDTO
{
    /**
     * @var int|null $id
     */
    private ?int $id;

    /**
     * @var string|null $firstname
     */
    private ?string $firstname;

    /**
     * @var string|null
     */
    private ?string $familyname;

    /**
     * @var int $scale
     */
    private ?int $scale;

    /**
     * @var float|null $grade
     */
    private ?float $grade;

    /**
     * @var string|null $ruleTitle
     */
    private ?string $ruleTitle;

    /**
     * @var string|null $ruleDescription
     */
    private ?string $ruleDescription;

    /**
     * @var string
     */
    private ?string $comment;


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getScale(): ?int
    {
        return $this->scale;
    }

    /**
     * @param int|null $scale
     */
    public function setScale(?int $scale): void
    {
        $this->scale = $scale;
    }

    /**
     * @return float|null
     */
    public function getGrade(): ?float
    {
        return $this->grade;
    }

    /**
     * @param float|null $grade
     */
    public function setGrade(?float $grade): void
    {
        $this->grade = $grade;
    }

    /**
     * @return string|null
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string|null $firstname
     */
    public function setFirstname(?string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string|null
     */
    public function getFamilyname(): ?string
    {
        return $this->familyname;
    }

    /**
     * @param string|null $familyname
     */
    public function setFamilyname(?string $familyname): void
    {
        $this->familyname = $familyname;
    }

    /**
     * @return string|null
     */
    public function getRuleTitle(): ?string
    {
        return $this->ruleTitle;
    }

    /**
     * @param string|null $ruleTitle
     */
    public function setRuleTitle(?string $ruleTitle): void
    {
        $this->ruleTitle = $ruleTitle;
    }

    /**
     * @return string|null
     */
    public function getRuleDescription(): ?string
    {
        return $this->ruleDescription;
    }

    /**
     * @param string|null $ruleDescription
     */
    public function setRuleDescription(?string $ruleDescription): void
    {
        $this->ruleDescription = $ruleDescription;
    }

    /**
     * @return string
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * @param string|null $comment
     */
    public function setComment(?string $comment): void
    {
        $this->comment = $comment;
    }

}