<?php


namespace App\Service\converter;


use App\DTO\MockUserDTO;
use App\DTO\TopicDTO;
use App\Entity\MockUser;
use App\Entity\Topic;


class TopicConverterService
{

    /**
     * @param TopicDTO $topicDTO
     * @return Topic
     */
    public function convertToEntityFromDTO(TopicDTO $topicDTO):Topic{

        $topic = new Topic();
        $topic->setDescription($topicDTO->getDescription());
        $topic->setTitle($topicDTO->getTitle());

        return $topic;
    }


}