<?php


namespace App\DTO;

/**
 * Class MockUserDTO
 * @package App\DTO
 */
class MockUserDTO
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
     * @var string|null
     */
    private ?string $email;

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
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }


}