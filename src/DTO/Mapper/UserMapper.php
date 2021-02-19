<?php


namespace App\DTO\Mapper;


use App\DTO\UserDTO;
use App\Entity\User;
use Doctrine\Common\Collections\Collection;

class UserMapper
{
    /**
     * @param User $user
     * @return UserDTO
     */
    public static function mapUserDTO(User $user):UserDTO
    {
        $userDTO = new UserDTO();
        $userDTO->setId($user->getId());
        $userDTO->setEmail($user->getEmail());
        $userDTO->setName($user->getName());
        return  $userDTO;
    }
}