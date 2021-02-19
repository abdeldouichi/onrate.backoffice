<?php


namespace App\DTO\Mapper;

use App\DTO\TopicDTO;
use App\Entity\Topic;
use Doctrine\Common\Collections\Collection;

class TopicMapper
{
    /**
     * @param Topic $topic
     * @return TopicDTO
     */
    public static function mapTopicDTO(Topic $topic):TopicDTO
    {
        $topicDTO = new TopicDTO();
        $topicDTO->setId($topic->getId());
        $topicDTO->setDescription($topic->getDescription());
        $topicDTO->setTitle($topic->getTitle());
        return  $topicDTO;
    }

    /**
     * @param Collection|Topic[] $topics
     * @return Collection|TopicDTO[]
     */
    public static function mapTopicDTOs(Collection $topics):Collection
    {
        return $topics->map(function ($topic){
            return self::mapTopicDTO($topic);
        });
    }
}