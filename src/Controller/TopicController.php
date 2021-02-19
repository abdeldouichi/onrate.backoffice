<?php


namespace App\Controller;

use App\DTO\Mapper\TopicMapper;
use App\DTO\TopicDTO;
use App\Entity\Topic;
use App\Service\converter\TopicConverterService;
use App\Service\TopicService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class TopicController
 * @package App\Controller
 * @Route("/topics")
 */
class TopicController
{
    /**
     * @var SerializerInterface
     */
    private SerializerInterface $serializer;

    /**
     * @var TopicService
     */
    private TopicService $service;

    /**
     * TopicController constructor.
     * @param SerializerInterface $serializer
     * @param TopicService $service
     */
    public function __construct(SerializerInterface $serializer, TopicService $service)
    {
        $this->serializer = $serializer;
        $this->service = $service;
    }

    /**
     * @Route(name="api_topics_items_get", methods={"GET"})
     * @return JsonResponse
     */
    public function items():JsonResponse{
        return new JsonResponse(
            $this->serializer->serialize(TopicMapper::mapTopicDTOs($this->service->getAll()), "json"),
            JsonResponse::HTTP_OK,
            [],
            true
        );
    }

    /**
     * @Route("/{id}", name="api_topics_item_get", methods={"GET"})
     * @param Topic $topic
     * @return JsonResponse
     */
    public function item(Topic $topic):JsonResponse{

        return new JsonResponse(
            $this->serializer->serialize(TopicMapper::mapTopicDTO($topic), "json"),
            JsonResponse::HTTP_OK,
            [],
            true
        );
    }

    /**
     * @Route(name="api_topics_item_post", methods={"POST"})
     * @param Request $request
     * @param TopicConverterService $converter
     * @param UrlGeneratorInterface $urlGenerator
     * @return JsonResponse
     */
    public function post(
        Request $request,
        TopicConverterService $converter,
        UrlGeneratorInterface $urlGenerator):JsonResponse{
        /**
         * @var TopicDTO $topicDTO
         */
        $topicDTO = $this->serializer->deserialize($request->getContent(),TopicDTO::class,'json');
        $topic = $converter->convertToEntityFromDTO($topicDTO);

        $this->service->save($topic);
        $topicDTO->setId($topic->getId());
        return new JsonResponse(
            $this->serializer->serialize($topicDTO, "json"),
            JsonResponse::HTTP_CREATED,
            ['Location' => $urlGenerator->generate('api_topics_item_get', ["id" => $topic->getId()])],
            true
        );
    }

    /**
     * @Route("/{id}", name="api_topics_item_put", methods={"PUT"})
     * @param Request $request
     * @param TopicConverterService $converter
     * @return JsonResponse
     */
    public function put(
        Request $request,
        TopicConverterService $converter): JsonResponse
    {

        /**
         * @var TopicDTO $topicDTO
         */
        $topicDTO = $this->serializer->deserialize($request->getContent(),TopicDTO::class,'json');
        $topic = $converter->convertToEntityFromDTO($topicDTO);
        $this->service->save($topic);

        return new JsonResponse(
            null,
            JsonResponse::HTTP_NO_CONTENT
        );
    }

    /**
     * @Route("/{id}", name="api_topics_item_delete", methods={"DELETE"})
     * @param Topic $topic
     * @return JsonResponse
     */
    public function delete(Topic $topic): JsonResponse
    {
        $this->service->remove($topic);

        return new JsonResponse(
            null,
            JsonResponse::HTTP_NO_CONTENT
        );
    }
}