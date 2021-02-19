<?php


namespace App\Service\converter;


use App\DTO\MockUserDTO;
use App\Entity\MockUser;


class MockUserConverterService
{

    /**
     * @param MockUserDTO $mockUserDTO
     * @return MockUser
     */
    public function convertToEntityFromDTO(MockUserDTO $mockUserDTO):MockUser{

        $mockUser = new MockUser();
        $mockUser->setEmail($mockUserDTO->getEmail());
        $mockUser->setFamilyname($mockUserDTO->getFamilyname());
        $mockUser->setFirstname($mockUserDTO->getFirstname());

        return $mockUser;
    }


}