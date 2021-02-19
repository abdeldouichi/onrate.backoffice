<?php


namespace App\Service\converter;


use App\DTO\MockUserDTO;
use App\DTO\UserDTO;
use App\Entity\MockUser;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserConverterService
{

    /**
     * @var UserPasswordEncoderInterface $encoder
     */
    private UserPasswordEncoderInterface $encoder;

    /**
     * UserConverterService constructor.
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    /**
     * @param UserDTO $userDTO
     * @return User
     */
    public function convertToEntityFromDTO(UserDTO $userDTO):User{

        $user = new User();
        $user->setEmail($userDTO->getEmail());
        $user->setName($userDTO->getName());
        $user->setPassword($this->encoder->encodePassword($user, $userDTO->getPassword()));

        return $user;
    }


}