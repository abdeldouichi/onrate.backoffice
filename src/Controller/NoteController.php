<?php


namespace App\Controller;

use App\DTO\Mapper\NoteMapper;
use App\DTO\NoteDTO;
use App\Entity\Note;
use App\Service\converter\NoteConverterService;
use App\Service\NoteService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class NoteController
 * @package App\Controller
 * @Route("/notes")
 */
class NoteController
{
    /**
     * @var SerializerInterface
     */
    private SerializerInterface $serializer;

    /**
     * @var NoteService
     */
    private NoteService $service;

    /**
     * NoteController constructor.
     * @param SerializerInterface $serializer
     * @param NoteService $service
     */
    public function __construct(SerializerInterface $serializer, NoteService $service)
    {
        $this->serializer = $serializer;
        $this->service = $service;
    }


    /**
     * @Route(name="api_notes_items_get", methods={"GET"})
     * @return JsonResponse
     */
    public function items():JsonResponse{
        return new JsonResponse(
            $this->serializer->serialize(NoteMapper::mapNoteDTOs($this->service->getAll()), "json"),
            JsonResponse::HTTP_OK,
            [],
            true
        );
    }

    /**
     * @Route("/{id}", name="api_notes_item_get", methods={"GET"})
     * @param Note $note
     * @return JsonResponse
     */
    public function item(Note $note):JsonResponse{

        return new JsonResponse(
            $this->serializer->serialize(NoteMapper::mapNoteDTO($note), "json"),
            JsonResponse::HTTP_OK,
            [],
            true
        );
    }

    /**
     * @Route(name="api_notes_item_post", methods={"POST"})
     * @param Request $request
     * @param NoteConverterService $converter
     * @param UrlGeneratorInterface $urlGenerator
     * @return JsonResponse
     */
    public function post(
        Request $request,
        NoteConverterService $converter,
        UrlGeneratorInterface $urlGenerator):JsonResponse{
        /**
         * @var NoteDTO $noteDTO
         */
        $noteDTO = $this->serializer->deserialize($request->getContent(),NoteDTO::class,'json');
        $note = $converter->convertToEntityFromDTO($noteDTO);

        $this->service->save($note);
        $noteDTO->setId($note->getId());
        return new JsonResponse(
            $this->serializer->serialize($noteDTO, "json"),
            JsonResponse::HTTP_CREATED,
            ['Location' => $urlGenerator->generate('api_notes_item_get', ["id" => $note->getId()])],
            true
        );
    }

    /**
     * @Route("/{id}", name="api_notes_item_put", methods={"PUT"})
     * @param Request $request
     * @param NoteConverterService $converter
     * @return JsonResponse
     */
    public function put(
        Request $request,
        NoteConverterService $converter): JsonResponse
    {

        /**
         * @var NoteDTO $noteDTO
         */
        $noteDTO = $this->serializer->deserialize($request->getContent(),NoteDTO::class,'json');
        $note = $converter->convertToEntityFromDTO($noteDTO);
        $this->service->save($note);

        return new JsonResponse(
            null,
            JsonResponse::HTTP_NO_CONTENT
        );
    }

    /**
     * @Route("/{id}", name="api_notes_item_delete", methods={"DELETE"})
     * @param Note $note
     * @return JsonResponse
     */
    public function delete(Note $note): JsonResponse
    {
        $this->service->remove($note);

        return new JsonResponse(
            null,
            JsonResponse::HTTP_NO_CONTENT
        );
    }
}