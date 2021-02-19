<?php


namespace App\Controller;

use App\DTO\Mapper\MockUserMapper;
use App\DTO\MockUserDTO;
use App\Entity\MockUser;
use App\Service\converter\MockUserConverterService;
use App\Service\MockUserService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class MockUserController
 * @package App\Controller
 * @Route("/mock-users")
 */
class MockUserController
{

    /**
     * @var SerializerInterface
     */
    private SerializerInterface $serializer;

    /**
     * @var MockUserService
     */
    private MockUserService $service;

    /**
     * MockUserController constructor.
     * @param SerializerInterface $serializer
     * @param MockUserService $service
     */
    public function __construct(SerializerInterface $serializer, MockUserService $service)
    {
        $this->serializer = $serializer;
        $this->service = $service;
    }

    /**
     * @Route(name="api_mock_users_items_get", methods={"GET"})
     * @return JsonResponse
     */
    public function items():JsonResponse{
        return new JsonResponse(
            $this->serializer->serialize(MockUserMapper::mapMockUserDTOs($this->service->getAll()), "json"),
            JsonResponse::HTTP_OK,
            [],
            true
        );
    }

    /**
     * @Route("/{id}", name="api_mock_users_item_get", methods={"GET"})
     * @param MockUser $mockUser
     * @return JsonResponse
     */
    public function item(MockUser $mockUser):JsonResponse{

        return new JsonResponse(
            $this->serializer->serialize(MockUserMapper::mapMockUserDTO($mockUser), "json"),
            JsonResponse::HTTP_OK,
            [],
            true
        );
    }

    /**
     * @Route(name="api_mock_users_item_post", methods={"POST"})
     * @param Request $request
     * @param MockUserConverterService $converter
     * @param UrlGeneratorInterface $urlGenerator
     * @return JsonResponse
     */
    public function post(
        Request $request,
        MockUserConverterService $converter,
        UrlGeneratorInterface $urlGenerator):JsonResponse{
        /**
         * @var MockUserDTO $mockUserDTO
         */
        $mockUserDTO = $this->serializer->deserialize($request->getContent(),MockUserDTO::class,'json');
        $mockUser = $converter->convertToEntityFromDTO($mockUserDTO);

        $this->service->save($mockUser);
        $mockUserDTO->setId($mockUser->getId());
        return new JsonResponse(
            $this->serializer->serialize($mockUserDTO, "json"),
            JsonResponse::HTTP_CREATED,
            ['Location' => $urlGenerator->generate('api_mock_users_item_get', ["id" => $mockUser->getId()])],
            true
        );
    }

    /**
     * @Route("/{id}", name="api_mock_users_item_put", methods={"PUT"})
     * @param Request $request
     * @param MockUserConverterService $converter
     * @return JsonResponse
     */
    public function put(
        Request $request,
        MockUserConverterService $converter): JsonResponse
    {

        /**
         * @var MockUserDTO $mockUserDTO
         */
        $mockUserDTO = $this->serializer->deserialize($request->getContent(),MockUserDTO::class,'json');
        $mockUser = $converter->convertToEntityFromDTO($mockUserDTO);
        $this->service->save($mockUser);

        return new JsonResponse(
            null,
            JsonResponse::HTTP_NO_CONTENT
        );
    }

    /**
     * @Route("/{id}", name="api_mock_users_item_delete", methods={"DELETE"})
     * @param MockUser $mockUser
     * @return JsonResponse
     */
    public function delete(MockUser $mockUser): JsonResponse
    {
        $this->service->remove($mockUser);

        return new JsonResponse(
            null,
            JsonResponse::HTTP_NO_CONTENT
        );
    }
}