<?php

namespace App\Entity;

use App\Repository\NoteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NoteRepository::class)
 */
class Note
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @var int $scale
     * @ORM\Column(type="integer")
     */
    private int $scale;
    /**
     * @ORM\Column(type="float")
     */
    private ?float $grade;

    /**
     * @ORM\ManyToOne(targetEntity=MockUser::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private ?MockUser $mockUser;

    /**
     * @ORM\ManyToOne(targetEntity=Rule::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Rule $rule;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private \DateTime  $createdAt;


    /**
     * Note constructor.
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGrade(): ?float
    {
        return $this->grade;
    }

    public function setGrade(float $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    public function getMockUser(): ?MockUser
    {
        return $this->mockUser;
    }

    public function setMockUser(?MockUser $mockUser): self
    {
        $this->mockUser = $mockUser;

        return $this;
    }

    public function getRule(): ?Rule
    {
        return $this->rule;
    }

    public function setRule(?Rule $rule): self
    {
        $this->rule = $rule;

        return $this;
    }

    /**
     * @return int
     */
    public function getScale(): int
    {
        return $this->scale;
    }

    /**
     * @param int $scale
     */
    public function setScale(int $scale): void
    {
        $this->scale = $scale;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

}

