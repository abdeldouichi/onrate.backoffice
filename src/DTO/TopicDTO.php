<?php


namespace App\DTO;


use Doctrine\Common\Collections\Collection;

/**
 * Class TopicDTO
 * @package App\DTO
 */
class TopicDTO
{

    /**
     * @var int|null $id
     */
    private ?int $id;

    /**
     * @var string|null $title
     */
    private ?string $title;

    /**
     * @var string|null $description
     */
    private ?string $description;

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
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription():? string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }



}