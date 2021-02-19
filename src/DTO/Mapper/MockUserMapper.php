<?php


namespace App\DTO\Mapper;


use App\DTO\MockUserDTO;
use App\Entity\MockUser;
use Doctrine\Common\Collections\Collection;

class MockUserMapper
{
    /**
     * @param MockUser $mockUser
     * @return MockUserDTO
     */
    public static function mapMockUserDTO(MockUser $mockUser):MockUserDTO
    {
        $mockUserDTO = new MockUserDTO();
        $mockUserDTO->setFamilyname($mockUser->getFamilyname());
        $mockUserDTO->setFirstname($mockUser->getFirstname());
        $mockUserDTO->setEmail($mockUser->getEmail());
        $mockUserDTO->setId($mockUser->getId());

        return  $mockUserDTO;
    }

    /**
     * @param Collection|MockUser[] $mockUsers
     * @return Collection|MockU  serDTO[]
     */
    public static function mapMockUserDTOs(Collection $mockUsers):Collection
    {
        return $mockUsers->map(function ($mockUser){
            return self::mapMockUserDTO($mockUser);
        });
    }

}