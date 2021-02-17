<?php


namespace App\Controller;


use App\Entity\Rule;
use App\Entity\Topic;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class HomeController
 * @package App\Controller
 * @Route("/test")
 */
class HomeController extends AbstractController
{
    /**
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param SerializerInterface $serializer
     * @param Security $security
     * @return JsonResponse
     * @Route(name="index_test", methods={"GET"})
     */
    public function index(
        UserPasswordEncoderInterface $passwordEncoder,
        SerializerInterface $serializer,
        Security $security)
    {
        /**
         * @var User $user
         */
        $user = $security->getUser();
        /**
         * @var Rule $topic
         */
        $topic = $user->getRules()->current();
        $array = $topic->get();

        return new JsonResponse($serializer->serialize($array, 'json'),
            JsonResponse::HTTP_OK,
            [],
            true);
    }
}