<?php


namespace App\Controller;

use App\DTO\Mapper\NoteMapper;
use App\DTO\Mapper\RuleMapper;
use App\DTO\RuleDTO;
use App\Entity\Rule;
use App\Service\converter\RuleConverterService;
use App\Service\RuleService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class RuleController
 * @package App\Controller
 * @Route("/rules")
 */
class RuleController
{
    /**
     * @var SerializerInterface
     */
    private SerializerInterface $serializer;

    /**
     * @var RuleService
     */
    private RuleService $service;

    /**
     * RuleController constructor.
     * @param SerializerInterface $serializer
     * @param RuleService $service
     */
    public function __construct(SerializerInterface $serializer, RuleService $service)
    {
        $this->serializer = $serializer;
        $this->service = $service;
    }

    /**
     * @Route("/{id}", name="api_rules_item_get", methods={"GET"})
     * @param Rule $rule
     * @return JsonResponse
     */
    public function item(Rule $rule):JsonResponse{

        return new JsonResponse(
            $this->serializer->serialize(RuleMapper::mapRuleDTO($rule), "json"),
            JsonResponse::HTTP_OK,
            [],
            true
        );
    }

    /**
     * @Route(name="api_rules_items_get", methods={"GET"})
     * @return JsonResponse
     */
    public function items():JsonResponse{
        return new JsonResponse(
            $this->serializer->serialize(RuleMapper::mapRuleDTOs($this->service->getAll()), "json"),
            JsonResponse::HTTP_OK,
            [],
            true
        );
    }

    /**
     * @Route(name="api_rules_item_post", methods={"POST"})
     * @param Request $request
     * @param RuleConverterService $converter
     * @param UrlGeneratorInterface $urlGenerator
     * @return JsonResponse
     */
    public function post(
        Request $request,
        RuleConverterService $converter,
        UrlGeneratorInterface $urlGenerator):JsonResponse{
        /**
         * @var RuleDTO $ruleDTO
         */
        $ruleDTO = $this->serializer->deserialize($request->getContent(),RuleDTO::class,'json');
        $rule = $converter->convertToEntityFromDTO($ruleDTO);

        $this->service->save($rule);
        $ruleDTO->setId($rule->getId());
        return new JsonResponse(
            $this->serializer->serialize($ruleDTO, "json"),
            JsonResponse::HTTP_CREATED,
            ['Location' => $urlGenerator->generate('api_rules_item_get', ["id" => $rule->getId()])],
            true
        );
    }

    /**
     * @Route("/{id}", name="api_rules_item_put", methods={"PUT"})
     * @param Request $request
     * @param RuleConverterService $converter
     * @return JsonResponse
     */
    public function put(
        Request $request,
        RuleConverterService $converter): JsonResponse
    {

        /**
         * @var RuleDTO $ruleDTO
         */
        $ruleDTO = $this->serializer->deserialize($request->getContent(),RuleDTO::class,'json');
        $rule = $converter->convertToEntityFromDTO($ruleDTO);
        $this->service->save($rule);

        return new JsonResponse(
            null,
            JsonResponse::HTTP_NO_CONTENT
        );
    }

    /**
     * @Route("/{id}", name="api_rules_item_delete", methods={"DELETE"})
     * @param Rule $rule
     * @return JsonResponse
     */
    public function delete(Rule $rule): JsonResponse
    {
        $this->service->remove($rule);

        return new JsonResponse(
            null,
            JsonResponse::HTTP_NO_CONTENT
        );
    }
}