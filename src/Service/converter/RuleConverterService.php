<?php


namespace App\Service\converter;


use App\DTO\MockUserDTO;
use App\DTO\RuleDTO;
use App\Entity\MockUser;
use App\Entity\Rule;


class RuleConverterService
{

    /**
     * @param RuleDTO $ruleDTO
     * @return Rule
     */
    public function convertToEntityFromDTO(RuleDTO $ruleDTO):Rule{

        $rule = new Rule();
        $rule->setTitle($ruleDTO->getTitle());
        $rule->setDescription($ruleDTO->getDescription());

        return $rule;
    }


}