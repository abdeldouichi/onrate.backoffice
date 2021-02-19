<?php


namespace App\Controller;

use App\DTO\Mapper\MockUserMapper;
use App\DTO\Mapper\NoteMapper;
use App\DTO\Mapper\RuleMapper;
use App\DTO\Mapper\TopicMapper;
use App\DTO\UserDTO;
use App\Entity\User;
use App\Service\converter\UserConverterService;
use App\Service\UserService;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class UserController
 * @package App\Controller
 */
class UserController
{

    /**
     * @var SerializerInterface
     */
    private SerializerInterface $serializer;

    /**
     * @var UserService
     */
    private UserService $service;

    /**
     * UserController constructor.
     * @param SerializerInterface $serializer
     * @param UserService $service
     */
    public function __construct(SerializerInterface $serializer, UserService $service)
    {
        $this->serializer = $serializer;
        $this->service = $service;
    }

    /**
     * @Route("/register", name="api_user_item_post", methods={"POST"})
     * @param Request $request
     * @param UserConverterService $converter
     * @param UrlGeneratorInterface $urlGenerator
     * @return JsonResponse
     */
    public function post(
        Request $request,
        UserConverterService $converter,
        UrlGeneratorInterface $urlGenerator): JsonResponse
    {
        /**
         * @var UserDTO $userDTO
         */
        $userDTO = $this->serializer->deserialize($request->getContent(), UserDTO::class, 'json');
        $user = $converter->convertToEntityFromDTO($userDTO);

        $this->service->save($user);
        $userDTO->setId($user->getId());

        return new JsonResponse(
            null,
            JsonResponse::HTTP_NO_CONTENT
        );
    }

    /**
     * @Route("/remove_credentials", name="api_user_item_delete", methods={"DELETE"})
     * @param Security $security
     * @return JsonResponse
     */
    public function delete(Security $security): JsonResponse
    {
        /**
         * @var User $user
         */
        $user = $security->getUser();

        $this->service->remove($user);

        return new JsonResponse(
            null,
            JsonResponse::HTTP_NO_CONTENT
        );
    }

    /**
     * @Route("/fetch-data", name="api_user_items_fetch", methods={"GET"})
     * @param Security $security
     * @return JsonResponse
     */
    public function getData(Security $security): JsonResponse
    {
        $data = new ArrayCollection();

        /**
         * @var User $user
         */
        $user = $security->getUser();

        $data->add(["rules" => RuleMapper::mapRuleDTOs($user->getRules())]);
        $data->add(["mock-users" => MockUserMapper::mapMockUserDTOs($user->getMockUsers())]);
        $data->add(["notes" => NoteMapper::mapNoteDTOs($user->getNotes())]);
        $data->add(["topics" => TopicMapper::mapTopicDTOs($user->getTopics())]);

        return new JsonResponse(
            $this->serializer->serialize($data, 'json'),
            JsonResponse::HTTP_OK,
            [],
            true
        );
    }
}